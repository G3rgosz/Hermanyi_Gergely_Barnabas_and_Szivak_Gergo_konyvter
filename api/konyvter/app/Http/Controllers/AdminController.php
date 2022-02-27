<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Advertisement;

class AdminController extends BaseController{

    public function reportedads(){
        $data = auth( "sanctum" )->user()->currentAccessToken();
        $user = User::find($data->tokenable_id);
        if($user->admin){
            $rads = DB::table('advertisements')
                ->join('users', 'advertisements.user_id', '=', 'users.id')
                ->select('advertisements.adtitle', 'users.username', 'advertisements.badcontent', 'advertisements.id')
                ->whereNotNull('advertisements.badcontent')
                ->get();
            if(is_null($rads)){
                return $this->sendError("Nincsenek jelentett hirdetések");
            }
            return $this->sendResponse($rads, "Jelentett hirdetések betöltve");
        }else{
            return $this->sendError("Nincsen admin jogosultsága");
        }
    }
    public function users(){
        $data = auth( "sanctum" )->user()->currentAccessToken();
        $user = User::find($data->tokenable_id);
        if($user->admin){
            $users = DB::table('users')
                ->select('username', 'email', 'phone')
                ->get();
            if(is_null($users)){
                return $this->sendError("Nincsenek felhasználók");
            }
            return $this->sendResponse($users, "Felhasználók betöltve");
        }else{
            return $this->sendError("Nincsen admin jogosultsága");
        }
    }
    public function searchads($adtitle){
        $data = auth( "sanctum" )->user()->currentAccessToken();
        $user = User::find($data->tokenable_id);
        if($user->admin){
            $rads = DB::table('advertisements')
                ->join('users', 'advertisements.user_id', '=', 'users.id')
                ->select('advertisements.adtitle', 'users.username', 'advertisements.badcontent', 'advertisements.id')
                ->whereNotNull('advertisements.badcontent')
                ->where('advertisements.adtitle', 'like', '%'.$adtitle.'%')
                ->get();
            if(count($rads)==0){
                return $this->sendError("Nincs találat a keresésre");
            }
            return $this->sendResponse($rads, "Keresési találatok betöltve");
        }else{
            return $this->sendError("Nincsen admin jogosultsága");
        }
    }
    public function searchuser($username){
        $data = auth( "sanctum" )->user()->currentAccessToken();
        $user = User::find($data->tokenable_id);
        if($user->admin){
            $users = DB::table('users')
                ->select('username', 'email', 'phone')
                ->where('username', 'like', '%'.$username.'%')
                ->get();
            if(is_null($users)){
                return $this->sendError("Nincs találat a keresésre");
            }
            return $this->sendResponse($users, "Keresési találatok betöltve");
        }else{
            return $this->sendError("Nincsen admin jogosultsága");
        }
    }
    public function deleteads($id){
        $data = auth( "sanctum" )->user()->currentAccessToken();
        $user = User::find($data->tokenable_id);
        if($user->admin){
            if( is_null(Advertisement::find($id))){
                return $this->sendError("Nincs ilyen hirdetés");
            }
            Advertisement::destroy($id);
            return $this->sendResponse([], "A hirdetés törölve");
        }else{
            return $this->sendError("Nincsen admin jogosultsága");
        }
    }
    public function deleteuser($id){
        $data = auth( "sanctum" )->user()->currentAccessToken();
        $user = User::find($data->tokenable_id);
        if($user->admin){
            if( is_null(User::find($id))){
                return $this->sendError("Nincs ilyen felhasználó");
            } elseif($user->id == $id){
                return $this->sendError("Az admin nem törölhető");
            }
            $adid = DB::table('advertisements')
                ->select('advertisements.id')
                ->where('advertisements.user_id', '=', $id)
                ->get();
            foreach ($adid as $aid) {
                Advertisement::destroy($aid->id);
            }
            User::destroy($id);
            return $this->sendResponse([], "A felhasználó és a hozzá tartozó hirdetések törölve");
        }else{
            return $this->sendError("Nincsen admin jogosultsága");
        }
    }
}
