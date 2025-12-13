@extends('layouts.app')

@section('content')
  <div class="text-center mb-4">
    <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Slug</th>
        <th>Image</th>
        <th>Posted By</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
        <tr>
          <td class="text-danger">{{ $post->id }}</td>
          <td>{{ $post->title }}</td>
          <td><code>{{ $post->slug }}</code></td>
          <td>
            @if ($post->image)
              <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="50" height="50"
                style="object-fit: cover;">
            @else
              <span class="text-muted">No Image</span>
            @endif
          </td>
          <td>{{ $post->post_creator }}</td>
          <td>{{ $post->created_at->diffForHumans() }}</td>
          <td>
            <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Are you sure you want to delete this post?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{-- Pagination Links --}}
  <div class="d-flex justify-content-center">
    {{ $posts->links('pagination::bootstrap-5') }}
  </div>
@endsection
