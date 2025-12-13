@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="mb-4">Edit Post</h2>

      <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            value="{{ old('title', $post->title) }}">
          @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
            rows="4">{{ old('description', $post->description) }}</textarea>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="post_creator" class="form-label">Post Creator</label>
          <select class="form-select @error('post_creator') is-invalid @enderror" id="post_creator" name="post_creator">
            <option value="">-- Select Creator --</option>
            @foreach ($users as $user)
              <option value="{{ $user->name }}"
                {{ old('post_creator', $post->post_creator) == $user->name ? 'selected' : '' }}>
                {{ $user->name }}
              </option>
            @endforeach
          </select>
          @error('post_creator')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="image" class="form-label">Image (optional - only .jpg, .png)</label>
          @if ($post->image)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" width="100" class="img-thumbnail">
              <p class="text-muted small">Current image (uploading new one will replace it)</p>
            </div>
          @endif
          <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
            accept=".jpg,.png">
          @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>
@endsection
