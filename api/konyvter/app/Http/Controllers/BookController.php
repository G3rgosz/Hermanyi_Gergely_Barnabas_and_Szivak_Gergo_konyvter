<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Models\Book;
use App\Models\Bgswitch;
use App\Http\Resources\Book as BookResource;
use Illuminate\Support\Facades\DB;


class BookController extends BaseController{

    public function index(){
        $bookData = $this->getBookData();
        return $this->sendResponse( $bookData, "Könyvek betöltve" );
    }
    public function create(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            "title" => "required|max:100",
            "writer" => "required|max:255",
            "publisher" => "max:255",
            "release" => "digits:4|integer|min:1900|max:".(date('Y')+1),
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
                    $bgswitch = Bgswitch::create([
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

    }
    private function checkExist($input){
        $bookData = $this->getBookData();
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
    private function getBookData(){
        $books = Book::all();
        foreach ($books as $book) {
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
            $bookData[] = $book + array('genres' => $genreData);
            $genreData = [];
        }
        return $bookData;
    }
}
