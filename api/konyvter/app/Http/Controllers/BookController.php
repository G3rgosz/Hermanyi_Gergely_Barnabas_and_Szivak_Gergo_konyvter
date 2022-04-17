<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Book;
use App\Models\Bgswitch;
use Illuminate\Support\Facades\DB;


class BookController extends BaseController{

    public function index(){
        $bookData = $this->getBookData(null);
        return $this->sendResponse( $bookData, "Könyvek betöltve" );
    }
    public function create(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            "title" => "required|max:100",
            "writer" => "required|max:255",
            "publisher" => "max:255",
            "release" => "integer|min:-5000|max:".date('Y'),
            "language" => "max:50",
            "genres" => "required|array"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $input["genres"] = array_unique($input["genres"]);
        asort($input["genres"]);
        $exist_id = $this->checkExist($input);
        if(is_null($exist_id)){
            $genres = $input["genres"];
            foreach ($genres as $genre) {
                $checker = DB::table('genres')
                    ->select('id')
                    ->where('genre', '=', $genre)
                    ->get();
                if(count($checker) == 0){
                    return $this->sendError("Nincs ilyen műfaj: ".$genre);
                }
            }
            try {
                $book = Book::create([
                    'title' => $input["title"],
                    'writer' => $input["writer"],
                    'publisher' => $input["publisher"],
                    'release' => $input["release"],
                    'language' => $input["language"],
                ]);
                foreach ($genres as $genre) {
                    $genreid = DB::table('genres')
                        ->select('id')
                        ->where('genre', '=', $genre)
                        ->get();
                    Bgswitch::create([
                        'book_id' => $book->id,
                        'genre_id' => $genreid[0]->id,
                    ]);
                }
                return $this->sendResponse($book->id, "Könyv hozzáadava");
            } catch (\Throwable $e) {
                return $this->sendError("Hiba a kiírás során", $e);
            }
        }else{
            return $this->sendResponse($exist_id, "Már van ilyen könyv");
        }
    }
    public function show($id){
        $test = Book::find($id);
        if(is_null($test)){
            return $this->sendError("Nincs ilyen könyv");
        }
        $bookData = $this->getBookData($id);
        return $this->sendResponse( $bookData, "Könyv betöltve" );
    }
    public function update(Request $request, $id){
        $book = Book::find($id);
        if(is_null($book)){
            return $this->sendError("Nincs ilyen könyv");
        }else{
            $advertisements = DB::table('advertisements')
                ->where('book_id', '=', $book->id)
                ->count();
            if($advertisements > 1){
                return $this->create($request);
            }
        }
        $input = $request->all();
        $validator = Validator::make($input, [
            "title" => "required|max:100",
            "writer" => "required|max:255",
            "publisher" => "max:255",
            "release" => "integer|min:-5000|max:".date('Y'),
            "language" => "max:50",
            "genres" => "required|array"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $input["genres"] = array_unique($input["genres"]);
        asort($input["genres"]);
        $exist_id = $this->checkExist($input);
        if(is_null($exist_id)){
            $genres = $input["genres"];
            foreach ($genres as $genre) {
                $checker = DB::table('genres')
                    ->select('id')
                    ->where('genre', '=', $genre)
                    ->get();
                if(count($checker) == 0){
                    return $this->sendError("Nincs ilyen műfaj: ".$genre);
                }
            }
            try {
                $book->update($input);
                DB::table('bgswitches')
                    ->where('book_id', '=', $book->id)
                    ->delete();
                foreach ($genres as $genre) {
                    $genreid = DB::table('genres')
                        ->select('id')
                        ->where('genre', '=', $genre)
                        ->get();
                    Bgswitch::create([
                        'book_id' => $book->id,
                        'genre_id' => $genreid[0]->id,
                    ]);
                }
                return $this->sendResponse($book->id, "Könyv módosítva");
            } catch (\Throwable $e) {
                return $this->sendError("Hiba a módosítás során", $e);
            }
        }else{
            return $this->sendResponse($exist_id, "Már van ilyen könyv");
        }
    }
    public function delete($id){
        $book = Book::find($id);
        if(is_null($book)){
            return $this->sendError("Nincs ilyen könyv");
        }else{
            $advertisements = DB::table('advertisements')
                ->where('book_id', '=', $book->id)
                ->count();
            if($advertisements != 0){ 
                return $this->sendError("A könyv szerepel egy hirdetésben, előbb törölje a hirdetést");
            }
        }
        try {
            DB::table('bgswitches')
                ->where('book_id', '=', $book->id)
                ->delete();
            $book->delete();
            return $this->sendResponse([], "A könyv és a hozzá tartozó kapcsolótábla adatai törölve");
        } catch (\Throwable $e) {
            return $this->sendError("Hiba a törlés során", $e);
        }
    }
    private function checkExist($input){
        $bookData = $this->getBookData(null);
        $input['genres' ] = array_values($input['genres']);
        foreach ($bookData as $book) {
            if($book['title'] == $input['title'] && 
            $book['writer'] == $input['writer'] && 
            $book['publisher'] == $input['publisher'] && 
            $book['release'] == $input['release'] && 
            $book['language'] == $input['language'] && 
            $book['genres'] == $input['genres']){
                return $book['id']; 
            } 
        }
        return null;   
    }
    private function getBookData($inId){
        if(isset($inId)){
            $book = Book::find($inId);
            $bookData[] = $this->readData($book);
        }else{
            $books = Book::all();
            foreach ($books as $book) {
                $bookData[] = $this->readData($book);
            }
        }
        return $bookData;
    }
    private function readData($book){
        $genres = DB::table('genres')
            ->join('bgswitches', 'genres.id', '=', 'bgswitches.genre_id')
            ->select('genres.genre')
            ->where('bgswitches.book_id', '=', $book->id)
            ->get();
        foreach ($genres as $genre) {
            $genreData[] = $genre->genre;
        }
        $book = array(
            'id' => $book->id,
            'title' => $book->title,
            'writer' => $book->writer,
            'publisher' => $book->publisher,
            'release' => $book->release,
            'language' => $book->language
        );
        $bookData = $book + array('genres' => $genreData);
        return $bookData;
    }
}
