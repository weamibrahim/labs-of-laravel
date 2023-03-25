<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use  App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    ////////////////////////////////////////////////////////////////index//////////////////////////////////////////////////////
    public function index()

    {  
      //  $allPosts = Post::all(); //select * from posts

      $allPosts = Post::paginate(10);

        return view('post.index', ['posts' => $allPosts]);
    }

    //////////////////////////////////////////////////////////////show////////////////////////////////////////////////////
    public function show($id)
    {
//        dd($id);
       
        $post = Post::where('id', $id)->first();
//        dd($post);
          $comments=$post->comments;
        return view('post.show',['comments' => $comments] ,['post' => $post]);
    }


/////////////////////////////////////////////////////////create//////////////////////////////////////////
    public function create(){
        $users = User::all();
        //dd($users);
        return view('post.create', ['users' => $users]);
    }
  

//////////////////////////////////////////////////////////store//////////////////////////////////////////////
    public function store(StorePostRequest $request){

        $post=new Post();
    
     
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->input('post_creator');

        if ($request->hasFile('image')) {
            $image = request()->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $filename);
            $post->image = $filename;
        }
        $post->save();

       

        //redirect to index route
        return to_route(route:'posts.index');
    }
////////////////////////////////////////////edit////////////////////////////////////////////////////////////////////

    public function edit(Post $post)
    {
        $users = User::all();
        //dd($users);
        return view('post.edit', ['post'=>$post,'users' => $users]);
    
    }
  /////////////////////////////////////////////////update////////////////////////////////////////////
    public function update( $id,StorePostRequest $request)
    {
     
       // $post = Post::where('id', $id)->first();
       $post = Post::find($id);
       $post->title = $request->input('title');
       $post->description = $request->input('description');
   
   

        if ($request->hasFile('image')) {
            if ($post->image) {
             Storage::delete('public/'.$post->image);
            }
            $image = request()->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/', $filename);
            $post->image = $filename;
           
        }
        $post->save();



      
     
     return to_route(route:'posts.index');

    }
    ///////////////////////////////////////////////////delete/////////////////////////////////////////
    public function destory($id)
    {
     
    $post= Post::where('id', $id);
      //if ($post->image) {
       //Storage::delete('public/'.$post->image);
   // }

      $post->delete();
      return to_route(route:'posts.index');
     
    }
  
    }
   
  
