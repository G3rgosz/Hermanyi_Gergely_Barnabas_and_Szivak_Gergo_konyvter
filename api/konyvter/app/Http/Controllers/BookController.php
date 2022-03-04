<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Models\Book;
use App\Http\Resources\Book as BookResource;
use Illuminate\Support\Facades\DB;


class BookController extends BaseController{

    public function index(){

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
        return $this->sendResponse( $bookData, "Könyvek betöltve" );
    }
}
