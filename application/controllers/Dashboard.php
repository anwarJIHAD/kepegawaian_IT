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

	}
	public function index()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$tahun_sekarang = date('Y');
		$tahun_range = range($tahun_sekarang, $tahun_sekarang - 20, -1);
		$data['tahun'] = $tahun_range;
		$this->load->view('layout/header', $data);
		$this->load->view('Dashboard/vw_test2', $data);
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


}
