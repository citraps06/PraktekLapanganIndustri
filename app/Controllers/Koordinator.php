<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\InformasiModel;
use App\Models\DataPliModel;
use App\Models\PliModel;
use App\Models\DosenModel;
use App\Models\PeriodeModel;


class Koordinator extends BaseController
{
    protected $info;
    protected $dataPli;
    protected $pli;
    protected $dosen;
    protected $periode;

    public function __construct()
    {
        $this->info = new InformasiModel();
        $this->dataPli = new DataPliModel();
        $this->pli = new PliModel();
        $this->dosen = new DosenModel();
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
        return view('koordinator/index', $data);
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


    public function download_lhs($id)
    {
        $download = new DataPliModel();
        $down = $download->where('NIM', $id)->first();
        return $this->response->download('filePli/' . $down['File_Lhs'], null);
    }


    public function download_proposal($id)
    {
        $download = new DataPliModel();
        $down = $download->where('NIM', $id)->first();
        return $this->response->download('filePli/' . $down['File_Lhs'], null);
    }


    public function data_mhs()
    {
        $currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;
        $jurusan = session()->get('jurusan_koor');
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $pli = $this->dataPli->where('Jurusan', $jurusan)->where('Status', 'Pending')->search($keyword);
        } else {
            $pli = $this->dataPli->where('Jurusan', $jurusan)->where('Status', 'Pending')->orderBy('NIM', 'asc');
        }

        // $coba = $this->dataPli->where('Status', 'Diterima')->orLike('Status','Ditolak')->findAll();

        $data = [
            'info' => $pli->paginate(10, 'pli'), //mengatur berapa data paginate
            'pager' => $this->dataPli->pager, //memanggil paginate
            'currentPage' => $currentPage,

        ];
        return view('koordinator/dataMhs', $data);
    }


    public function status_mhs()
    {

        $currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;
        $jurusan = session()->get('jurusan_koor');

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
            $pli = $this->dataPli->where('Jurusan', $jurusan)->where('Status !=', 'Pending')->search($keyword);
            $nama_periode="";
        }elseif ($keyword1) {
          $pli = $this->dataPli->where('Jurusan',$jurusan)->where('Status !=', 'Pending')->where('periode',$keyword1)->orderBy('NIM', 'asc');
          $nama_periode= $keyword1;
        } else {
            $pli = $this->dataPli->where('Jurusan', $jurusan)->where('Status !=', 'Pending')->where('periode',$periode)->orderBy('NIM', 'asc');
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
        return view('koordinator/statusMhs', $data);
    }


    public function update_datamhs($id)
    {
        $data = [
            'info' => $this->dataPli->where('Id_Pli', $id)->first()
        ];
        return view('koordinator/updateStatusPli', $data);
    }

    public function edit()
    {
        $tangkap = $this->request->getVar('id');
        $data = [
            'Status' => $this->request->getVar('status')
        ];
        $this->pli->update($tangkap, $data);
        return redirect()->to('/koordinator/data_mhs');
    }


    public function dpl_mhs()
    {

        $currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;
        $jurusan = session()->get('jurusan_koor');

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
            $pli = $this->dataPli->where('Jurusan', $jurusan)->where('Status', 'Diterima')->search($keyword);
            $nama_periode="";
        } elseif ($keyword1) {
          $pli = $this->dataPli->where('Jurusan',$jurusan)->where('Status', 'Diterima')->where('periode',$keyword1)->orderBy('NIM', 'asc');
          $nama_periode= $keyword1;
        } else {
            $pli = $this->dataPli->where('Jurusan', $jurusan)->where('Status', 'Diterima')->where('periode',$periode)->orderBy('NIM', 'asc');
            $nama_periode=$periode;
        }

        $periode1 = $this->periode->orderBy('periode','dsc')->findAll();

        $data = [
            'info' => $pli->paginate(10, 'dpl'), //mengatur berapa data paginate
      			'info1' => $periode1,
      			'info2' => $nama_periode,
            'pager' => $this->dataPli->pager, //memanggil paginate
            'currentPage' => $currentPage
        ];
        return view('koordinator/dospem', $data);
    }


    public function update_dospem($id)
    {
        $jurusan = session()->get('jurusan_koor');
        $data = [
            'info' => $this->dataPli->where('Id_Pli', $id)->first(),
            'dosen' => $this->dosen->where('Jurusan_Dsn', $jurusan)->Where('Status', 'Dosen')->findAll()
        ];
        return view('koordinator/dospemMhs', $data);
    }

    public function edit_dospem()
    {
        $data = [
            'NID' => $this->request->getVar('dospem')
        ];
        $tampung = $this->request->getVar('id');
        $this->pli->update($tampung, $data);
        return redirect()->to('/koordinator/dpl_mhs');
    }


    // public function delete_dospem($id)
    // {
    //     $this->dospem->delete($id);
    //     return redirect()->to('/koordinator/dpl_mhs');
    // }


    public function nilai_mhs()
    {
        //BELUM ADA DATA DI TAVEL VIEW NYA
        $currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;
        $jurusan = session()->get('jurusan_koor');

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
            $pli = $this->dataPli->where('Jurusan', $jurusan)->where('Akred !=', '')->search($keyword);
            $nama_periode="";
        } elseif ($keyword1) {
          $pli = $this->dataPli->where('Jurusan',$jurusan)->where('Akred !=', '')->where('periode',$keyword1)->orderBy('NIM', 'asc');
          $nama_periode= $keyword1;
        } else {
            $pli = $this->dataPli->where('Jurusan', $jurusan)->where('Akred !=', '')->where('periode',$periode)->orderBy('NIM', 'asc');
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
        return view('koordinator/nilaiMhs', $data);
    }


    public function update_nilai($id)
    {
        $data = [
            'info' => $this->dataPli->where('Id_Pli', $id)->first()
        ];
        return view('koordinator/updateNilai', $data);
    }

    public function edit_nilai()
    {
        $data = [
            'Verifikasi' => $this->request->getVar('status')
        ];
        $id = $this->request->getVar('id');
        $this->pli->update($id, $data);
        return redirect()->to('/koordinator/nilai_mhs');
    }
}
