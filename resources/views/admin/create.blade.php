@extends('layouts.app')
@section('title','Register')

@section('content')
<div class="row justify-content-center">
<form action="/admin/user/create" method="post" class="col-md-8 " enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="UserName" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="UserEmail" placeholder="John Doe" name="UserName">
    
    </div>
    <div class="mb-3">
        <label for="UserEmail" class="form-label">Email address</label>
        <input type="email" class="form-control" id="UserEmail" placeholder="name@example.com" name="UserEmail">
    
    </div>
    <div class="mb-3">
        <label for="UserPassword" class="form-label">Password</label>
        <input type="password" class="form-control" id="UserPassword" placeholder="********" name="UserPassword">
    </div>
    <div class="mb-3">
        <label for="UserProfile" class="form-label">Profile Picture</label>
        <input type="file" class="form-control" id="UserProfile" placeholder="UserProfilePicture" name="UserProfile">
    </div>
    <div class="mb-3">
        <input type="submit" value="Create User" class="form-control btn btn-primary">
    </div>
</form>
</div>
@endsection