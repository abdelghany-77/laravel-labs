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
          <td>{{ $post->post_creator }}</td>
          <td>{{ $post->created_at->diffForHumans() }}</td>
          <td>
            <a href="{{ route('posts.show', $post) }}" class="btn btn-info">View</a>
            <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Are you sure you want to delete this post?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{-- Pagination Links --}}
  <div class="d-flex justify-content-center">
    {{ $posts->links() }}
  </div>
@endsection
