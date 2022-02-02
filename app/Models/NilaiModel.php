<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table      = 'nilai';
    protected $primaryKey = 'Id_Nilai';
    protected $useTimestamps = false;
    protected $allowedFields = ['NIM', 'Laporan', 'File_NilaiSurv', 'File_NilaiDpl', 'Nilai_surv', 'Nilai_Dpl', 'Total_Nilai', 'Nilai_Akhir']; //tabel yang ada di data base
}
