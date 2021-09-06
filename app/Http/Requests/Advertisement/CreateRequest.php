<?php

declare(strict_types=1);

namespace App\Http\Requests\Advertisement;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1023',
            'files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'files' => 'max:3',
        ];
    }
}
