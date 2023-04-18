<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
               'name' => 'required|min:3',
               'email' => 'required|email|unique:users,email,' .$this->id ,
               'password' => 'min:6|required_with:password_confirmation|same:password_confirmation,' . $this->id,
               'password_confirmation' => 'min:6,' . $this->id,
               'role_id' => 'required'

        ];
    }
}
