<?php

namespace App\Models;

use CodeIgniter\Model;

class InformasiModel extends Model
{
    protected $table      = 'informasi';
    protected $primaryKey = 'id_info';
    protected $useTimestamps = false;
    protected $allowedFields = ['Judul', 'Keterangan', 'Tanggal', 'File']; //tabel yang ada di data base
}
