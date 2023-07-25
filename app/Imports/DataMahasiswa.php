<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class DataMahasiswa implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'nim' => $row[0],
            'password' =>  $row[1],
            'nama_lengkap' => $row[2],
            'jalur_pendaftaran_id' => $row[3],
            'program_studi_id' => $row[4],
            'angkatan' => $row[5]
        ]);

        $table->string('nim')->unique();
        $table->string('password');
        $table->string('nama_lengkap');
        $table->foreignId('jalur_pendaftaran_id')->constrained('jalur_pendaftarans');
        $table->foreignId('program_studi_id')->constrained('program_studis');
        $table->year('angkatan');
    }
}
