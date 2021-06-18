@extends('layouts.app')

@section('content')
    <h3>Posts</h3>
    @if (count($posts)>0)
        @foreach ($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width: 50%" src="storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                         <span>Written on {{$post->created_at->diffForHumans()}} by {{$post->user->name}}</span>
                    </div>
                </div>
            </div>
        @endforeach
        
    @else
        <p>No data found</p>
    @endif
@endsection