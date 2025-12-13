<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(Request $request, Post $post)
  {
    $post->comments()->create([
      'body' => $request->body,
    ]);
    return redirect()->route('posts.show', $post);
  }

  public function update(Request $request, Post $post, Comment $comment)
  {
    $comment->update([
      'body' => $request->body,
    ]);
    return redirect()->route('posts.show', $post);
  }

  public function destroy(Post $post, Comment $comment)
  {
    $comment->delete();
    return redirect()->route('posts.show', $post);
  }
}