@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mb-4">
        <div class="card-header bg-light">
          <strong>Post Info</strong>
        </div>
        <div class="card-body">
          <p><strong class="text">Title</strong> :- {{ $post->title }}</p>
          <p><strong class="text">Description</strong> :-</p>
          <p>{{ $post->description }}</p>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-light">
          <strong>Post Creator Info</strong>
        </div>
        <div class="card-body">
          <p><strong class="text">Name</strong> :- {{ $post->post_creator }}</p>
          <p><strong class="text">Email</strong> :- {{ strtolower($post->post_creator) }}@gmail.com</p>
          <p><strong class="text">Created At</strong> :- {{ $post->created_at->diffForHumans() }}</p>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header bg-light">
          <strong>Comments ({{ $post->comments->count() }})</strong>
        </div>
        <div class="card-body">
          <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
              <label for="body" class="form-label">Add a Comment</label>
              <textarea class="form-control" id="body" name="body" rows="2" required></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Add Comment</button>
          </form>

          <hr>

          @forelse ($post->comments as $comment)
            <div class="card mb-2">
              <div class="card-body">
                <div id="edit-form-{{ $comment->id }}" style="display: none;">
                  <form action="{{ route('posts.comments.update', [$post, $comment]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                      <textarea class="form-control" name="body" rows="2" required>{{ $comment->body }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    <button type="button" class="btn btn-secondary btn-sm"
                      onclick="document.getElementById('edit-form-{{ $comment->id }}').style.display='none'; document.getElementById('comment-{{ $comment->id }}').style.display='block';">Cancel</button>
                  </form>
                </div>

                <div id="comment-{{ $comment->id }}">
                  <p class="mb-1">{{ $comment->body }}</p>
                  <small class="text-muted">{{ $comment->created_at }}</small>
                  <div class="mt-2">
                    <button type="button" class="btn btn-warning btn-sm"
                      onclick="document.getElementById('edit-form-{{ $comment->id }}').style.display='block'; document.getElementById('comment-{{ $comment->id }}').style.display='none';">Edit</button>
                    <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="POST"
                      class="d-inline" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <p class="text-muted">No comments yet.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
