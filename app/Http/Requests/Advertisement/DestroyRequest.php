<?php

namespace App\Http\Requests\Advertisement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DestroyRequest extends FormRequest
{
    public function authorize(Request $request): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
