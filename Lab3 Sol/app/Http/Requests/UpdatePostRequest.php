<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    $postId = $this->route('post')->id;

    return [
      'title' => [
        'required',
        'min:3',
        Rule::unique('posts', 'title')->ignore($postId),
      ],
      'description' => 'required|min:10',
      'post_creator' => 'required|exists:users,name',
      'image' => 'nullable|image|mimes:jpg,png|max:2048',
    ];
  }
}
