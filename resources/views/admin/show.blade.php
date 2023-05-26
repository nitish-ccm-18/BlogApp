@extends('layouts.app')
@section('title','Show User')

@section('content')
<div class="row justify-content-center">
    <div class="card" style="width: 18rem;">
        <img src="{{ url('public/Image/'.$user[0]->profile_picture) }}" alt="User Profile Picture">
        <div class="card-body">
          <h5 class="card-title"><strong>Full Name </strong>{{ $user[0]->name }}</h5>
          <p class="card-text"><strong>Email </strong>{{ $user[0]->email }}</p>
          <p class="card-text"><strong>Identity No </strong>{{ $user[0]->identity_number }}</p>
          <p class="card-text"><strong>Phone Number </strong>{{ $user[0]->phone_number }}</p>
          <p class="card-text"><strong>Joined On </strong>{{ $user[0]->created_at }}</p>
        </div>
      </div>
</div>
@endsection