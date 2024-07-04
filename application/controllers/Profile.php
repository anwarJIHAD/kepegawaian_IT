<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Pegawai_model');

	}

	public function index()
	{
		$data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();

		$this->form_validation->set_rules('nama', 'nama', 'required|trim', [
			'required' => 'Nama Wajib di isi'
		]);
		$this->form_validation->set_rules('username', 'username', 'required|trim', [
			'required' => 'Username Wajib di isi'
		]);
		$this->form_validation->set_rules('tmpt_lahir', 'tmpt_lahir', 'required|trim', [
			'required' => 'Tempat lahir Wajib di isi'
		]);
		$this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'required|trim', [
			'required' => 'Tanggal lahir Wajib di isi'
		]);
		$this->form_validation->set_rules('pnd_trkhr', 'pnd_trkhr', 'required|trim', [
			'required' => 'Pendidikan terakhir Wajib di isi'
		]);

		$this->form_validation->set_rules('jurusan', 'jurusan', 'required|trim', [
			'required' => 'Jurusan Wajib di isi'
		]);
		$this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim', [
			'required' => 'Jabatan Wajib di isi'
		]);
		$this->form_validation->set_rules('no_hp', 'no_hp', 'required|trim', [
			'required' => 'No handphone Wajib di isi'
		]);
		$this->form_validation->set_rules('pass_lama', 'pass_lama', 'trim|callback_check_password_lama');
		$this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|callback_check_passwords');


		if ($this->form_validation->run() == false) {
			$this->load->view('layout/header', $data);
			$this->load->view('Auth/vw_profile', $data);
			$this->load->view('layout/footer', $data);
		} else {

			$data = [
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'tmpt_lahir' => $this->input->post('tmpt_lahir'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'pnd_trkhr' => $this->input->post('pnd_trkhr'),
				'jurusan' => $this->input->post('jurusan'),
				'jabatan' => $this->input->post('jabatan'),
				'no_hp' => $this->input->post('no_hp'),
			];

			if ($this->input->post('password')) {
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			}
			$user = $this->db->get_where('pegawai', ['niy' => $this->session->userdata('niy')])->row_array();
			$id = $user['id'];
			$this->Pegawai_model->update(['id' => $id], $data);
			$this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
			redirect('Profile');
		}
	}


	public function update_profile()
{
    $data['pegawai'] = $this->db->get_where('pegawai', ['id' => $this->session->userdata['id']])->row_array();

    $config['upload_path']          = './template/assets/img/profil/';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg';
    $config['max_size']             = 10000;
    $config['max_width']            = 10000;
    $config['max_height']           = 10000;

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('gambar'))
    {
        // Tambahkan pesan kesalahan untuk debugging
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Error!", "'. $error .'", "error");</script>');
        redirect('Profile');
    } 
    else 
    {
        $gambar = $this->upload->data();
        $gambar = $gambar['file_name'];

        $data = [
            'gambar' => $gambar,
        ];

        $user = $this->db->get_where('pegawai', ['niy' => $this->session->userdata('niy')])->row_array();
        $id = $user['id'];
        $this->Pegawai_model->update(['id' => $id], $data);
        $this->session->set_flashdata('message', '<script type="text/javascript">swal("Good job!", "Success!", "success");</script>');
        redirect('Profile');
    }
}


	public function check_passwords($new_password)
	{
		$confirm_password = $this->input->post('pass_baru2');
		$old_password = $this->input->post('pass_lama');

		// Check if the new password or its confirmation is filled and compare them
		if (!empty($new_password) || !empty($confirm_password)) {
			if ($new_password !== $confirm_password) {
				$this->form_validation->set_message('check_passwords', 'Password baru dan konfirmasi password harus sama');
				return FALSE;
			}
		}

		// Check if the new password is filled and the old password is not filled
		if (!empty($new_password) && empty($old_password)) {
			$this->form_validation->set_message('check_passwords', 'Password lama wajib diisi jika password baru diisi');
			return FALSE;
		}

		return TRUE;
	}

	public function check_password_lama($old_password)
	{
		$new_password = $this->input->post('pass_baru');
		$user = $this->db->get_where('pegawai', ['niy' => $this->session->userdata('niy')])->row_array();

		// Check if the old password is filled and validate it
		if (!empty($old_password)) {
			if ($user) {
				if (password_verify($old_password, $user['password'])) {
					if (empty($old_password) && !empty($new_password)) {
						$this->form_validation->set_message('check_password_lama', 'Password lama wajib diisi jika password baru diisi');
						return FALSE;
					}
					if (!empty($old_password) && empty($new_password)) {
						$this->form_validation->set_message('check_password_lama', 'Password baru wajib diisi jika password lama diisi');
						return FALSE;
					}
					return TRUE;
				} else {
					$this->form_validation->set_message('check_password_lama', 'Password lama salah');
					return FALSE;
				}
			}
		}
	}

	public function testing()
	{
		$this->load->view('layout/header');
		$this->load->view('Auth/vw_profile2');
		$this->load->view('layout/footer');
	}
}
