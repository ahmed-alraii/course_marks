<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'phone' =>  'required|digits:8|unique:teachers,phone,' . $this->id,
            'email' => 'required|email|unique:teachers,email,' . $this->id ,
            'specialization' => 'required|min:3',

        ];
    }
}
