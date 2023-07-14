<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            // 'title'       => ['required', 'string'],
            // 'message'     => ['required', 'string'],
            'application_id' => ['required', 'integer', 'exists:applications,id'],
            'module_id' => ['required', 'integer', 'exists:modules,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}