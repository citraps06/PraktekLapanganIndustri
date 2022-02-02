<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\DataPliModel;
use App\Models\PerusahaanModel;
use App\Models\PliModel;
use App\Models\PeriodeModel;


class Perusahaan extends BaseController
{
    protected $dataPli;
    protected $perusahaan;
    protected $pli;
    protected $periode;

    public function __construct()
    {
        $this->dataPli = new DataPliModel();
        $this->perusahaan = new PerusahaanModel();
        $this->pli = new PliModel();
        $this->periode = new PeriodeModel();
    }

    public function index()
    {
        $id = session()->get('id_usaha');
        $data_usaha = $this->perusahaan->where('Id_Perusahaan', $id)->first();

        $nama = $data_usaha['Nama_Perusahaan'];

        $sekarang = Time::now('Asia/Jakarta', 'id_ID');
        $tahun = $sekarang->toLocalizedString('yyyy');
        $bulan = $sekarang->toLocalizedString('M');
        if ($bulan >= 7 && $bulan <= 12) {
          $periode = 'Juli-Desember '.$tahun;
        }elseif ($bulan >= 1 && $bulan <= 6) {
          $periode = 'Januari-Juni '.$tahun;
        }

    		$keyword1 = $this->request->getVar('keyword1');
        if ($keyword1) {
            $pli = $this->dataPli->where('Nama_Perusahaan', $nama)->where('periode',$keyword1)->orderBy('NIM', 'asc')->find();
            $nama_periode= $keyword1;
        } else {
            $pli = $this->dataPli->where('Nama_Perusahaan', $nama)->where('periode',$periode)->orderBy('NIM', 'asc')->find();
            $nama_periode=$periode;
        }

        $periode1 = $this->periode->orderBy('periode','dsc')->findAll();

        $data = [
            'info' => $pli,
            'info1' => $periode1,
            'info2'=> $nama_periode
        ];
        return view('/perusahaan/index', $data);
    }


    public function update_datamhs($id)
    {
        $ubah = $this->dataPli->where('Id_Pli', $id)->first(); //ambildata berdasarkan id_info secara keseluruhan data
        // dd($ubah);
        $data = [
            'info' => $ubah
        ];
        return view('/perusahaan/update_datamhs', $data);
    }


    public function edit_datamhs()
    {
        $id = $this->request->getVar('id');
        $filelhs    = $this->request->getFile('surv'); //ambil file
        $namaLhs    = $filelhs->getClientName(); //generate nama file

        $data = [
            'File_surv'  => $namaLhs,
        ];

        $this->pli->update($id, $data); //menyimpah hasil update
        $filelhs->move('filePli/', $namaLhs); //file pindah ke folder file
        return redirect()->to('/perusahaan/index');
    }

    public function download_nilai($id)
    {
        $download = new DataPliModel();
        $down = $download->where('NIM', $id)->first();
        return $this->response->download('filePli/' . $down['File_surv'], null);
    }
}
