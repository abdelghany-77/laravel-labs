<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

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

  public function store(Request $request)
  {
    Post::create([
      'title' => $request->title,
      'description' => $request->description,
      'post_creator' => $request->post_creator,
    ]);

    return redirect()->route('posts.index');
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

  public function update(Request $request, Post $post)
  {
    $post->update([
      'title' => $request->title,
      'description' => $request->description,
      'post_creator' => $request->post_creator,
    ]);

    return redirect()->route('posts.index');
  }

  public function destroy(Post $post)
  {
    $post->delete();
    return redirect()->route('posts.index');
  }
}
