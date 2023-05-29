@extends('layouts.app')
@section('title','Post')

@section('content')
<div class="row justify-content-center">
    <div class="card" style="width: 18rem;">
        <img src="{{ url('public/Image/Posts/'.$post->image ) }}" alt="Post Picture">
        <div class="card-body">
            <p>
                {{$post->content}}
            </p>
          
          <p class="card-text"><strong>Author </strong>{{ $user->name }}</p>
          <p class="card-text"><strong>Write On </strong>{{ $post->created_at }}</p>
        </div>
      </div>
</div>
@endsection