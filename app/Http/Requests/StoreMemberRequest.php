<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:150',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'required|in:aktif,non-aktif',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama anggota wajib diisi.',
            'nama.max' => 'Nama anggota maksimal 150 karakter.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.max' => 'NIM maksimal 20 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.max' => 'Nomor telepon maksimal 20 karakter.',
            'status.required' => 'Status anggota wajib dipilih.',
            'status.in' => 'Pilihan status tidak valid.',
        ];
    }
}