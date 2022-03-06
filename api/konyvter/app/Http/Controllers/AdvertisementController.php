<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends BaseController{
    
    public function index(){
        $advertisements = Advertisement::all();
        return $this->sendResponse( $advertisements, "Hirdetések betöltve" );
    }
    //TODO: Képtárolás megold (Először A könyvet létehozni és az id-t továbbküldeni ide)
    public function create(Request $request){

    }
}
