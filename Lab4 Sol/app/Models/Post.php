<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Post extends Model
{
  use HasFactory, Sluggable;

  protected $fillable = [
    'title',
    'description',
    'post_creator',
    'slug',
    'image',
  ];

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }

  public function comments()
  {
    return $this->morphMany(Comment::class, 'commentable');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'post_creator', 'name');
  }

  public function getImageUrlAttribute()
  {
    if ($this->image) {
      return Storage::url($this->image);
    }
    return null;
  }

  public function deleteImage()
  {
    if ($this->image && Storage::exists($this->image)) {
      Storage::delete($this->image);
    }
  }
}
