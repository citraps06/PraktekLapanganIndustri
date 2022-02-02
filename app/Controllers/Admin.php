<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Models\InformasiModel;
use App\Models\CoachingModel;
use App\Models\DataCoachingModel;
use App\Models\DataPliModel;
use App\Models\PliModel;
use App\Models\PerusahaanModel;
use App\Models\DosenModel;
use App\Models\PeriodeModel;

class Admin extends BaseController
{
	protected $info;
	protected $coaching;
	protected $dataCoaching;
	protected $dataPli;
	protected $pli;
	protected $perusahaan;
	protected $dosen;
	protected $periode;


	public function __construct()
	{
		$this->info = new InformasiModel();
		$this->coaching = new CoachingModel();
		$this->dataCoaching = new DataCoachingModel();
		$this->dataPli = new DataPliModel();
		$this->pli = new PliModel();
		$this->periode = new PeriodeModel();
		$this->perusahaan = new PerusahaanModel();
		$this->dosen = new DosenModel();
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
		return view('admin/index', $data);
	}


	public function add_informasi()
	{
		$data = [
			'validation' => \Config\Services::validation()
		];
		return view('admin/informasi', $data);
	}


	public function delete_informasi()
	{
		$id = $this->request->getVar('id_hapus');
		$info = $this->info->find($id); //cari gambar berdasarkan id
		unlink('fileInformasi/' . $info['File']); //hapus file
		$this->info->delete($id);
		return redirect()->to('/admin/index');
	}


	public function ubah($id)
	{
		$model = new InformasiModel();
		$ubah = $model->where('id_info', $id)->first(); //ambildata berdasarkan id_info secara keseluruhan data
		$tgl = $ubah['Tanggal'];
		$tanggal = Time::parse($tgl, 'Asia/Jakarta', 'id_ID');
		$hasil = $tanggal->toLocalizedString('yyyy-MM-d');

		$data = [
			'info' => $ubah,
			'tgl' => $hasil
		];
		return view('admin/update_informasi', $data);
		// $data['informasi'] = $model->getInformasi($id)->getRow();
		// echo view('/admin/update_informasi', $data);
	}


	public function edit()
	{
		$model = new InformasiModel();
		$id = $this->request->getVar('id');
		$data = [
			'Judul'  => $this->request->getVar('Judul'),
			'Keterangan' => $this->request->getVar('Ket'),
			'Tanggal' => $this->request->getVar('Tanggal'),
		];
		$model->update($id, $data); //menyimpah hasil update
		return redirect()->to('/admin/index');
	}


