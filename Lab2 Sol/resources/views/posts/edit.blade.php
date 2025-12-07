@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" form="editForm">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" form="editForm">{{ $post->description }}</textarea>
      </div>

      <div class="mb-3">
        <label for="post_creator" class="form-label">Post Creator</label>
        <select class="form-select" id="post_creator" name="post_creator" form="editForm">
          @foreach ($users as $user)
            <option value="{{ $user->name }}" {{ $post->post_creator == $user->name ? 'selected' : '' }}>
              {{ $user->name }}</option>
          @endforeach
        </select>
      </div>

      <form id="editForm" action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
@endsection
