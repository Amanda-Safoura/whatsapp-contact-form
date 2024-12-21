<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class SendNotifFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:100|min:2',
            'phone_number' => 'required|string|regex:/^\+[0-9]+$/|min:8',
            'file' => [
                'file',
                File::types(['jpg', 'jpeg', 'png', 'pdf']),
                'max:2000'
            ],
            'message' => 'required|string'
        ];
    }
}
