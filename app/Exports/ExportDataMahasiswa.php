<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDataMahasiswa implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ganti 'mahasiswa' dengan nama tabel yang sesuai
        return User::with('gugus')->orderBy('gugus_id', 'asc')->orderBy('no_gugus', 'asc')->get()->map(function ($user) {
            return [
                $user->id,
                $user->nama,
                $user->gugus_id,
                $user->no_gugus,
                $user->gugus->link_gugus // Gugus Name
            ];
        });
    }

    // Implement method untuk menambahkan judul kolom di Excel
    public function headings(): array
    {
        return [
            'ID',
            'NIM',
            'Gugus ID',
            'No Gugus',
            'Link Grup'
            // Tambahkan kolom lainnya sesuai kebutuhan
        ];
    }
}
