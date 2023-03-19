@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<form>
  <div >
    <label for="title" class="form-label">Email address</label>
    <input type="text" class="form-control" id="title" require>
    
  </div>
 
  <div>
    <label for="description" class="form-label">desciption</label>
    <input type="text" class="form-control" id="description" require>
    
  </div>
  <div>
    <label for="postcreator" class="form-label">post create</label>
    <input type="text" class="form-control" id="postcreator" require>
    
  </div>
  <button type="submit" class="btn btn-primary">update</button>
</form>

@endsection