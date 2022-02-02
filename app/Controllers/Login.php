<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\UhiModel;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Models\PerusahaanModel;
use App\Models\PeriodeModel;

class Login extends BaseController
{
    protected $uhi;
    protected $dosen;
    protected $mahasiswa;
    protected $perusahaan;
    protected $periode;
    public function __construct()
    {
        $this->uhi = new UhiModel;
        $this->dosen = new DosenModel;
        $this->mahasiswa = new MahasiswaModel;
        $this->perusahaan = new PerusahaanModel;
        $this->periode = new PeriodeModel;
    }

    public function index()
    {
      $data_tahun = Time::now('Asia/Jakarta', 'id_ID');
  		$tahun = $data_tahun->toLocalizedString('yyyy');
      $periode_ganjil = $this->periode->where('periode','Juli-Desember '.$tahun)->countAllResults();
      $periode_genap = $this->periode->where('periode','Januari-Juni '.$tahun)->countAllResults();

      $bulan = $data_tahun->toLocalizedString('M');

        if (session('id_mhs')) {
            return redirect()->to('/mahasiswa/index');
        } elseif (session('id_dsn')) {
            return redirect()->to('/dpl/index');
        } elseif (session('id_koor')) {
            return redirect()->to('/koordinator/index');
        } elseif (session('id_uhi')) {
            return redirect()->to('/admin/index');
        } elseif (session('id_usaha')) {
            return redirect()->to('/perusahaan/index');
        } else {
          if ($periode_ganjil == 1) {
            return view('login');
          } elseif ($periode_genap == 1) {
            return view('login');
          }else {
            if ($bulan >= 7 && $bulan <= 12) {
              $this->periode->insert([
                'periode' => 'Juli-Desember '.$tahun
              ]);
              return view('login');
            }elseif ($bulan >= 1 && $bulan <= 6) {
              $this->periode->insert([
                'periode' => 'Januari-Juni '.$tahun
              ]);
              return view('login');
            }else {
              return view('login');
            }
          }
        }
    }
    public function cek_login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $mhs = $this->mahasiswa->where('NIM', $username)->where('Password', $password)->first();
        $dsn = $this->dosen->where('NID', $username)->where('Password', $password)->where('Status', 'Dosen')->first();
        $koor = $this->dosen->where('NID', $username)->where('Password', $password)->where('Status', 'Koordinator')->first();
        $uhi = $this->uhi->where('NID', $username)->where('Password', $password)->first();
        $usaha = $this->perusahaan->where('Id_Perusahaan', $username)->where('Password', $password)->where('Status', 'Diterima')->first();

        // dd($this->request->getVar());
        if ($mhs) {
            session()->set('id_mhs', $mhs['NIM']);
            session()->set('nama_mhs', $mhs['Nama_Mhs']);
            session()->set('prodi_mhs', $mhs['Prodi']);
            return redirect()->to('/mahasiswa/index');
        } elseif ($dsn) {
            session()->set('id_dsn', $dsn['NID']);
            session()->set('nama_dsn', $dsn['Nama_Dsn']);
            return redirect()->to('/dpl/index');
        } elseif ($koor) {
            session()->set('id_koor', $koor['NID']);
            session()->set('nama_koor', $koor['Nama_Dsn']);
            session()->set('jurusan_koor', $koor['Jurusan_Dsn']);
            return redirect()->to('/koordinator/index');
        } elseif ($uhi) {
            session()->set('id_uhi', $uhi['NID']);
            return redirect()->to('/admin/index');
        } elseif ($usaha) {
            session()->set('id_usaha', $usaha['Id_Perusahaan']);
            session()->set('nama_usaha', $usaha['Nama_Perusahaan']);
            return redirect()->to('/perusahaan/index');
        } else {
            return redirect()->to('/')->with('pesan', 'Username atau password anda salah');
        }
    }

    public function logout()
    {
        if (session('id_mhs')) {
            session()->remove('id_mhs');
            return redirect()->to('/');
        } elseif (session('id_dsn')) {
            session()->remove('id_dsn');
            return redirect()->to('/');
        } elseif (session('id_koor')) {
            session()->remove('id_koor');
            return redirect()->to('/');
        } elseif (session('id_uhi')) {
            session()->remove('id_uhi');
            return redirect()->to('/');
        } elseif (session('id_usaha')) {
            session()->remove('id_usaha');
            return redirect()->to('/');
        } else {
            echo 'Anda Tidak Dapat Keluar';
        }
    }
    public function pilihan()
    {
        return view('pilihan');
    }
    public function regis_dsn()
    {
        return view('registrasi_dsn');
    }

    public function regis_dsnsave()
    {
        $this->dosen->insert([
            'NID'           => $this->request->getVar('nid'),
            'Nama_Dsn'      => $this->request->getVar('nama'),
            'Jurusan_dsn'   => $this->request->getVar('jurusan'),
            'Status'        => 'Dosen',
            'Email'         => $this->request->getVar('email'),
            'No_hp'         => $this->request->getVar('hp'),
            'Password'      => $this->request->getVar('password')
        ]);
        return redirect()->to('index');
    }
    public function regis_mhs()
    {
        return view('registrasi_mhs');
    }

    public function regis_mhssave()
    {
        $this->mahasiswa->insert([
            'NIM'           => $this->request->getVar('nim'),
            'Thn_masuk'      => $this->request->getVar('tahun'),
            'Nama_Mhs'   => $this->request->getVar('nama'),
            'Jurusan'        =>  $this->request->getVar('jurusan'),
            'Prodi'         => $this->request->getVar('prodi'),
            'Jk'         => $this->request->getVar('jk'),
            'No_Hp'         => $this->request->getVar('no'),
            'Email'         => $this->request->getVar('email'),
            'Password'      => $this->request->getVar('password')
        ]);
        return redirect()->to('index');
    }


    public function regis_perusahaan()
    {
        return view('registrasi_perusahaan');
    }


    public function regis_perusahaansave()
    {
        $file         = $this->request->getFile('berkas'); //ambil file
        $namaFile     = $file->getClientName(); //generate nama file random
        $file->move('filePerusahaan/', $namaFile); //file pindah ke folder file

        $this->perusahaan->insert([
            'Id_Perusahaan'           => $this->request->getVar('username'),
            'Password'      => $this->request->getVar('password'),
            'Nama_Perusahaan'   => $this->request->getVar('nama'),
            'Alamat_Perusahaan'   => $this->request->getVar('alamat'),
            'Nama_Ceo'        =>  $this->request->getVar('ceo'),
            'Nama_Surv'         => $this->request->getVar('surv'),
            'Berkas_Perusahaan'         => $namaFile,
            'Tanggal_Berdiri'         => $this->request->getVar('tanggal'),
            'Status'         => 'Pending',
        ]);
        return redirect()->to('index');
    }
}
