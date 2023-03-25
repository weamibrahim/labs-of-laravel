@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<!-- /resources/views/post/create.blade.php -->
 
<h1>Create Post</h1>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 
<!-- Create Post Form -->
<form method="post" action="{{route('posts.store' )}}"   enctype="multipart/form-data">
  @csrf
       <div class="mb-3">
           <label for="title" class="form-label">title</label>
           <input name="title" type="text" class="form-control" id="title" >
    
       </div>
 
       <div class="mb-3">
           <label for="description" class="form-label">desciption</label>
           <input name="description" type="text" class="form-control" id="description" >
    
      </div>

      <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="image" class="form-label">upload file</label>
             <input name="image" type="file" class="form-control" id="file" >
    
        </div>
        
         <button type="submit" class="btn btn-primary">create</button>
</form>

@endsection