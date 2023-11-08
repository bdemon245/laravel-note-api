<?php

namespace App\Http\Requests\Note\Api;

use Illuminate\Foundation\Http\FormRequest;

class NoteStoreApiRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            'title'   => "nullable|string|max:255",
            'content' => "required|string"
        ];
    }
}
