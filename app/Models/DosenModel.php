<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table      = 'dosen';
    protected $primaryKey = 'NID';
    protected $useTimestamps = false;
    protected $allowedFields = ['NID', 'Nama_Dsn', 'Jurusan_dsn', 'Status', 'No_hp', 'Email', 'Password']; //tabel yang ada di data base

}
