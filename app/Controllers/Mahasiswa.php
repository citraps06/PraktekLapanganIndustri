<?php

namespace App\Controllers;

use App\Models\CoachingModel;
use App\Models\DataCoachingModel;
use App\Models\InformasiModel;
use App\Models\PliModel;
use App\Models\DataPliModel;
use App\Models\MahasiswaModel;
use App\Models\PerusahaanModel;
use App\Models\PeriodeModel;
use CodeIgniter\I18n\Time;

class Mahasiswa extends BaseController
{
    protected $info;
    protected $coaching;
    protected $data_coaching;
    protected $pli;
    protected $mahasiswa;
    protected $data_pli;
    protected $usaha;
    protected $periode;


    public function __construct()
    {
        $this->info         = new InformasiModel();
        $this->coaching     = new CoachingModel();
        $this->data_coaching = new DataCoachingModel();
        $this->pli          = new PliModel();
        $this->data_pli     = new DataPliModel();
        $this->mahasiswa    = new MahasiswaModel();
        $this->usaha        = new PerusahaanModel();
        $this->periode        = new PeriodeModel();
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
        return view('mahasiswa/index', $data);
        // echo session()->get('id_mhs');
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


    public function daftar_coaching()
    {
        $nim = session()->get('id_mhs');
        $bio = $this->mahasiswa->where('NIM', $nim)->first();
        $thn_masuk = $bio['Thn_masuk']; //2019 error / 2018 lanjut

        $waktu = Time::now('Asia/Jakarta', 'en_ID');
        $tahun = $waktu->getYear();
        $akses = $tahun - 2; //2019
        $berhak = $tahun - 3; //2018

        $valid = $this->data_coaching->where('NIM', $nim)->countAllResults();

        if ($thn_masuk >= $akses) {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum dapat mengkases halaman ini');
        } elseif ($thn_masuk <= $berhak && $valid > 0) {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda sudah mendaftar');
        } else {
            return view('mahasiswa/daftarCoaching');
        }
        // // dd($coba);
    }


    public function savecoaching()
    {

        $lhs = $this->request->getFile('File'); //ambil gambar
        $namaLhs = $lhs->getClientName(); //generate nama file random
        $lhs->move('fileCoaching/', $namaLhs); //file pindah ke folder file
        $nim = session()->get('id_mhs');

        $sekarang = Time::now('Asia/Jakarta', 'id_ID');
    		$tahun = $sekarang->toLocalizedString('yyyy');
    		$bulan = $sekarang->toLocalizedString('M');
        if ($bulan >= 7 && $bulan <= 12) {
          $periode = 'Juli-Desember '.$tahun;
        }elseif ($bulan >= 1 && $bulan <= 6) {
          $periode = 'Januari-Juni '.$tahun;
        }

        $id_periode = $this->periode->where('periode',$periode)->first();

        $this->coaching->save([
            'NIM'       => $nim, //getVar sesuai dengan name yang ada di text field
            'Total_sks' => $this->request->getVar('sks'), //getVar sesuai dengan name yang ada di text field
            'File_Lhs'  => $namaLhs,
            'id_periode'=> $id_periode['id_periode'],
            'Status'    => 'Pending'
        ]);
        return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Data anda tersimpan');
    }


    public function pesan()
    {
        return view('mahasiswa/pesan');
    }


    public function status_coaching()
    {
        $nim = session()->get('id_mhs');

        $valid = $this->data_coaching->where('NIM', $nim)->countAllResults();

        $data = [
            'info' => $this->data_coaching->where('NIM', $nim)->first()
        ];
        if ($valid == 0) {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum mendaftar coaching');
        }
        else {
          return view('mahasiswa/statusCoaching', $data);
        }
    }


    public function daftar_pli()
    {
        $nim = session()->get('id_mhs');
        $bio = $this->mahasiswa->where('NIM', $nim)->first();
        $thn_masuk = $bio['Thn_masuk']; //2019 error / 2018 lanjut

        $waktu = Time::now('Asia/Jakarta', 'en_ID');
        $tahun = $waktu->getYear();
        $akses = $tahun - 2; //2019
        $berhak = $tahun - 3; //2018

        $valid = $this->data_coaching->where('NIM', $nim)->countAllResults();
        $daftar  = $this->data_pli->where('NIM', $nim)->countAllResults();
        $tampung = $this->data_coaching->where('NIM', $nim)->first();
        // $status =

        $data = [
            'info' => $this->usaha->where('Status', 'Diterima')->findAll()
        ];

        if ($thn_masuk >= $akses) {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum dapat mengkases halaman ini');
        } elseif ($thn_masuk <= $berhak && $valid == 0) {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum mengikuti Coaching');
        } elseif ($thn_masuk <= $berhak && $tampung['Status'] == 'Pending') {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Status Coaching anda masih dalam proses');
        } elseif ($thn_masuk <= $berhak && $tampung['Status'] == 'Tidak Lulus') {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda gagal dalam mengikuti Coaching');
        } elseif ($thn_masuk <= $berhak && $daftar > 0) {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda sudah mendaftar');
        } else {
            return view('mahasiswa/ajukanPLI', $data);
        }
        // dd($status);
    }


    public function savepli()
    {
        //FILE LHS
        $filelhs    = $this->request->getFile('lhs'); //ambil file
        $namaLhs    = $filelhs->getClientName(); //generate nama file

        //FILE PROPOSAL
        $proposal    = $this->request->getFile('proposal'); //ambil file
        $namaProposal    = $proposal->getClientName(); //generate nama file

        $nim = session()->get('id_mhs');

        $sekarang = Time::now('Asia/Jakarta', 'id_ID');
    		$tahun = $sekarang->toLocalizedString('yyyy');
    		$bulan = $sekarang->toLocalizedString('M');
          if ($bulan >= 7 && $bulan <= 12) {
            $periode = 'Juli-Desember '.$tahun;
          }elseif ($bulan >= 1 && $bulan <= 6) {
            $periode = 'Januari-Juni '.$tahun;
          }

        $id_periode = $this->periode->where('periode',$periode)->first();

        $this->pli->save([
            'NIM'        => $nim, //getVar sesuai dengan name yang ada di text field
            'id_periode' => $id_periode['id_periode'],
            // 'NID'       => '',
            'Total_sks'  => $this->request->getVar('sks'), //getVar sesuai dengan name yang ada di text field
            'File_Lhs'   => $namaLhs,
            'Proposal'   => $namaProposal,
            'Id_Perusahaan' => $this->request->getVar('usaha'), //getVar sesuai dengan name yang ada di text field
            'Bidang'     => $this->request->getVar('bidang'), //getVar sesuai dengan name yang ada di text field
            'Tanggal_Masuk'     => $this->request->getVar('mulai'), //getVar sesuai dengan name yang ada di text field
            'Tanggal_Keluar'     => $this->request->getVar('selesai'), //getVar sesuai dengan name yang ada di text field
            'Nilai_surv'       => '',
            'File_surv'       => '',
            'Nilai_Dpl'       => '',
            'File_Dpl'       => '',
            'Total_Nilai'       => '',
            'Nilai_Akhir'       => '',
            'Akred'       => '',
            'Status'       => 'Pending',
            'Verifikasi'       => 'Pending'
        ]);
        $filelhs->move('filePli/', $namaLhs); //file pindah ke folder file
        $proposal->move('filePli/', $namaProposal); //file pindah ke folder file
        return redirect()->to('pli_sukses');
    }


    public function pli_sukses()
    {
        return view('mahasiswa/suksesPLI');
    }


    public function status_pli()
    {
        $nim = session()->get('id_mhs');

        $bio = $this->mahasiswa->where('NIM', $nim)->first();
        $thn_masuk = $bio['Thn_masuk']; //2019 error / 2018 lanjut

        $waktu = Time::now('Asia/Jakarta', 'en_ID');
        $tahun = $waktu->getYear();
        $akses = $tahun - 2; //2019
        $berhak = $tahun - 3; //2018

        $valid = $this->data_coaching->where('NIM', $nim)->countAllResults();
        $daftar  = $this->data_pli->where('NIM', $nim)->countAllResults();
        $tampung = $this->data_coaching->where('NIM', $nim)->first();
        // $status =

        $data = [
          'info' => $this->data_pli->where('NIM', $nim)->first()
        ];


        if ($thn_masuk >= $akses) {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum dapat mengkases halaman ini');
        } elseif ($thn_masuk <= $berhak && $valid == 0) {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum mengikuti Coaching');
        } elseif ($thn_masuk <= $berhak && $tampung['Status'] == 'Pending') {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Status Coaching anda masih dalam proses');
        } elseif ($thn_masuk <= $berhak && $tampung['Status'] == 'Tidak Lulus') {
            return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda gagal dalam mengikuti Coaching');
        } elseif ($thn_masuk <= $berhak && $daftar == 0) {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum mendaftar PLI');
        } else {
            return view('mahasiswa/statusPLI', $data);
        }
    }


    public function berkas()
    {
      $nim = session()->get('id_mhs');
      $bio = $this->mahasiswa->where('NIM', $nim)->first();
      $thn_masuk = $bio['Thn_masuk']; //2019 error / 2018 lanjut

      $waktu = Time::now('Asia/Jakarta', 'en_ID');
      $tahun = $waktu->getYear();
      $akses = $tahun - 2; //2019
      $berhak = $tahun - 3; //2018

      $valid = $this->data_coaching->where('NIM', $nim)->countAllResults(); //terdapat atau tidak dalam tabel coaching
      $daftar  = $this->data_pli->where('NIM', $nim)->countAllResults(); //terdapat atau tidak dalam tabel Pli
      $tampung = $this->data_coaching->where('NIM', $nim)->first(); //mangambil data tabel coaching
      $wadah = $this->data_pli->where('NIM', $nim)->first(); //mangambil data dalam tabel pli
      // $status =


      if ($thn_masuk >= $akses) {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum dapat mengkases halaman ini');
      } elseif ($thn_masuk <= $berhak && $valid == 0) {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum mengikuti Coaching');
      } elseif ($thn_masuk <= $berhak && $tampung['Status'] == 'Pending') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Status Coaching anda masih dalam proses');
      } elseif ($thn_masuk <= $berhak && $tampung['Status'] == 'Tidak Lulus') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda gagal dalam mengikuti Coaching');
      } elseif ($thn_masuk <= $berhak && $daftar == 0) {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum mendaftar dalam kegiatan PLI');
      } elseif ($thn_masuk <= $berhak && $wadah['Status'] == 'Pending') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Status PLI anda masih dalam proses');
      } elseif ($thn_masuk <= $berhak && $wadah['Status'] == 'Ditolak') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda ditolak pada perusahaan');
      } elseif ($thn_masuk <= $berhak && $wadah['Laporan'] !== '') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda sudah sudah memasukan berkas');
      } else {
          return view('mahasiswa/berkas');
      }

    }


    public function saveberkas()
    {
        //FILE LHS
        $fileLaporan    = $this->request->getFile('laporan'); //ambil file
        $laporan    = $fileLaporan->getClientName(); //generate nama file random

        //FILE PROPOSAL


        $nim = session()->get('id_mhs');
        $satu = $this->data_pli->where('NIM', $nim)->first();
        $kode = $satu['Id_Pli'];

        $data = [
            'Laporan'   => $laporan
        ];
        $this->pli->update($kode, $data);
        $fileLaporan->move('filePli', $laporan); //file pindah ke folder file
        return redirect()->to('berkas_sukeses');
    }


    public function berkas_sukeses()
    {
        return view('mahasiswa/suksesberkas');
    }


    public function nilai_mhs()
    {
      $nim = session()->get('id_mhs');
      $bio = $this->mahasiswa->where('NIM', $nim)->first();
      $thn_masuk = $bio['Thn_masuk']; //2019 error / 2018 lanjut

      $waktu = Time::now('Asia/Jakarta', 'en_ID');
      $tahun = $waktu->getYear();
      $akses = $tahun - 2; //2019
      $berhak = $tahun - 3; //2018

      $valid = $this->data_coaching->where('NIM', $nim)->countAllResults(); //terdapat atau tidak dalam tabel coaching
      $daftar  = $this->data_pli->where('NIM', $nim)->countAllResults(); //terdapat atau tidak dalam tabel Pli
      $tampung = $this->data_coaching->where('NIM', $nim)->first(); //mangambil data tabel coaching
      $wadah = $this->data_pli->where('NIM', $nim)->first(); //mangambil data dalam tabel pli
      // $status =
      $data = [
          'info' => $wadah
      ];

      if ($thn_masuk >= $akses) {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum dapat mengkases halaman ini');
      } elseif ($thn_masuk <= $berhak && $valid == 0) {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum mengikuti Coaching');
      } elseif ($thn_masuk <= $berhak && $tampung['Status'] == 'Pending') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Status Coaching anda masih dalam proses');
      } elseif ($thn_masuk <= $berhak && $tampung['Status'] == 'Tidak Lulus') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda gagal dalam mengikuti Coaching');
      } elseif ($thn_masuk <= $berhak && $daftar == 0) {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum mendaftar dalam kegiatan PLI');
      } elseif ($thn_masuk <= $berhak && $wadah['Status'] == 'Pending') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Status PLI anda masih dalam proses');
      } elseif ($thn_masuk <= $berhak && $wadah['Status'] == 'Ditolak') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda ditolak pada perusahaan');
      } elseif ($thn_masuk <= $berhak && $wadah['Laporan'] == '') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Anda belum memasukkan berkas');
      } elseif ($thn_masuk <= $berhak && $wadah['Verifikasi'] == 'Pending') {
          return redirect()->to('/mahasiswa/pesan')->with('pesan', 'Nilai anda masih dalam proses');
      } else {
        return view('mahasiswa/nilaiAkhir', $data);
      }
    }
}
