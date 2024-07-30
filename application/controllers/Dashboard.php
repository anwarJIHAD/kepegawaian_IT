<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('PerizinanCuti_model');
		$this->load->model('PerizinanSakit_model');
		$this->load->model('Perizinan_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Notifikasi_model');
		$this->load->model('Absensi_model');
	}
	public function index()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['jumlah_pegawai'] = $this->Dashboard_model->jumlah_pegawai();
		$data['jumlah_sakit'] = $this->Dashboard_model->jumlah_sakit();
		$data['jumlah_lembur'] = $this->Dashboard_model->jumlah_lembur();
		$data['jumlah_cuti'] = $this->Dashboard_model->jumlah_cuti();
		$data['jumlah_sakit_pegawai'] = $this->Dashboard_model->jumlah_sakit_pegawai();
		$data['jumlah_sakit_disetujui'] = $this->Dashboard_model->jumlah_sakit_disetujui();
		$data['jumlah_sakit_ditolak'] = $this->Dashboard_model->jumlah_sakit_ditolak();
		$data['jumlah_lembur_pegawai'] = $this->Dashboard_model->jumlah_lembur_pegawai();
		$data['jumlah_cuti_pegawai'] = $this->Dashboard_model->jumlah_cuti_pegawai();
		$data['jumlah_cuti_diterima'] = $this->Dashboard_model->jumlah_cuti_diterima();
		$data['jumlah_cuti_ditolak'] = $this->Dashboard_model->jumlah_cuti_ditolak();
		$data['notif_cuti'] = $this->Notifikasi_model->getcuti();
		$data['notif_sakit'] = $this->Notifikasi_model->getsakit();
		$data['notif_izin'] = $this->Notifikasi_model->getizin();
		$tahun_sekarang = date('Y');
		$tahun_range = range($tahun_sekarang, $tahun_sekarang - 20, -1);
		$data['tahun'] = $tahun_range;
		$this->load->view('layout/header', $data);
		$this->load->view('Dashboard/vw_dashboard', $data);
		$this->load->view('layout/footer', $data);
	}
	public function getPerizinan()
	{
		$tahun = $this->input->get('tahun'); // Ambil tahun dari permintaan GET
		try {
			// Lakukan filter data sesuai dengan tahun untuk cuti
			$month_1 = '01';
			$month_2 = '02';
			$month_3 = '03';
			$month_4 = '04';
			$month_5 = '05';
			$month_6 = '06';
			$month_7 = '07';
			$month_8 = '08';
			$month_9 = '09';
			$month_10 = '10';
			$month_11 = '11';
			$month_12 = '12';

			$data['month_1'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_1);
			$data['month_2'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_2);
			$data['month_3'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_3);
			$data['month_4'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_4);
			$data['month_5'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_5);
			$data['month_6'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_6);
			$data['month_7'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_7);
			$data['month_8'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_8);
			$data['month_9'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_9);
			$data['month_10'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_10);
			$data['month_11'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_11);
			$data['month_12'] = $this->PerizinanCuti_model->getDataByYear($tahun, $month_12);


			//mengirim data untuk sakit
			$data['month_1_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_1);
			$data['month_2_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_2);
			$data['month_3_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_3);
			$data['month_4_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_4);
			$data['month_5_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_5);
			$data['month_6_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_6);
			$data['month_7_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_7);
			$data['month_8_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_8);
			$data['month_9_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_9);
			$data['month_10_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_10);
			$data['month_11_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_11);
			$data['month_12_'] = $this->PerizinanSakit_model->getDataByYear($tahun, $month_12);

			// Kirim data dalam format JSON
			header('Content-Type: application/json');
			echo json_encode($data);
		} catch (Exception $e) {
			// Tangkap kesalahan dan kirim pesan kesalahan dalam format JSON
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json');
			echo json_encode(array('error' => $e->getMessage()));
		}
	}
	public function getcuti_guru()
	{
		$tahun = $this->input->get('tahun'); // Ambil tahun dari permintaan GET
		try {
			// Lakukan filter data sesuai dengan tahun untuk cuti
			$month_1 = '01';
			$month_2 = '02';
			$month_3 = '03';
			$month_4 = '04';
			$month_5 = '05';
			$month_6 = '06';
			$month_7 = '07';
			$month_8 = '08';
			$month_9 = '09';
			$month_10 = '10';
			$month_11 = '11';
			$month_12 = '12';
			$data['month_1_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_1);
			$data['month_2_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_2);
			$data['month_3_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_3);
			$data['month_4_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_4);
			$data['month_5_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_5);
			$data['month_6_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_6);
			$data['month_7_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_7);
			$data['month_8_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_8);
			$data['month_9_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_9);
			$data['month_10_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_10);
			$data['month_11_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_11);
			$data['month_12_'] = $this->PerizinanCuti_model->getDataByYearId($tahun, $month_12);
			$data['sisa_cuti'] = $this->Dashboard_model->jumlah_cuti_pegawai($tahun);

			// Kirim data dalam format JSON
			header('Content-Type: application/json');
			echo json_encode($data);
		} catch (Exception $e) {
			// Tangkap kesalahan dan kirim pesan kesalahan dalam format JSON
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json');
			echo json_encode(array('error' => $e->getMessage()));
		}
	}

	public function getsakit_guru()
	{
		$tahun = $this->input->get('tahun'); // Ambil tahun dari permintaan GET
		try {
			// Lakukan filter data sesuai dengan tahun untuk cuti
			$month_1 = '01';
			$month_2 = '02';
			$month_3 = '03';
			$month_4 = '04';
			$month_5 = '05';
			$month_6 = '06';
			$month_7 = '07';
			$month_8 = '08';
			$month_9 = '09';
			$month_10 = '10';
			$month_11 = '11';
			$month_12 = '12';
			$data['month_1_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_1);
			$data['month_2_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_2);
			$data['month_3_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_3);
			$data['month_4_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_4);
			$data['month_5_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_5);
			$data['month_6_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_6);
			$data['month_7_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_7);
			$data['month_8_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_8);
			$data['month_9_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_9);
			$data['month_10_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_10);
			$data['month_11_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_11);
			$data['month_12_'] = $this->PerizinanSakit_model->getDataByYearId($tahun, $month_12);

			// Kirim data dalam format JSON
			header('Content-Type: application/json');
			echo json_encode($data);
		} catch (Exception $e) {
			// Tangkap kesalahan dan kirim pesan kesalahan dalam format JSON
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json');
			echo json_encode(array('error' => $e->getMessage()));
		}
	}
	public function getAbsen()
	{
		$tahun = $this->input->get('tahun'); // Ambil tahun dari permintaan GET
		try {
			// Lakukan filter data sesuai dengan tahun untuk cuti
			$month_1 = '01';
			$month_2 = '02';
			$month_3 = '03';
			$month_4 = '04';
			$month_5 = '05';
			$month_6 = '06';
			$month_7 = '07';
			$month_8 = '08';
			$month_9 = '09';
			$month_10 = '10';
			$month_11 = '11';
			$month_12 = '12';
			// data hadir
			$data['month_1'] = $this->Absensi_model->getDataByYear1($tahun, $month_1);
			$data['month_2'] = $this->Absensi_model->getDataByYear1($tahun, $month_2);
			$data['month_3'] = $this->Absensi_model->getDataByYear1($tahun, $month_3);
			$data['month_4'] = $this->Absensi_model->getDataByYear1($tahun, $month_4);
			$data['month_5'] = $this->Absensi_model->getDataByYear1($tahun, $month_5);
			$data['month_6'] = $this->Absensi_model->getDataByYear1($tahun, $month_6);
			$data['month_7'] = $this->Absensi_model->getDataByYear1($tahun, $month_7);
			$data['month_8'] = $this->Absensi_model->getDataByYear1($tahun, $month_8);
			$data['month_9'] = $this->Absensi_model->getDataByYear1($tahun, $month_9);
			$data['month_10'] = $this->Absensi_model->getDataByYear1($tahun, $month_10);
			$data['month_11'] = $this->Absensi_model->getDataByYear1($tahun, $month_11);
			$data['month_12'] = $this->Absensi_model->getDataByYear1($tahun, $month_12);

			// telat
			$data['month_1_'] = $this->Absensi_model->getDataByYear2($tahun, $month_1);
			$data['month_2_'] = $this->Absensi_model->getDataByYear2($tahun, $month_2);
			$data['month_3_'] = $this->Absensi_model->getDataByYear2($tahun, $month_3);
			$data['month_4_'] = $this->Absensi_model->getDataByYear2($tahun, $month_4);
			$data['month_5_'] = $this->Absensi_model->getDataByYear2($tahun, $month_5);
			$data['month_6_'] = $this->Absensi_model->getDataByYear2($tahun, $month_6);
			$data['month_7_'] = $this->Absensi_model->getDataByYear2($tahun, $month_7);
			$data['month_8_'] = $this->Absensi_model->getDataByYear2($tahun, $month_8);
			$data['month_9_'] = $this->Absensi_model->getDataByYear2($tahun, $month_9);
			$data['month_10_'] = $this->Absensi_model->getDataByYear2($tahun, $month_10);
			$data['month_11_'] = $this->Absensi_model->getDataByYear2($tahun, $month_11);
			$data['month_12_'] = $this->Absensi_model->getDataByYear2($tahun, $month_12);
			// tidak hadir
			$data['month_1_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_1);
			$data['month_2_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_2);
			$data['month_3_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_3);
			$data['month_4_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_4);
			$data['month_5_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_5);
			$data['month_6_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_6);
			$data['month_7_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_7);
			$data['month_8_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_8);
			$data['month_9_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_9);
			$data['month_10_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_10);
			$data['month_11_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_11);
			$data['month_12_A'] = $this->Absensi_model->getDataByYear3($tahun, $month_12);

			// Kirim data dalam format JSON
			header('Content-Type: application/json');
			echo json_encode($data);
		} catch (Exception $e) {
			// Tangkap kesalahan dan kirim pesan kesalahan dalam format JSON
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json');
			echo json_encode(array('error' => $e->getMessage()));
		}
	}
}



