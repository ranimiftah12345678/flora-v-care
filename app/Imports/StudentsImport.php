<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    public int $importedCount = 0;

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            $attributes = $row->toArray();
            $validator = Validator::make($attributes, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[a-zA-Z0-9._-]+$/', 'unique:users,username'],
                'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:12', 'max:255'],
                'inisial' => ['required', 'string', 'max:10'],
                'kelas' => ['required', 'in:X,XI,XII'],
                'usia' => ['required', 'integer', 'between:10,25'],
                'sekolah' => ['required', 'string', 'max:150'],
            ]);

            if ($validator->fails()) {
                throw ValidationException::withMessages([
                    'file' => 'Baris '.($index + 2).': '.$validator->errors()->first(),
                ]);
            }

            $data = $validator->validated();
            $student = new User;
            $student->name = $data['name'];
            $student->username = mb_strtolower($data['username']);
            $student->email = $data['email'] ?? null;
            $student->password = $data['password'];
            $student->role = 'siswi';
            $student->is_active = true;
            $student->password_change_required = true;
            $student->save();
            $student->studentProfile()->create([
                'inisial' => mb_strtoupper($data['inisial']),
                'kelas' => $data['kelas'],
                'usia' => $data['usia'],
                'sekolah' => $data['sekolah'],
            ]);
            $this->importedCount++;
        }
    }
}
