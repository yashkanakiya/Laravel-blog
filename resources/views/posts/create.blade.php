@extends('layouts.app')
@section('content')
<h1>Create Blogs</h1>
<form action="{{ route('posts.store')}}" method ="POST",enctype ="multipart/form-data">
        @csrf
    <div class="form-group">
      <label name="title">Title</label>
      <input type="text" name="title" class="form-control" placeholder="this is title">
    </div>
    <div class="form-group">
      <label name="body">Body</label>
      <textarea class="form-control ckeditor" name="body" placeholder="body text"></textarea>
    </div>
    <div class="form-group">
      <input type="file" name="fileupload">
    </div>
    <input type="submit" class="btn btn-primary">
  </form>
  
    
@endsection