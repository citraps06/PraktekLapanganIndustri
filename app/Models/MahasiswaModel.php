<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'NIM';
    protected $useTimestamps = false;
    protected $allowedFields = ['NIM', 'Thn_masuk', 'Nama_Mhs', 'Jurusan', 'Prodi', 'Jk', 'No_Hp', 'Email', 'Password']; //tabel yang ada di data base

}
