<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'user_id' =>  ['required', 'integer', Rule::exists('users', 'id')],
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'body' => ['required', 'string', 'min:2', 'max:500'],

        ];
    }
}
