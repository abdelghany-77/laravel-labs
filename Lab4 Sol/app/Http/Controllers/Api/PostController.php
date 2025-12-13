<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePostApiRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::with('user')->paginate(10);

    return PostResource::collection($posts);
  }

  public function show(Post $post)
  {
    $post->load('user');

    return new PostResource($post);
  }

  public function store(StorePostApiRequest $request)
  {
    $data = $request->validated();
    $data['post_creator'] = $request->user()->name;

    if ($request->hasFile('image')) {
      $data['image'] = $request->file('image')->store('posts', 'public');
    }

    $post = Post::create($data);
    $post->load('user');

    return (new PostResource($post))->response()->setStatusCode(201);
  }
}
