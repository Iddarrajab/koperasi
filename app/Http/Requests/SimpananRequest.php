<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'anggota_id'     => 'required|exists:anggota,id',
            'jenis_simpanan' => 'required|in:simpanan_pokok,simpanan_wajib,simpanan_sukarela',
            'jumlah_setoran' => 'required|numeric|min:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_simpanan.in' => 'Jenis simpanan tidak valid.',
            'jumlah_setoran.min' => 'Jumlah setoran minimal 1.000.',
        ];
    }
}
