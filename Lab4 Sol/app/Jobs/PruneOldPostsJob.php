<?php

namespace App\Jobs;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PruneOldPostsJob implements ShouldQueue
{
  use Queueable;

  public function __construct() {}

  public function handle(): void
  {
    $twoYearsAgo = Carbon::now()->subYears(2);

    $oldPosts = Post::where('created_at', '<', $twoYearsAgo)->get();

    foreach ($oldPosts as $post) {
      $post->deleteImage();
      $post->delete();
    }
  }
}