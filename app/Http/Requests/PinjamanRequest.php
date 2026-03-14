<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pinjaman;

class PinjamanRequest extends FormRequest
{
    protected ?Pinjaman $pinjaman = null;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->pinjaman = $this->route('pinjaman');
    }

    public function rules(): array
    {
        return [
            'anggota_id'      => 'required|exists:anggota,id',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'tenor'           => 'required|integer|min:1',
            'bunga'           => 'required|numeric|min:0',
        ];
    }
}
