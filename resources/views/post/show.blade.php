@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-6">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    
    <div class="card mb-6">
            <div class="card-header">
                Post Creator Info
            </div>
            <div class="card-body">
                <h5 class="card-title fs-4">Name: {{$post->user->name}}</h5>
               
                <span class="card-title fs-4">Email: </span><span class="fs-5">{{$post->user->email}}</span></br>
              
                <span class="card-title fs-4">Created_At: </span><span class="fs-5">{{$post->created_at->format('l jS \\of F Y h:i:s A')}}</span>

              @if($post->image)

                <br>    <img src="{{asset('storage/'.$post->image) }}"  width="200px"  height="200px" class="img-fluid" >

              @endif
               </div>
    </div>
<div >




<form class="p-3" method="post" action="{{route('comments.store', $post->id)}}" >
   @csrf
   @method("post")
       <div class="mb-4">
            <label class="form-label fs-4">Comment</label>
    
             <textarea class="form-control" name="comment" ></textarea>
       
        </div>
  
        <button  class="btn btn-primary"> COMMENT</button>
</form>
@foreach($comments as $comment)
<div class="card mt-6">
    
        <div class="card-body">
            <h5 class="card-title">comment: {{$comment->comment}}</h5>
            <p class="card-text">created at : {{$comment->created_at}}</p>
            <form onclick=" return confirm('are you sure you want to delete ?')" style="display:inline;" method="post" action="{{route('comments.destroy',$comment->id)}}"> 
                    @method('DELETE')
                    @csrf
                  
                    <button  class="btn btn-danger"> delete</button></form>
        </div>

    </div>

@endforeach







@endsection