<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;
class CommentController extends Controller
{


    public function store(Request $request,$id){

       $post=Post::find($id);
   
       $comment=request()->comment;
       
   // dd($comment);
 
       $post->comments()->create([
 
       'comment' => $comment,
          
         
       ]);

       
       return redirect()->back();
    }

    public function destroy( $id)
    {
     
       Comment::where('id', $id)->delete();
       return redirect()->back();
     
    
    }


}