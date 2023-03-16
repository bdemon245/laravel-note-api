<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if ($this->method === 'PUT') {
            return [
                'title' => ['nullable'],
                'content' => ['required'],
            ];
        } else {
            return [
                'title' => ['sometimes', 'nullable'],
                'content' => ['sometimes', 'required'],
            ];
        }
    }
}
