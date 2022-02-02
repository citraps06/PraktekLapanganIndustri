<?php

namespace App\Models;

use CodeIgniter\Model;

class DataCoachingModel extends Model
{
    protected $table      = 'data_coaching';
    protected $useTimestamps = false;

    public function search($keyword)
    {
        return $this->table('data_coaching')
            ->where('NIM', $keyword);
        // ->orLike('Nama_Mhs', $keyword)
        // ->orLike('Total_sks', $keyword)
        // ->orLike('File_Lhs', $keyword)
        // ->orLike('Jurusan', $keyword)
        // ->orLike('Status', $keyword);
    }
}
