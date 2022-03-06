<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Validator;
use App\Http\Resources\Advertisement as AdvertisementResource;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends BaseController{
    
    public function index(){
        $advertisements = Advertisement::all();
        return $this->sendResponse( $advertisements, "Hirdetések betöltve" );
    }
    //TODO: Először A könyvet létehozni és az id-t továbbküldeni ide
    public function create(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            "adtitle" => "required|max:50",
            "description" => "required",
            "price" => "required|integer",
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
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
            $destination = 'public/images/'.auth( "sanctum" )->user()->username.'/'.$advertisement->id.'/';
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
        if( is_null($advertisement)){
            return $this->sendError("Nincs ilyen hirdetés");
        }
        return $this->sendResponse( $advertisement, "Hirdetés betöltve");
    }
}
