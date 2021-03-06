<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;

class AuthController extends BaseController {
    public function register( Request $request ) {
        $validator = Validator::make( $request->all() , [
            "username" => "required|min:4|max:50|unique:users",
            "email" => "required|email|max:255|unique:users",
            "password" => "required|min:5|max:50",
            "confirm_password" => "required|same:password",
            "phone" => "digits:11"
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
    public static function logout( Request $request ) {
        auth( "sanctum" )->user()->currentAccessToken()->delete();
        return response()->json('Sikeres kijelentkezés');
    }
}