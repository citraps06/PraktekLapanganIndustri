<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusPliModel extends Model
{
    protected $table      = 'status_pli';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'NIM', 'Nama', 'Jurusan', 'Total_sks', 'File_Lhs', 'Proposal', 'Perusahaan', 'Alamat', 'Status'
    ];
}
