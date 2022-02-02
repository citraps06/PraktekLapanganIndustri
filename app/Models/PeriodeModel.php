<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeModel extends Model
{
    protected $table      = 'periode';
    protected $primaryKey = 'id_periode';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_periode', 'periode']; //tabel yang ada di data base

}