	public function save()
	{
		//validasi input
		if (!$this->validate([
			//'Judul' => 'required|is_unique[informasi.Judul]'
			'Judul' => 'required|is_unique[informasi.Judul]',
			//'Ket' => 'required|alpha[informasi.Ket]',
			//'Tanggal' => 'required|alpha[informasi.Tanggal]',
			//'File' => 'required|alpha[informasi.File]'
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to('/admin/add_informasi')->withInput()->with('validation', $validation);
		}
		$tgl = $this->request->getVar('Tanggal');
		$tanggal = Time::parse($tgl, 'Asia/Jakarta', 'id_ID');
		$hasil = $tanggal->toLocalizedString('d MMMM yyyy');

		$file 		= $this->request->getFile('File'); //ambil file
		$namaFile 	= $file->getClientName(); //generate nama file random
		$file->move('fileInformasi/', $namaFile); //file pindah ke folder file
		$informasi = new InformasiModel();

		$data = [
			'Judul' 		=> $this->request->getVar('Judul'), //getVar sesuai dengan name yang ada di text field
			'Keterangan' 	=> $this->request->getVar('Ket'),
			'Tanggal' 		=> $hasil,
			'File' 			=> $namaFile
		];
		$informasi->insert($data);
		// return redirect()->route('admin/index');
		return redirect()->to('index');
	}


	public function download($id)
	{
		$informasi = new InformasiModel();
		$info = $informasi->find($id);
		return $this->response->download('fileInformasi/' . $info['File'], null);
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


	public function dosen()
	{
		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$dosen = $this->dosen->like('Nama_Dsn', $keyword)->findAll();
		} else {
			$dosen = $this->dosen->orderBy('NID', 'asc')->findAll();
		}

		$data = [
			'info' => $dosen
		];
		return view('admin/dosen', $data);
	}


	public function update_dosen($id)
	{
		$data = [
			'info' => $this->dosen->where('NID', $id)->first()
		];
		return view('admin/update_dosen', $data);
	}


	public function edit_dosen()
	{
		$id = $this->request->getVar('id');
		$data = [
			'Status' => $this->request->getVar('status')
		];
		$this->dosen->update($id, $data);
		return redirect()->to('/admin/dosen');
	}


	public function delete_dosen()
	{
		$id = $this->request->getVar('id');
		$this->dosen->delete($id);
		return redirect()->to('/admin/dosen');
	}


	public function perusahaan()
	{
		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$coaching = $this->perusahaan->like('Nama_Perusahaan', $keyword)->findAll();
		} else {
			$coaching = $this->perusahaan->orderBy('Nama_Perusahaan', 'asc')->findAll();
		}

		$data = [
			'info' => $coaching
		];
		return view('admin/perusahaan', $data);
	}



	public function download_usaha($id)
	{
		$usaha = new PerusahaanModel();
		$info = $usaha->find($id);
		return $this->response->download('filePerusahaan/' . $info['Berkas_Perusahaan'], null);
	}


	public function update_usaha($id)
	{
		$data = [
			'info' => $this->perusahaan->where('Id_Perusahaan', $id)->first()
		];
		return view('admin/update_perusahaan', $data);
	}


	public function edit_usaha()
	{
		$id = $this->request->getVar('id');
		$data = [
			'Status' => $this->request->getVar('status')
		];
		$this->perusahaan->update($id, $data);
		return redirect()->to('/admin/perusahaan');
	}


	public function delete_usaha()
	{
		$id = $this->request->getVar('id');
		$info = $this->perusahaan->find($id); //cari gambar berdasarkan id
		unlink('filePerusahaan/' . $info['Berkas_Perusahaan']); //hapus file
		$this->perusahaan->delete($id);
		return redirect()->to('/admin/perusahaan');
	}


	public function data_Coaching()
	{
		$currentPage = $this->request->getVar('page_data_coaching') ? $this->request->getVar('page_data_coaching') : 1;

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$coaching = $this->dataCoaching->search($keyword)->where('Status', 'Pending');
		} else {
			$coaching = $this->dataCoaching->where('Status', 'Pending')->orderBy('NIM', 'asc');
		}

		$data = [
			'info' => $coaching->paginate(10, 'coaching'), //mengatur berapa data paginate
			'pager' => $this->dataCoaching->pager, //memanggil paginate
			'currentPage' => $currentPage
		];
		return view('admin/dataCoaching', $data);
	}


	public function download_coaching($nim)
	{
		$download = new CoachingModel();
		$down = $download->where('NIM', $nim)->first(); // mengambil satu data yang teratas berdasarkan nim
		// dd($down);
		return $this->response->download('fileCoaching/' . $down['File_Lhs'], null);
	}


	public function absensi()
	{
		$data = [
			'info' => $this->dataCoaching->where('Status','Pending')->orderBy('NIM', 'asc')->findAll()
		];
		return view('admin/absen', $data);
	}

	public function status_coaching()
	{
		$currentPage = $this->request->getVar('page_data_coaching') ? $this->request->getVar('page_data_coaching') : 1;

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
			$coaching = $this->dataCoaching->search($keyword)->where('Status !=', 'Pending');
			$nama_periode= "";
		} elseif ($keyword1) {
			$coaching = $this->dataCoaching->where('Status !=', 'Pending')->where('periode',$keyword1)->orderBy('NIM', 'asc');
			$nama_periode= $keyword1;
		} else {
			$coaching = $this->dataCoaching->where('Status !=', 'Pending')->where('periode',$periode)->orderBy('NIM', 'asc');
			$nama_periode=$periode;
		}



		$periode1 = $this->periode->orderBy('periode','dsc')->findAll();

		// $periode = $this->periode->findAll();

