@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary">Go Back</a>
    <h3>{{$post->title}}</h3>
    <img style="width: 50%" src="storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
        {!!$post->body!!}  
    </div>
    <hr>
    <small>Written on {{$post->created_at}}<small>
        <hr>
        @if (!Auth::guest())
            @if (Auth::user()->id == $post->user_id)
        
                <a href="/posts/edit/{{$post->id}}" class="btn btn-primary">Edit</a>
                <form action="/posts/delete/{{ $post->id }}" method="post" class="pull-right">
                    @csrf
                    <button type="submit" class="btn btn-danger form-control" >delete</button>
                </form>
                @endif
        @endif
@endsection