<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'title' => 'required|min:3|unique:posts,title',
      'description' => 'required|min:10',
      'post_creator' => 'required|exists:users,name',
      'image' => 'nullable|image|mimes:jpg,png|max:2048',
    ];
  }

}
