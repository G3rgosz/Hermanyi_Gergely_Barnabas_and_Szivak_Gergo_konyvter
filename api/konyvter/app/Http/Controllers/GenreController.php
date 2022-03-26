<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends BaseController{

    public function index(){
        $genres = Genre::all();
        return $this->sendResponse( $genres, "Műfajok betöltve" );
    }

}
