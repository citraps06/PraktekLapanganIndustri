<?php

namespace App\Models;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table      = 'perusahaan';
    protected $primaryKey = 'Id_Perusahaan';
    protected $useTimestamps = false;
    protected $allowedFields = ['Id_Perusahaan', 'Password', 'Nama_Perusahaan', 'Alamat_Perusahaan', 'Nama_Ceo', 'Nama_Surv', 'Berkas_Perusahaan', 'Tanggal_Berdiri', 'Status'];
}
