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

      <div class="card">
        <div class="card-header bg-light">
          <strong>Post Creator Info</strong>
        </div>
        <div class="card-body">
          <p><strong class="text">Name</strong> :- {{ $post->post_creator }}</p>
          <p><strong class="text">Email</strong> :- {{ strtolower($post->post_creator) }}@gmail.com</p>
          <p><strong class="text">Created At</strong> :- {{ $post->created_at->format('Y-m-d') }}
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
