<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Admin;

class AdminRequest extends FormRequest
{
    protected ?Admin $admin = null;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->admin = $this->route('admin');
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('admin', 'email')->ignore($this->admin?->id),
            ],
            'password' => $this->admin
                ? 'nullable|string|min:6'
                : 'required|string|min:6',
        ];
    }
}
