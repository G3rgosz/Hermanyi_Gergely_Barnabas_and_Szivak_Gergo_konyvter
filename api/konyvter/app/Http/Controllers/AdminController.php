<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function reportedads(){
        // hirdetés neve, username, badcontent, id
        $reportedads = DB::table('advertisements');
    }
    public function users(){

    }
    public function searchads(){

    }
    public function searchuser(){

    }
    public function deleteads(){

    }
    public function deleteuser(){

    }
}
