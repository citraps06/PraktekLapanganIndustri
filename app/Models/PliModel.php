<?php

namespace App\Models;

use CodeIgniter\Model;

class PliModel extends Model
{
    protected $table      = 'pli';
    protected $primaryKey = 'Id_Pli';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'NIM','id_periode', 'NID', 'Total_sks',
        'File_Lhs', 'Proposal',
        'Id_Perusahaan', 'Bidang', 'Tanggal_Masuk',
        'Tanggal_Keluar', 'Laporan',
        'Nilai_surv', 'File_surv',
        'Nilai_Dpl', 'File_Dpl',
        'Total_Nilai', 'Nilai_Akhir',
        'Akred', 'Status', 'Verifikasi'

    ];
}
