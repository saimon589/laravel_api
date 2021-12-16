<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return $users;
    }
    public function redirect(){
        $info = array('message'=>'You need to authorized');
        return $info;
    }
    public function create(Request $req){
        $user = User::create([
          "name"=>$req->input("name"),
          "email"=>$req->input("email"),
          "password"=>Hash::make($req->input("password")),
        ]);
        $api = $user->createToken('Api Token')->accessToken;
        return response()->json([
            "status"=>true,
            "message"=>"User Register successfully",
            "api"=>$api,
        ]);
    }
    public function login(Request $req){
        $req->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        if(Auth::attempt(['email'=>$req->input('email'), 'password'=>$req->input('password')])){
          $user = auth()->user();
          $api = $user->createToken('Auth')->accessToken;
          return response()->json([
              'status'=>true,
              'message'=>'User Login successfully',
              'api'=>$api
          ]);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'User Login failed',
                'api'=>''
            ]);
        }
    }

}
