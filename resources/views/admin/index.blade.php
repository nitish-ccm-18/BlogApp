@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/admin/user/create" class="btn btn-primary">Add User</a>
            <div class="card">
                <h1 class="text-center">Admin Area</h1>
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
            <table border="5" class="table">
                <tr>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            
                @foreach ($users as $user)
                <tr>
                    <td><img src="{{ url('public/Image/'.$user->profile_picture) }}" alt="User Profile Picture" height="50" width="50"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="/admin/user/show/{{ $user->id }}">Show</a></td>
                    <td><a href="/admin/user/edit/{{ $user->id }}">Edit</a></td>
                    <td><a href="/admin/user/delete/{{ $user->id }}">Delete</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