		$data = [
			'info' => $coaching->paginate(10, 'status'), //mengatur berapa data paginate\
			'info1' => $periode1,
			'info2' => $nama_periode,
			// 'cari' => $periode
			'pager' => $this->dataCoaching->pager, //memanggil paginate
			'currentPage' => $currentPage
		];
		return view('admin/statusCoaching', $data);
	}

	public function periode_coaching($id)
	{


		return view('admin/updateCoaching', $data);
	}

	public function ubah_coaching($id)
	{

		$ubah = $this->dataCoaching->where('Id_Coaching', $id)->first(); //ambildata berdasarkan id_info secara keseluruhan data
		// dd($ubah);
		$data = [
			'info' => $ubah
		];
		return view('admin/updateCoaching', $data);
	}

	public function edit_coaching()
	{

		$id = $this->request->getVar('id');
		$data = [
			'NIM'  => $this->request->getVar('nim'),
			'Nama_Mhs' => $this->request->getVar('nama'),
			'Jurusan' => $this->request->getVar('jurusan'),
			'Status' => $this->request->getVar('status'),
		];
		$this->coaching->update($id, $data); //menyimpah hasil update
		return redirect()->to('/admin/data_Coaching');
	}


	public function delete_mhscoaching()
	{
		$id = $this->request->getVar('id');
		$info = $this->info->find($id); //cari gambar berdasarkan id
		unlink('fileCoaching/' . $info['File_Lhs']); //hapus file
		$this->coaching->delete($id);
		return redirect()->to('/admin/data_Coaching');
	}


	public function data_pli()
	{

		$currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;

		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$pli = $this->dataPli->search($keyword)->where('Status', 'Pending');
		} else {
			$pli = $this->dataPli->where('Status', 'Pending')->orderBy('NIM', 'asc');
		}

		$data = [
			'info' => $pli->paginate(10, 'pli'), //mengatur berapa data paginate
			'pager' => $this->dataPli->pager, //memanggil paginate
			'currentPage' => $currentPage
		];
		return view('admin/dataPLI', $data);
	}


	public function status_pli()
	{

		$currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;

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
			$pli = $this->dataPli->search($keyword)->where('Status !=', 'Pending');
			$nama_periode= "";
		} elseif ($keyword1) {
			$pli = $this->dataPli->where('Status !=', 'Pending')->where('periode',$keyword1)->orderBy('NIM', 'asc');
			$nama_periode= $keyword1;
		} else {
			$pli = $this->dataPli->where('Status !=', 'Pending')->where('periode',$periode)->orderBy('NIM', 'asc');
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
		return view('admin/statusPLI', $data);
	}


	public function hapus_pli()
	{
		$tangkap = $this->request->getVar('id');
		$info = $this->pli->find($tangkap); //cari gambar berdasarkan id
		unlink('filePli/' . $info['File_Lhs']); //hapus file
		unlink('filePli/' . $info['Proposal']); //hapus file
		$this->pli->delete($tangkap);
		return redirect()->to('/admin/status_pli');
	}

	public function surat_permohonan($id)
	{
		$bio = $this->dataPli->where('Id_Pli', $id)->first();
		$perusahaan = $bio['Nama_Perusahaan'];
		$masuk = $bio['Tanggal_Masuk'];
		$keluar = $bio['Tanggal_Keluar'];

		$sekarang = Time::now('Asia/Jakarta', 'id_ID');
		$tgl_surat = $sekarang->toLocalizedString('d MMMM yyyy');

		$tanggal_masuk = Time::parse($masuk, 'Asia/Jakarta', 'id_ID');
		$hasil_masuk = $tanggal_masuk->toLocalizedString('d MMMM yyyy');

		$tanggal_keluar = Time::parse($keluar, 'Asia/Jakarta', 'id_ID');
		$hasil_keluar = $tanggal_keluar->toLocalizedString('d MMMM yyyy');


		$data_surat = $this->dataPli->where('Nama_Perusahaan', $perusahaan)->where('Tanggal_Masuk', $masuk)->where('Tanggal_Keluar', $keluar)->findAll();
		$data = [
			'info' => $data_surat,
			'tgl_surat' => $tgl_surat,
			'masuk' => $hasil_masuk,
			'keluar' => $hasil_keluar,
			'perusahaan' => $perusahaan
		];
		return view('/admin/suratPermohonanPli', $data);
	}


	public function surat_pengantar($id)
	{
		$bio = $this->dataPli->where('Id_Pli', $id)->first();
		$perusahaan = $bio['Nama_Perusahaan'];
		$masuk = $bio['Tanggal_Masuk'];
		$keluar = $bio['Tanggal_Keluar'];

		$sekarang = Time::now('Asia/Jakarta', 'id_ID');
		$tgl_surat = $sekarang->toLocalizedString('d MMMM yyyy');

		$tanggal_masuk = Time::parse($masuk, 'Asia/Jakarta', 'id_ID');
		$hasil_masuk = $tanggal_masuk->toLocalizedString('d MMMM yyyy');

		$tanggal_keluar = Time::parse($keluar, 'Asia/Jakarta', 'id_ID');
		$hasil_keluar = $tanggal_keluar->toLocalizedString('d MMMM yyyy');


		$data_surat = $this->dataPli->where('Nama_Perusahaan', $perusahaan)->where('Tanggal_Masuk', $masuk)->where('Tanggal_Keluar', $keluar)->findAll();
		$data = [
			'info' => $data_surat,
			'tgl_surat' => $tgl_surat,
			'masuk' => $hasil_masuk,
			'keluar' => $hasil_keluar,
			'perusahaan' => $perusahaan
		];
		return view('/admin/suratPengantar', $data);
	}

	public function surat_dpl($id)
	{
		$bio = $this->dataPli->where('Id_Pli', $id)->first();
		$perusahaan = $bio['Nama_Perusahaan'];
		$dospem = $bio['Nama_Dsn'];
		$masuk = $bio['Tanggal_Masuk'];
		$keluar = $bio['Tanggal_Keluar'];

		$sekarang = Time::now('Asia/Jakarta', 'id_ID');
		$tgl_surat = $sekarang->toLocalizedString('d MMMM yyyy');

		$tanggal_masuk = Time::parse($masuk, 'Asia/Jakarta', 'id_ID');
		$hasil_masuk = $tanggal_masuk->toLocalizedString('d MMMM yyyy');

		$tanggal_keluar = Time::parse($keluar, 'Asia/Jakarta', 'id_ID');
		$hasil_keluar = $tanggal_keluar->toLocalizedString('d MMMM yyyy');


		$data_surat = $this->dataPli->where('Nama_Perusahaan', $perusahaan)->where('Nama_Dsn', $dospem)->where('Tanggal_Masuk', $masuk)->where('Tanggal_Keluar', $keluar)->findAll();
		$banyak_data = $this->dataPli->where('Nama_Perusahaan', $perusahaan)->where('Nama_Dsn', $dospem)->where('Tanggal_Masuk', $masuk)->where('Tanggal_Keluar', $keluar)->countAllResults();
		$data = [
			'info' => $data_surat,
			'banyak' => $banyak_data,
			'tgl_surat' => $tgl_surat,
			'masuk' => $hasil_masuk,
			'keluar' => $hasil_keluar,
			'perusahaan' => $perusahaan,
			'dospem' => $dospem,

		];
		return view('/admin/suratDpl', $data);
	}


	public function dosen_pembimbing()
	{
		$currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;

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
			$pli = $this->dataPli->search($keyword)->where('Nama_Dsn !=', '');
			$nama_periode= "";
		} elseif ($keyword1) {
			$pli = $this->dataPli->where('Nama_Dsn !=', '')->where('periode',$keyword1)->orderBy('NIM', 'asc');
			$nama_periode= $keyword1;
		}else {
			$pli = $this->dataPli->where('Nama_Dsn !=', '')->where('periode',$periode)->orderBy('NIM', 'asc');
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
		return view('admin/dpl', $data);
	}


	public function nilai_mahasiswa()
	{
		$currentPage = $this->request->getVar('page_pli') ? $this->request->getVar('page_pli') : 1;

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
			$pli = $this->dataPli->search($keyword)->where('Verifikasi', 'Verified');
			$nama_periode= "";
		} elseif ($keyword1) {
			$pli = $this->dataPli->where('Verifikasi', 'Verified')->where('periode',$keyword1)->orderBy('NIM', 'asc');
			$nama_periode= $keyword1;
		} else {
			$pli = $this->dataPli->where('Verifikasi', 'Verified')->where('periode',$periode)->orderBy('NIM', 'asc');
			$nama_periode=$periode;
		}

		$periode1 = $this->periode->orderBy('periode','dsc')->findAll();

		$data = [
			'info' => $pli->paginate(10, 'nilai'), //mengatur berapa data paginate
			'info1' => $periode1,
			'info2' => $nama_periode,
			'pager' => $this->dataPli->pager, //memanggil paginate
			'currentPage' => $currentPage
		];
		return view('admin/nilai', $data);
	}


	public function permohonan_pli()
	{
		return view('admin/suratPermohonanPli');
	}


	public function laporan()
	{
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
			$ikk = $this->dataPli->where('Jurusan', 'Ilmu Kesejahteraan Keluarga')->where('periode', $keyword1)->countAllResults();
			$hotel = $this->dataPli->where('Jurusan', 'Pariwisata')->where('periode', $keyword1)->countAllResults();
			$cantik = $this->dataPli->where('Jurusan', 'Tata Rias dan Kecantikan')->where('periode', $keyword1)->countAllResults();
			$nama_periode= $keyword1;
		} else {
			$ikk = $this->dataPli->where('Jurusan', 'Ilmu Kesejahteraan Keluarga')->where('periode', $periode)->countAllResults();
			$hotel = $this->dataPli->where('Jurusan', 'Pariwisata')->where('periode', $periode)->countAllResults();
			$cantik = $this->dataPli->where('Jurusan', 'Tata Rias dan Kecantikan')->where('periode', $periode)->countAllResults();
			$nama_periode=$periode;
		}

		$periode1 = $this->periode->orderBy('periode','dsc')->findAll();

		$data = [
			'info1' => $periode1,
			'info2' => $nama_periode,
			'jurusan_1' => $ikk,
			'jurusan_2' => $hotel,
			'jurusan_3' => $cantik
		];
		return view('admin/laporan', $data);
	}

	public function excel($periode)
	{
		// $sekarang = Time::now('Asia/Jakarta', 'id_ID');
		// $tahun = $sekarang->toLocalizedString('yyyy');
		// $bulan = $sekarang->toLocalizedString('M');
		// if ($bulan >= 7 && $bulan <= 12) {
		// 	$periode = 'Juli-Desember '.$tahun;
		// }elseif ($bulan >= 1 && $bulan <= 6) {
		// 	$periode = 'Januari-Juni '.$tahun;
		// }


		// $keyword1 = $this->request->getVar('keyword1');
		// if ($keyword1) {
		// 	$laporan = $this->dataPli->where('periode', $keyword1)->orderBy('NIM','asc')->findAll();
		// 	$ikk = $this->dataPli->where('Jurusan', 'Ilmu Kesejahteraan Keluarga')->where('periode', $keyword1)->countAllResults();
		// 	$hotel = $this->dataPli->where('Jurusan', 'Pariwisata')->where('periode', $keyword1)->countAllResults();
		// 	$cantik = $this->dataPli->where('Jurusan', 'Tata Rias dan Kecantikan')->where('periode', $keyword1)->countAllResults();
		// 	$nama_periode= $keyword1;
		// } else {
		// 	$laporan = $this->dataPli->where('periode', $periode)->orderBy('NIM','asc')->findAll();
		// 	$ikk = $this->dataPli->where('Jurusan', 'Ilmu Kesejahteraan Keluarga')->where('periode', $periode)->countAllResults();
		// 	$hotel = $this->dataPli->where('Jurusan', 'Pariwisata')->where('periode', $periode)->countAllResults();
		// 	$cantik = $this->dataPli->where('Jurusan', 'Tata Rias dan Kecantikan')->where('periode', $periode)->countAllResults();
		// 	$nama_periode=$periode;
		// }

		// $periode1 = $this->periode->orderBy('periode','dsc')->findAll();
		$laporan = $this->dataPli->where('periode', $periode)->orderBy('NIM','asc')->findAll();
		// $ikk = $this->dataPli->where('Jurusan', 'Ilmu Kesejahteraan Keluarga')->where('periode', $periode)->countAllResults();
		// $hotel = $this->dataPli->where('Jurusan', 'Pariwisata')->where('periode', $periode)->countAllResults();
		// $cantik = $this->dataPli->where('Jurusan', 'Tata Rias dan Kecantikan')->where('periode', $periode)->countAllResults();
		// $nama_periode=$periode;

		$data = [
			'info2' => $periode,
			'laporan' => $laporan
		];
		return view('admin/excel', $data);
	}
}
