<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Validator;
use App\Http\Resources\Advertisement as AdvertisementResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends BaseController{
    
    public function index(){
        $advertisements = DB::table('advertisements')->orderByDesc('created_at')->get();
        return $this->sendResponse( $advertisements, "Hirdetések betöltve" );
    }
    //TODO: Először A könyvet létehozni és az id-t továbbküldeni ide
    public function create(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            "adtitle" => "required|max:50",
            "description" => "required",
            "price" => "required|integer",
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:8192',
            "book_id" => "required|integer",
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        try {
            $advertisement = Advertisement::create([
                "adtitle" => $input['adtitle'],
                "description" => $input['description'],
                "price" => $input['price'],
                "book_id" => $input['book_id'],
                "user_id" => auth( "sanctum" )->user()->id
            ]);
            $destination = 'public/images/'.auth( "sanctum" )->user()->username.'/'.$advertisement->id;
            $path = Storage::put($destination, $input['image']);
            $advertisement->picturepath = Storage::url($path);
            $advertisement->save();
            return $this->sendResponse(new AdvertisementResource($advertisement), "Hirdetés lérehozva");
        } catch (\Throwable $e) {
            return $this->sendError("Hiba a kiírás során", $e);
        }
    }
    public function show($id){
        $advertisement = Advertisement::find($id);
        if(is_null($advertisement)){
            return $this->sendError("Nincs ilyen hirdetés");
        }
        $advertisement->sawcounter+=1;
        $advertisement->save();
        return $this->sendResponse( $advertisement, "Hirdetés betöltve");
    }
    public function update(Request $request, $id){
        $advertisement = Advertisement::find($id);
        $user = auth( "sanctum" )->user();
        if(is_null($advertisement)){
            return $this->sendError("Nincs ilyen hirdetés");
        }elseif($advertisement->user_id == $user->id){
            $input = $request->all();
            $validator = Validator::make($input, [
                "adtitle" => "required|max:50",
                "description" => "required",
                "price" => "required|integer",
                'image' => 'required|image:jpeg,png,jpg,gif,svg|max:8192',
                "book_id" => "required|integer",
            ]);
            if($validator->fails()){
                return $this->sendError($validator->errors());
            }
            try {
                $advertisement->update([
                    "adtitle" => $input['adtitle'],
                    "description" => $input['description'],
                    "price" => $input['price'],
                    "book_id" => $input['book_id'],
                    "user_id" => $user->id
                ]);
                $destination = 'public/images/'.$user->username.'/'.$advertisement->id;
                $files = Storage::files($destination);
                Storage::delete($files);
                $path = Storage::put($destination, $input['image']);
                $advertisement->picturepath = Storage::url($path);
                $advertisement->save();
                return $this->sendResponse(new AdvertisementResource($advertisement), "Hirdetés módosítva");
            } catch (\Throwable $e) {
                return $this->sendError("Hiba a módosítás során", $e);
            }
        }else{
            return $this->sendError("Ez nem az ön hirdetése ezért nem módosíthatja");
        }
    }
    public function delete($id){
        $advertisement = Advertisement::find($id);
        $user = auth( "sanctum" )->user();
        if(is_null($advertisement)){
            return $this->sendError("Nincs ilyen hirdetés");
        }elseif($advertisement->user_id == $user->id || $user->admin){
            try {
                $destination = 'public/images/'.$user->username.'/'.$advertisement->id;
                Storage::deleteDirectory($destination);
                $book_id = $advertisement->book_id;
                Advertisement::destroy($id);
                (new BookController)->delete($book_id);
                return $this->sendResponse([], "A hirdetés törölve");
            } catch (\Throwable $e) {
                return $this->sendError("Hiba a törlés során", $e);
            }
        }else{
            return $this->sendError("Ez nem az ön hirdetése és nincs admin jogosultsága ezért nem törölheti");
        }
    }
    public function reportAd(Request $request, $id){
        $advertisement = Advertisement::find($id);
        if(is_null($advertisement)){
            return $this->sendError("Nincs ilyen hirdetés");
        }
        $input = $request->all();
        $validator = Validator::make($input, [
            "badcontent" => "required|min:20"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        try {
            $advertisement->badcontent = $input["badcontent"];
            $advertisement->save();
            return $this->sendResponse(new AdvertisementResource($advertisement), "Hirdetés jelentve");
        } catch (\Throwable $e) {
            return $this->sendError("Hiba a jelentés során", $e);
        }
    }
    public function getMyAds(){
        $user = auth("sanctum")->user();
        $advertisements = DB::table('advertisements')
            ->where('user_id', '=', $user->id)
            ->get();
        if(count($advertisements)==0){
            return $this->sendError("Jelenleg még nincsenek hirdetéseid");
        }
        return $this->sendResponse( $advertisements, "Hirdetéseid betöltve");
    }
    public function filter(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            "adtitle" => "max:50",
            "title" => "max:100",
            "max_price" => "integer",
            "writer" => "max:255",
            "genres" => "array"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $ads = Advertisement::all();
        foreach ($ads as $ad) {
            $adData[] = $ad->id;
        }
        if(isset($input["adtitle"])){
            $filters = DB::table('advertisements')
                ->select('id')
                ->where('adtitle', 'like', '%'.$input["adtitle"].'%')
                ->get();
            if(count($filters)==0){
                return $this->sendError("Nincs találat a szűrésre");
            }else{
                foreach ($filters as $filter) {
                    $filterData[] = $filter->id;
                }
                $adData = array_intersect($adData, $filterData);
            }
        }
        if(isset($input["title"])){
            $filterData = null;
            $filters = null;
            $filters = DB::table('advertisements')
                ->join('books', 'advertisements.book_id', '=', 'books.id')
                ->where('books.title', 'like', '%'.$input["title"].'%')
                ->select('advertisements.id')
                ->get();
            if(count($filters)==0){
                return $this->sendError("Nincs találat a szűrésre");
            }else{
                foreach ($filters as $filter) {
                    $filterData[] = $filter->id;
                }
                $adData = array_intersect($adData, $filterData);
            }
        }
        if(isset($input["max_price"])){
            $filterData = null;
            $filters = null;
            $filters = DB::table('advertisements')
                ->where('price', '<=', $input["max_price"])
                ->select('advertisements.id')
                ->get();
            if(count($filters)==0){
                return $this->sendError("Nincs találat a szűrésre");
            }else{
                foreach ($filters as $filter) {
                    $filterData[] = $filter->id;
                }
                $adData = array_intersect($adData, $filterData);
            }
        }
        if(isset($input["writer"])){
            $filterData = null;
            $filters = null;
            $filters = DB::table('advertisements')
                ->join('books', 'advertisements.book_id', '=', 'books.id')
                ->where('books.writer', 'like', '%'.$input["writer"].'%')
                ->select('advertisements.id')
                ->get();
            if(count($filters)==0){
                return $this->sendError("Nincs találat a szűrésre");
            }else{
                foreach ($filters as $filter) {
                    $filterData[] = $filter->id;
                }
                $adData = array_intersect($adData, $filterData);
            }
        }
        if(isset($input["genres"])){
            $filterData = null;
            $filters = null;
            $genres = $input["genres"];
            foreach ($genres as $genre) {
                $genreid = DB::table('genres')
                    ->select('id')
                    ->where('genre', '=', $genre)
                    ->get();
                if(count($genreid) == 0){
                    return $this->sendError("Nincs ilyen műfaj: ".$genre);
                }
                $filters = DB::table('advertisements')
                    ->join('books', 'advertisements.book_id', '=', 'books.id')
                    ->join('bgswitches', 'books.id', '=', 'bgswitches.book_id')
                    ->select('advertisements.id')
                    ->where('bgswitches.genre_id', '=', $genreid[0]->id)
                    ->get(); 
            }
            if(is_null($filters)){
                return $this->sendError("Nincs találat a szűrésre");
            }else{
                foreach ($filters as $filter) {
                    $filterData[] = $filter->id;
                }
                $adData = array_intersect($adData, $filterData);
            }
        }
        $advertisements = null;
        foreach ($adData as $id){
            $advertisement = DB::table('advertisements')
                ->select('*')
                ->where('id', '=', $id)
                ->get();
            $advertisements[] = $advertisement;
        }
        if(is_null($advertisements)){
            return $this->sendError("Nincs találat a szűrésre");
        }
        return $this->sendResponse($advertisements, "Szűrési találatok betöltve");
    }
}
