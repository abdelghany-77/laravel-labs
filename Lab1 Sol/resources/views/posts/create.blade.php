@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" form="createForm">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" form="createForm"></textarea>
      </div>

      <div class="mb-3">
        <label for="post_creator" class="form-label">Post Creator</label>
        <select class="form-select" id="post_creator" name="post_creator" form="createForm">
          <option value="Ahmed">Ahmed</option>
          <option value="Mohamed">Mohamed</option>
          <option value="Ali">Ali</option>
        </select>
      </div>

      <form id="createForm" action="{{ route('posts.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Create</button>
      </form>
    </div>
  </div>
@endsection
