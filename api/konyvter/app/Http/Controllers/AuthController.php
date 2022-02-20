<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;

class AuthController extends BaseController {
    public function register( Request $request ) {
        $validator = Validator::make( $request->all() , [
            "username" => "required",
            "email" => "required",
            "password" => "required",
            "confirm_password" => "required|same:password",
        ]);
        if( $validator->fails() ) {
            return $this->sendError( "Validálási hiba", $validator->errors() );
        }
        $input = $request->all();
        $input[ "password" ] = bcrypt( $input[ "password" ]);
        $user = User::create( $input );
        $success[ "username" ] = $user->username;
        return $this->sendResponse( $success, "Sikeres regisztráció" );
    }

    public function login( Request $request ) {
        if( Auth::attempt([ "username" => $request->username, "password" => $request->password ])) {
            $authUser = Auth::user();
            $success[ "token" ] = $authUser->createToken( "myapitoken" )->plainTextToken;
            $success[ "username" ] = $authUser->username;
            return $this->sendResponse( $success, "Sikeres bejelentkezés" );
        }else {
            return $this->sendError( "Sikertelen bejelentkezés", [ "error" => "Hibás adatok" ]);
        }
    }
    public function logout( Request $request ) {
        auth( "sanctum" )->user()->currentAccessToken()->delete();
        return response()->json('Sikeres kijelentkezés');
    }

}