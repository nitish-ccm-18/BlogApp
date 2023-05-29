@extends('layouts.app')
@section('title','Edit')

@section('content')
<div class="row justify-content-center">
<form action="/admin/users/edit/{{ $user->id }}" method="post" class="col-md-8 " enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="UserName" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="UserEmail" placeholder="John Doe" name="UserName" value="{{ $->name }}">
    
    </div>
    <div class="mb-3">
        <label for="UserEmail" class="form-label">Email address</label>
        <input type="email" class="form-control" id="UserEmail" placeholder="name@example.com" name="UserEmail" value="{{ $user->email }}" disabled>
    
    </div>
    <div class="mb-3">
        <label for="UserPhone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="UserPhone" placeholder="name@example.com" name="UserPhone" value="{{ $identitycard->phone_number }}" >
    
    </div>
    <img src="{{ url('public/Image/Users/'.$user->profile_picture) }}" alt="User Profile Picture">
    <div class="mb-3">
        <label for="UserProfile" class="form-label">Profile Picture</label>
        <input type="file" class="form-control" id="UserProfile" placeholder="UserProfilePicture" name="UserProfile">
    </div>
    <div class="mb-3">
        <input type="submit" value="Update" class="form-control btn btn-primary">
    </div>
</form>
</div>
@endsection