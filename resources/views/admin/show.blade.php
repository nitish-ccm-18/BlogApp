@extends('layouts.app')
@section('title','Show User')

@section('content')
<div class="row justify-content-center">
    <div class="card" style="width: 18rem;">
        <img src="{{ url('public/Image/'.$user[0]->profile_picture) }}" alt="User Profile Picture">
        <div class="card-body">
          <h5 class="card-title">{{ $user[0]->name }}</h5>
          <p class="card-text">{{ $user[0]->email }}</p>
        </div>
      </div>
</div>
@endsection