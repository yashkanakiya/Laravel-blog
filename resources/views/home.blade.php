@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create Posts</a>
                    <h3>Your Blog Posts</h3>
                    @if (count($posts) > 0)
                    <table class="table table-striped">
                        <tr>
                            <td>Title</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td><a href="/posts/edit/{{$post->id}}" class="btn btn-primary">Edit</a></td>
                            <td>
                                <form action="/posts/delete/{{ $post->id }}" method="post" class="pull-right">
                                    @csrf
                                    <button type="submit" class="btn btn-danger form-control" >delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <p>No post created</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
