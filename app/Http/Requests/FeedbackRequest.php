<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Enum;
use Coderflex\LaravelTicket\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Coderflex\LaravelTicket\Enums\Priority;

class FeedbackRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string'],
            'message'     => ['required', 'string'],
            'ticket_id' => ['nullable', 'integer', 'exists:tickets,id'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'attachments' => ['nullable', 'array'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}