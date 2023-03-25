@extends('layouts.app')


@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <button type="button" class="mt-4 btn btn-success"><a  class="text-decoration-none" href="{{route('posts.create')}}">Create Post</a></button>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">slug</th>
          
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
               <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{ $post->slug }}</a></td>
                @if($post->user)
                <td>{{$post->user->name}}</td>
                @else
                <td>not found</td>
                @endif
                <td>{{$post->created_at->format('Y-m-d')}}</td>
              
                <td>
                <a href="{{route('posts.edit',$post['id'])}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                    <form onclick=" return confirm('are you sure you want to delete ?')" style="display:inline;" method="post" action="{{route('posts.destory',$post['id'])}}"> 
                    @method('DELETE')
                    @csrf
                  
                    <button type="submit" class="btn btn-danger"> delete</button></form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
{!! $posts->links()!!}
@endsection

