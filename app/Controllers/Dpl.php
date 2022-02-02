<?php

namespace App\Controllers;


use CodeIgniter\I18n\Time;
use App\Models\InformasiModel;
use App\Models\CoachingModel;
use App\Models\DataCoachingModel;
use App\Models\DataPliModel;
use App\Models\PliModel;
use App\Models\PeriodeModel;


class Dpl extends BaseController
{
    protected $info;
    protected $coaching;
    protected $dataCoaching;
    protected $dataPli;
    protected $pli;
    protected $periode;

    public function __construct()
    {
        $this->info = new InformasiModel();
        $this->coaching = new CoachingModel();
        $this->dataCoaching = new DataCoachingModel();
        $this->dataPli = new DataPliModel();
        $this->pli = new PliModel();
        $this->periode = new PeriodeModel();
    }


    public function index()
    {
      $currentPage = $this->request->getVar('page_data_coaching') ? $this->request->getVar('page_data_coaching') : 1;

  		// $informasi = $this->info->orderBy('id_info','desc');
  		$id_info = $this->info->orderBy('id_info','desc')->first();


  		$data = [
  				'iklan' => $this->info->orderBy('id_info','desc')->paginate(5, 'status'), //mengatur berapa data paginate
  				'info' => $id_info,
  				'pager' => $this->info->pager, //memanggil paginate
  				'currentPage' => $currentPage
  		];
        return view('Dpl/index', $data);
    }


    public function pdf($id)
  	{
  		$informasi = new InformasiModel();
  		$info = $informasi->where('id_info', $id)->first();
  		$data =[
  			'info' => $info
  		];
  		return view('admin/pdf', $data);
  		// return $this->response->download('fileInformasi/' . $info['File'], null);
  	}


      public function data_mhs()
      {

          $currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;
          $nama_dsn = session()->get('nama_dsn');

          $sekarang = Time::now('Asia/Jakarta', 'id_ID');
          $tahun = $sekarang->toLocalizedString('yyyy');
          $bulan = $sekarang->toLocalizedString('M');
          if ($bulan >= 7 && $bulan <= 12) {
            $periode = 'Juli-Desember '.$tahun;
          }elseif ($bulan >= 1 && $bulan <= 6) {
            $periode = 'Januari-Juni '.$tahun;
          }

          $keyword = $this->request->getVar('keyword');
      		$keyword1 = $this->request->getVar('keyword1');
          if ($keyword) {
              $pli = $this->dataPli->where('Nama_Dsn', $nama_dsn)->search($keyword);
              $nama_periode="";
          } elseif ($keyword1) {
              $pli = $this->dataPli->where('Nama_Dsn', $nama_dsn)->where('periode',$keyword1)->orderBy('NIM', 'asc');
              $nama_periode= $keyword1;
          } else {
              $pli = $this->dataPli->where('Nama_Dsn', $nama_dsn)->where('periode',$periode)->orderBy('NIM', 'asc');
              $nama_periode=$periode;
          }

          $periode1 = $this->periode->orderBy('periode','dsc')->findAll();

          $data = [
              'info' => $pli->paginate(10, 'pli'), //mengatur berapa data paginate
              'info1' => $periode1,
              'info2' => $nama_periode,
              'pager' => $this->dataPli->pager, //memanggil paginate
              'currentPage' => $currentPage
          ];
          return view('Dpl/dataMhs', $data);
      }


    public function nilai_mhs()
    {
        //BELUM ADA DATA DI TABEL VIEW
        $currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;
        $nama_dsn = session()->get('nama_dsn');

        $sekarang = Time::now('Asia/Jakarta', 'id_ID');
        $tahun = $sekarang->toLocalizedString('yyyy');
        $bulan = $sekarang->toLocalizedString('M');
        if ($bulan >= 7 && $bulan <= 12) {
          $periode = 'Juli-Desember '.$tahun;
        }elseif ($bulan >= 1 && $bulan <= 6) {
          $periode = 'Januari-Juni '.$tahun;
        }

        $keyword = $this->request->getVar('keyword');
    		$keyword1 = $this->request->getVar('keyword1');
        if ($keyword) {
            $pli = $this->dataPli->where('Nama_Dsn', $nama_dsn)->search($keyword);
            $nama_periode="";
        } elseif ($keyword1) {
            $pli = $this->dataPli->where('Nama_Dsn', $nama_dsn)->where('periode',$keyword1)->orderBy('NIM', 'asc');
            $nama_periode= $keyword1;
        } else {
            $pli = $this->dataPli->where('Nama_Dsn', $nama_dsn)->where('periode',$periode)->orderBy('NIM', 'asc');
            $nama_periode=$periode;
        }

        $periode1 = $this->periode->orderBy('periode','dsc')->findAll();
        $data = [
            'info' => $pli->paginate(10, 'pli'), //mengatur berapa data paginate
            'info1' => $periode1,
            'info2' => $nama_periode,
            'pager' => $this->dataPli->pager, //memanggil paginate
            'currentPage' => $currentPage
        ];
        return view('Dpl/nilaiMhs', $data);
    }


    public function download_surv($id)
    {
        $download = new DataPliModel();
        $down = $download->where('NIM', $id)->first();
        return $this->response->download('filePli/' . $down['File_surv'], null);
    }


    public function download_dpl($id)
    {
        $download = new DataPliModel();
        $down = $download->where('NIM', $id)->first();
        return $this->response->download('filePli/' . $down['File_Dpl'], null);
    }


    public function download_laporan($id)
    {
        $download = new DataPliModel();
        $down = $download->where('NIM', $id)->first();
        return $this->response->download('filePli/' . $down['Laporan'], null);
    }


    public function update_nilai($id)
    {
        $data = [
            'info' => $this->dataPli->where('Id_Pli', $id)->first()
        ];
        return view('/dpl/updateNilai', $data);
    }

    public function edit_nilai()
    {
        $dapat = $this->request->getVar('id');

        $filelhs    = $this->request->getFile('file_dpl'); //ambil file
        $namaLhs    = $filelhs->getClientName(); //generate nama file

        $dpl = $this->request->getVar('nilai_dpl');
        $surv = $this->request->getVar('nilai_surv');
        $total = $dpl + $surv;
        $rata = $total / 2;
        if ($rata < 101 && $rata > 84) {
            $akred = 'A';
        } elseif ($rata < 85  && $rata > 79) {
            $akred = 'A-';
        } elseif ($rata < 80  && $rata > 74) {
            $akred = 'B+';
        } elseif ($rata < 75  && $rata > 69) {
            $akred = 'B';
        } elseif ($rata < 70  && $rata > 64) {
            $akred = 'B-';
        } elseif ($rata < 65  && $rata > 59) {
            $akred = 'C+';
        } elseif ($rata < 60  && $rata > 54) {
            $akred = 'C';
        } elseif ($rata < 55  && $rata > 49) {
            $akred = 'C-';
        } elseif ($rata < 50  && $rata > 39) {
            $akred = 'D';
        } else {
            $akred = 'E';
        }
        // dd($akred);
        $data = [
            'File_Dpl' => $namaLhs,
            'Nilai_surv' => $surv,
            'Nilai_Dpl' => $dpl,
            'Total_Nilai' => $total,
            'Nilai_Akhir' => $rata,
            'Akred' => $akred
        ];
        $filelhs->move('filePli/', $namaLhs); //file pindah ke folder file

        $this->pli->update($dapat, $data);
        return redirect()->to('/dpl/nilai_mhs');
    }
}
