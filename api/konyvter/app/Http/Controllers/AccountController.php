<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Advertisement;
use Validator;

class AccountController extends BaseController{

    public function show($id){
        $test = User::find($id);
        if( is_null($test)){
            return $this->sendError("Nincs ilyen felhasználó");
        }
        $userinfo = DB::table('users')
            ->select('username', 'email', 'phone')
            ->where('id', '=', $id)
            ->get();
        return $this->sendResponse( $userinfo, "Felhasználó nyilvános adatai betöltve");
    }
    public function update(Request $request, $id = null){
        $user = auth("sanctum")->user();
        if(is_null($id)){
            $account = auth("sanctum")->user();
        }else{
            $account = User::find($id);
        }
        if(is_null($account)){
            return $this->sendError("Nincs ilyen felhasználó");
        }elseif($account->id == $user->id || $user->admin){
            if($account->admin){
                return $this->sendError("Az admin nem módosítható");
            }
            $input = $request->all();
            $validator = Validator::make($input, [
                "username" => "required|min:4|max:50",
                "email" => "required|email|max:255",
                "password" => "required|min:5|max:50",
                "confirm_password" => "required|same:password",
                "phone" => "digits:11"
            ]);
            if( $validator->fails() ) {
                return $this->sendError( "Validálási hiba", $validator->errors() );
            }
            try {
                $input[ "password" ] = bcrypt( $input[ "password" ]);
                $account->update([
                    "username" => $input['username'],
                    "email" => $input['email'],
                    "password" => $input['password'],
                    "phone" => $input['phone']
                ]);
                return $this->sendResponse($account->username, "Az adatok sikeresen frissítve" );
            } catch (\Throwable $e) {
                return $this->sendError("Hiba az adatok módosítása közben", $e);
            }
        }else{
            return $this->sendError("Ez nem az ön fiókja és nincs admin jogosultsága ezért nem módosíthatja");
        }
    }

    public function delete($id = null){
        $user = auth("sanctum")->user();
        if(is_null($id)){
            $account = auth("sanctum")->user();
        }else{
            $account = User::find($id);
        }
        if(is_null($account)){
            return $this->sendError("Nincs ilyen felhasználó");
        }elseif($account->id == $user->id || $user->admin){
            if($account->admin){
                return $this->sendError("Az admin nem törölhető");
            }
            $adsid = DB::table('advertisements')
                ->select('advertisements.id')
                ->where('advertisements.user_id', '=', $account->id)
                ->get();
            foreach ($adsid as $adid) {
                try {
                    $destination = 'public/images/'.$account->username;
                    Storage::deleteDirectory($destination);
                    (new AdvertisementController)->delete($adid->id);
                } catch (\Throwable $e) {
                    return $this->sendError("Hiba a hirdetések törlése során", $e);
                }
            }
            DB::table('personal_access_tokens')
                ->where('tokenable_id', '=', $account->id)
                ->delete();
            try {
                User::destroy($account->id);
                return $this->sendResponse([], "A felhasználó és a hozzá tartozó hirdetések törölve");
            } catch (\Throwable $e) {
                return $this->sendError("Hiba a felhasználó törlése során", $e);
            }
        }else{
            return $this->sendError("Ez nem az ön fiókja és nincs admin jogosultsága ezért nem törölheti");
        }
    }
}
