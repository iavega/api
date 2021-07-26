<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;

class usuarioController extends Controller
{
  public function __construct()
  {
      $this->middleware('jwt.verify', ['except' => ['verificarLogin']]);
  }
  // Metodo para verficar login
  public function verificarLogin(request $request)
  {
    try {
      $data = $request->all();
      $data_user = \App\Models\UserGroupGames::where('username','=',$data['user'])->first();
      if(($data_user['username'] == $data['user']) && (password_verify($data['passwd'],$data_user['psswd'])))
      {
        return $this->respondWithToken(auth()->login($data_user));
      }
      return response()->json(['error' => 'Unauthorized'], 401);
    }
    catch(Exception $e){
      return response()->json($e, 401);
    }
  }
  // Metodo para formatear la respuesta
  protected function respondWithToken($token)
  {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
  }
  // Metodo para mi informacion
  public function me()
  {
    $data_user = \App\Models\UserGroupGames::where('username','=',"tester02")->first();
    return response()->json($data_user);
  }
  public function logout()
  {
    auth()->logout();

    return response()->json(['message' => 'Successfully logged out']);
  }

  public function refresh()
  {
      return $this->respondWithToken(auth()->refresh());
  }

  // public function registrarseGuardar(request $request){
  //   $data = $request->all();
  //   $data['Type'] = 1;
  //   $validation_data = Validator::make($data,[
  //       'User'=> 'required|unique:users',
  //       'Email'=> 'required|unique:users'
  //   ],[
  //     'User.required'=> 'El campo es obligatorio',
  //     'User.unique' => 'El Usuario ingresado ya existe',
  //     'Email.required'=> 'El campo es obligatorio',
  //     'Email.unique' => 'El Correo ingresado ya existe'
  //   ]);
  //   if($validation_data->fails()){
  //     return response()->json(['status' => 'error','data'=>$validation_data], 500);
  //   }
  //   $data['Password'] = bcrypt($data['Password']);
  //   \App\Models\User::create($data);
  //   return response()->json(['status' => 'successful'], 200);
  // }
  // public function recuperarContrasena(request $request){
  //   $data = $request->all();
  //   $data_user = \App\Models\User::where('Email','=',$data['Email'])->first();
  //   if ($data_user['Email'] == $data['Email']){
  //     $mailData = [
  //       'title' => 'Restablecer la contraseña',
  //       'url' => ''
  //     ];
  //     Mail::to($data['Email'])->send(new EmailDemo($mailData));
  //   }
  //   return response()->json(['status' => 'successful'], 200);
  // }
}