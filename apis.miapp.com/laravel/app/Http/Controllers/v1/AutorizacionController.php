<?php
 
namespace App\Http\Controllers\v1;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

 
class AutorizacionController extends Controller
{

	function login(Request $request)
	{
		
		$response = new \stdClass();
        $response->success = true;
        

		$user = User::where("email",$request->email)
		->where("password",$request->password)
		->first();

		if($user)
		{
			$response->data = new \stdClass();
			$response->data->token=$user->createToken('Laravel Password Grant Client')->accessToken;

		}
		else
		{
			$response->success = false;
			$response->errors=[];
			$response->errors[]="Correo y/o contraseña no válidos";
		}

		return response()->json($response,($response->success?200:401));
	}

}
