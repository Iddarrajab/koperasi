<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Anggota;

class AnggotaRequest extends FormRequest
{
    protected ?Anggota $anggota = null;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->anggota = $this->route('anggota');

        if (!$this->filled('kode_anggota')) {
            $this->merge([
                'kode_anggota' => $this->generateUniqueCode(),
            ]);
        }

        if (!$this->filled('nomor_anggota')) {
            $this->merge([
                'nomor_anggota' => $this->generateUniqueNomor(),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'kode_anggota' => [
                'required',
                Rule::unique('anggota', 'kode_anggota')->ignore($this->anggota?->id),
            ],
            'nomor_anggota' => [
                'required',
                Rule::unique('anggota', 'nomor_anggota')->ignore($this->anggota?->id),
            ],
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('anggota', 'email')->ignore($this->anggota?->id),
            ],
            'password' => $this->isMethod('POST')
                ? 'required|min:6'
                : 'nullable|min:6',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|min:10|max:16',
            'status_anggota' => 'nullable|in:aktif,nonaktif',
        ];
    }

    protected function generateUniqueCode(int $length = 8): string
    {
        do {
            $code = strtoupper(str()->random($length));
        } while (Anggota::where('kode_anggota', $code)->exists());

        return $code;
    }

    protected function generateUniqueNomor(int $length = 6): string
    {
        do {
            $nomor = str_pad(rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
        } while (Anggota::where('nomor_anggota', $nomor)->exists());

        return $nomor;
    }
}
