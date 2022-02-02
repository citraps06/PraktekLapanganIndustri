<?php

namespace App\Models;

use CodeIgniter\Model;

class CoachingModel extends Model
{
    protected $table      = 'coaching';
    protected $primaryKey = 'Id_Coaching';
    protected $useTimestamps = false;
    protected $allowedFields = ['NIM', 'Total_sks', 'File_Lhs', 'id_periode', 'Status'];
}
