<?php

namespace App\Http\Controllers\Api;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
     public function index()

    {  
    $allPosts = Post::all(); //select * from posts

     return $allPosts;

      
    }

}
