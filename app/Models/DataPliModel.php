<?php

namespace App\Models;

use CodeIgniter\Model;

class DataPliModel extends Model
{
    protected $table      = 'data_pli';
    protected $primaryKey = 'Id_Pli';
    protected $useTimestamps = true;


    public function search($keyword)
    {
        return $this->table('data_pli')
            ->where('NIM', $keyword);
        // ->orLike('Nama_Mhs', $keyword)
        // ->orLike('Total_sks', $keyword)
        // ->orLike('Perusahaan ', $keyword)
        // ->orLike('Alamat', $keyword);
    }
}
