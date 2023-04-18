<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'parent_phone' =>  'required|digits:8|unique:students,parent_phone,' . $this->id,
            'parent_email' => 'required|email|unique:students,parent_email,' . $this->id ,
            'gender' => 'required|min:3',
            'date_of_birth' => 'required|date',
        ];
    }
}
