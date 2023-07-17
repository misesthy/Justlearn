<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string'],
            'message'     => ['required', 'string'],
            'categories'  => [            'array', 'exists:categories,id'],
            'priority_id' => ['required', 'integer', 'exists:priorities,id'],
            'status_id'   => ['nullable', 'integer', 'exists:statuses,id'],
            'assigned_to' => ['required', 'exists:services,id'],
            // 'attachments' => ['nullable', 'array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}