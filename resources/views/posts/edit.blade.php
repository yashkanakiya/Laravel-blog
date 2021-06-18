@extends('layouts.app')
@section('content')
<h1>Edit Post</h1>
<form action="/posts/update/{{ $post->id }}" method ="POST",enctype ="multipart/form-data">
        @csrf
        {{-- {{dd($post->body)}} --}}
    <div class="form-group">
      <label name="title">Title</label>
      <input type="text" value="{{$post->title}}" name="title" class="form-control" placeholder="this is title">
    </div>
    <div class="form-group">
      <label name="body">Body</label>
      <textarea class="form-control ckeditor" name="body" placeholder="body text" >{!! $post->body !!}</textarea>
    </div>
    <div class="form-group">
      <input type="file" name="fileupload">
    </div>
    <input type="submit" class="btn btn-primary">
  </form>
  
    
@endsection