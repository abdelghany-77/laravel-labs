<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->string('slug')->nullable()->after('title');
      $table->string('image')->nullable()->after('post_creator');
    });

    $posts = DB::table('posts')->get();
    foreach ($posts as $post) {
      $slug = Str::slug($post->title);
      $count = DB::table('posts')->where('slug', $slug)->where('id', '!=', $post->id)->count();
      if ($count > 0) {
        $slug = $slug . '-' . $post->id;
      }
      DB::table('posts')->where('id', $post->id)->update(['slug' => $slug]);
    }

    Schema::table('posts', function (Blueprint $table) {
      $table->string('slug')->nullable(false)->unique()->change();
    });
  }

  public function down(): void
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->dropColumn(['slug', 'image']);
    });
  }
};