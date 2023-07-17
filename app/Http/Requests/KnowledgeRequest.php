<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KnowledgeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string'],
            'full_text'     => ['required', 'string'],
            'module_id' => ['required', 'integer', 'exists:modules,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
} 
 