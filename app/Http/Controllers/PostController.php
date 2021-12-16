<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return $posts;
    }
    public function create(Request $request){
      $request->validate([
          'title'=>'required',
          'desc'=>'required'
      ]);
      Post::create([
          'title'=>$request->input('title'),
          'desc'=>$request->input('desc')
      ]);
      $status = array("status"=>true,"message"=>"Post created successful");
      return $status;
    }
    public function update(Request $req,$id){
        $req->validate([
         'title'=>'required',
         'desc'=>'required'
        ]);
        Post::find($id)->update([
          'title'=>$req->input('title'),
          'desc'=>$req->input('desc')
        ]);
        $status = array('status'=>true,'message'=>'Post update successfully');
        return $status;
    }
    public function destroy($id){
        Post::destroy($id);
        $status = array('status'=>true,'message'=>'Post delete successfully');
        return $status;
    }
}
