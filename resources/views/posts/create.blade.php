
@extends('layouts.app')
@section('title','Register')

@section('content')
<div class="container">
    <h1 class="text-center">Create a new post</h1>
    <form action="/posts/create" method="post" enctype="multipart/form-data">
      @csrf
    <div class="mb-3 row">
        <label for="PostTitle" class="col-sm-2 col-form-label">Post Title</label>
        <div class="col-sm-10">
          <input type="text"  class="form-control" id="PostTitle" name="PostTitle">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="PostImage" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
          <input type="file" class="form-control" id="PostImage" name="PostImage">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="PostContent" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="PostContent" rows="3" name="PostContent"></textarea>
          </div>
      </div>
      <input type="submit" value="Create" class="btn btn-primary form-control">
    </form>
</div>

@endsection