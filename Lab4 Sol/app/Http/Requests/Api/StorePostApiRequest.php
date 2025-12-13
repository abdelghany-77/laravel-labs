<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StorePostApiRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'title' => 'required|string|min:3|unique:posts,title',
      'description' => 'required|string|min:10',
      'image' => 'nullable|image|mimes:jpg,png|max:2048',
    ];
  }
}
