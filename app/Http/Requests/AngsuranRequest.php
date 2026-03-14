<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Angsuran;

class AngsuranRequest extends FormRequest
{
    protected ?Angsuran $angsuran = null;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->angsuran = $this->route('angsuran');
    }

    public function rules(): array
    {
        return [
            'pinjaman_id'     => 'required|exists:pinjaman,id',
            'jumlah_angsuran' => 'required|numeric|min:0',
        ];
    }
}
