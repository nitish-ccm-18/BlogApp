@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="card" style="width: 18rem;">
        <img src="{{ url('public/Image/'.$user->profile_picture) }}" alt="User Profile Picture">
        <div class="card-body">
          <h5 class="card-title">{{ $user->name }}</h5>
          <p class="card-text">{{ $user->email }}</p>
        </div>
      </div>
</div>
@endsection