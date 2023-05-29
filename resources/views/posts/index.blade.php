@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/posts/create" class="btn btn-primary">Add Post</a>
            <div class="card">
                <h1 class="text-center">Posts</h1>
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="row container">
            @foreach ($posts as $post)
                <div class="card col-sm-6" style="">
                    <img src="{{ url('public/Image/Posts/'.$post->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <p class="card-text">{{ $post->content }}</p>
                      <div class="d-flex justify-content-between">
                          <a href="/posts/show/{{ $post->id }}" class="btn btn-primary">Show</a>
                          <a href="/posts/edit/{{ $post->id }}" class="btn btn-primary">Edit</a>
                          <a href="/posts/delete/{{ $post->id }}" class="btn btn-primary">Delete</a>
                      </div>
                    </div>
                </div>  
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
