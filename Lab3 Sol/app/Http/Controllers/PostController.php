<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::paginate(10);
    return view('posts.index', compact('posts'));
  }

  public function create()
  {
    $users = User::all();
    return view('posts.create', compact('users'));
  }

  public function store(StorePostRequest $request)
  {
    $data = $request->validated();

    if ($request->hasFile('image')) {
      $data['image'] = $request->file('image')->store('posts', 'public');
    }
    Post::create($data);

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
  }

  public function show(Post $post)
  {
    $post->load('comments');
    return view('posts.show', compact('post'));
  }

  public function edit(Post $post)
  {
    $users = User::all();
    return view('posts.edit', compact('post', 'users'));
  }

  public function update(UpdatePostRequest $request, Post $post)
  {
    $data = $request->validated();

    if ($request->hasFile('image')) {
      $post->deleteImage();
      $data['image'] = $request->file('image')->store('posts', 'public');
    }

    $post->update($data);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
  }

  public function destroy(Post $post)
  {
    $post->deleteImage();

    $post->delete();
    return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
  }
}