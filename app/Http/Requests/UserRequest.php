<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Auth;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $id = $this->route('user');
    return [
      'name'          => ['required', 'string', 'max:255'],
      'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
      'password'      => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed'],
      'is_admin'      => ['nullable', 'boolean'],
      'id_permission' => ['nullable', 'array']
    ];
  }
}