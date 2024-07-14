<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerizinanCuti extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('PerizinanCuti_model');
		$this->load->model('Notifikasi_model');
		$this->load->model('Absensi_model');
		function generateDateRange($startDate, $endDate)
		{
			$period = new DatePeriod(
				new DateTime($startDate),
				new DateInterval('P1D'),
				(new DateTime($endDate))->modify('+1 day')
			);

			$dates = [];
			foreach ($period as $date) {
				$dates[] = $date->format('Y-m-d');
			}

			return $dates;
		}
	}
	public function index()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['izin_cuti'] = $this->PerizinanCuti_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Izincuti/vw_izin_cuti', $data);
		$this->load->view('layout/footer', $data);
	}

	public function tambahcuti()
	{
		$this->form_validation->set_rules('jenis_cuti', 'jenis_cuti', 'required|trim', [
			'required' => 'Jenis Cuti Wajib di isi'
		]);
		$this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('hingga_tgl', 'hingga_tgl', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim', [
			'required' => 'No Handphone Wajib di isi'
		]);
		$this->form_validation->set_rules('pemilik_nohp', 'pemilik_nohp', 'required|trim', [
			'required' => 'Pemilik No Hp Wajib di isi'
		]);
		$this->form_validation->set_rules('ket_cuti', 'ket_cuti', 'required|trim', [
			'required' => 'Keterangan Cuti Wajib di isi'
		]);
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Perizinan Cuti';
			$data['pegawai'] = $this->db->get_where('pegawai', ['username' => $this->session->userdata['username']])->row_array();
			$this->load->view('layout/header', $data);
			$this->load->view('Izincuti/vw_tambah_cuti', $data);
			$this->load->view('layout/footer', $data);
		} else {
			$niy = $this->session->userdata('niy');
			$data = [
				'jenis_cuti' => htmlspecialchars($this->input->post('jenis_cuti', true)),
				'tgl_izin' => htmlspecialchars($this->input->post('tgl_izin', true)),
				'hingga_tgl' => htmlspecialchars($this->input->post('hingga_tgl', true)),
				'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
				'pemilik_nohp' => htmlspecialchars($this->input->post('pemilik_nohp', true)),
				'ket_cuti' => htmlspecialchars($this->input->post('ket_cuti', true)),
				'niy' => $niy,
				'status' => 'Diajukan',
			];

			// print_r($this->session->userdata());

			$this->PerizinanCuti_model->insert($data);
			$izin_id = $this->db->insert_id();

			$notif = [
				'niy' => $niy,
				'message' => $this->session->userdata('nama') . ' Mengajukan surat cuti',
				'created_at' => date('Y-m-d H:i:s'),
				'jenis' => 'Surat Cuti',
				'izin_cuti_id' => $izin_id

			];
			$this->Notifikasi_model->insert($notif);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil ditambahkan!", "Success!", "success");</script>');
			redirect('PerizinanCuti');
		}
	}
	public function editcuti($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['izin_cuti'] = $this->PerizinanCuti_model->getById($id);

		$this->form_validation->set_rules('jenis_cuti', 'jenis_cuti', 'required|trim', [
			'required' => 'Jenis Cuti Wajib di isi'
		]);
		$this->form_validation->set_rules('tgl_izin', 'tgl_izin', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('hingga_tgl', 'hingga_tgl', 'required|trim', [
			'required' => 'Tanggal Izin Wajib di isi'
		]);
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim', [
			'required' => 'No Handphone Wajib di isi'
		]);
		$this->form_validation->set_rules('pemilik_nohp', 'pemilik_nohp', 'required|trim', [
			'required' => 'Pemilik No Hp Wajib di isi'
		]);
		$this->form_validation->set_rules('ket_cuti', 'ket_cuti', 'required|trim', [
			'required' => 'Keterangan Cuti Wajib di isi'
		]);
		if ($this->form_validation->run() == false) {
			$this->load->view('layout/header', $data);
			$this->load->view('Izincuti/vw_edit_cuti', $data);
			$this->load->view('layout/footer', $data);
		} else {
			$data = [
				'jenis_cuti' => $this->input->post('jenis_cuti'),
				'tgl_izin' => $this->input->post('tgl_izin'),
				'hingga_tgl' => $this->input->post('hingga_tgl'),
				'no_hp' => $this->input->post('no_hp'),
				'pemilik_nohp' => $this->input->post('pemilik_nohp'),
				'ket_cuti' => $this->input->post('ket_cuti'),
			];
			$id = $this->input->post('id');
			$this->PerizinanCuti_model->update(['id' => $id], $data);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil diubah!", "Success!", "success");</script>');
			redirect('PerizinanCuti');
		}
	}

	public function hapus($id)
	{
		$this->PerizinanCuti_model->delete($id);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Berhasil dihapus!", "Success!", "success");</script>');
		redirect('PerizinanCuti');
	}

	public function approvecuti()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['approvecuti'] = $this->PerizinanCuti_model->get();
		$this->load->view('layout/header', $data);
		$this->load->view('Izincuti/vw_approvecuti', $data);
		$this->load->view('layout/footer', $data);
	}

	public function ubahstatus($id)
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();
		$data['izin_cuti'] = $this->PerizinanCuti_model->getById($id);

		$status = $this->input->post('status');
		$data = [
			'status' => $status,
			'ket_kepsek' => $this->input->post('ket_kepsek'),
		];

		$izin = $this->PerizinanCuti_model->getById($id);
		if ($status == 'Diterima') {

			$tanggal_mulai = $izin['tgl_izin'];
			$tanggal_selesai = $izin['hingga_tgl'];
			$dates = generateDateRange($tanggal_mulai, $tanggal_selesai);
			// var_dump($dates);
			// die;
			$cuti = array();
			foreach ($dates as $tanggal) {
				$absen = $this->Absensi_model->byDate($izin['niy'], $tanggal);
				if (!$absen) {
					$cuti[] = array(
						'niy' => $izin['niy'],
						'tanggal' => $tanggal,
						'status' => 'Tidak Hadir',
						'keterangan' => $izin['jenis_cuti'],
					);
				}

			}
			if (!empty($cuti)) {
				$this->Absensi_model->insert($cuti);
			}
		}
		$id = $this->input->post('id');
		$this->PerizinanCuti_model->update(['id' => $id], $data);
		$this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
		redirect('PerizinanCuti/approvecuti');
	}
}
