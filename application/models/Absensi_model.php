<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Absensi_model extends CI_Model
{
	public $table = 'absensi';
	public $id = 'absensi.id';
	public function __construct()
	{
		parent::__construct();

	}
	public function get()
	{
		$role = $this->session->userdata('role');
		if ($role == 'Admin' || $role == 'kepala sekolah') {
			$this->db->select('pegawai.*, absensi.id AS id_absensi, absensi.*');
			$this->db->from($this->table);
			$this->db->join('pegawai', 'absensi.niy = pegawai.niy', 'left');
			$query = $this->db->get();
		} else {
			$logged_in_user_id = $this->session->userdata('niy');
			$this->db->select('pegawai.*, absensi.id AS id_absensi, absensi.*');
			$this->db->from($this->table);
			$this->db->join('pegawai', 'absensi.niy = pegawai.niy', 'left');
			$this->db->where('absensi.niy', $logged_in_user_id);
			$query = $this->db->get();
		}
		return $query->result_array();
	}
	public function getDataByYear1($tahun, $month)
	{
		$role = $this->session->userdata('role');
		if ($role == 'Admin' || $role == 'kepala sekolah') {
			$this->db->select('month(tanggal)');
			$this->db->from('absensi'); // Ganti 'nama_tabel' dengan nama tabel Anda
			if ($tahun != '') {
				$this->db->where('YEAR(tanggal)', $tahun);
			}
			// 'tanggal' adalah nama kolom tanggal dalam tabel
			$this->db->where('month(tanggal)', $month);
			$this->db->where('status', 'hadir');
			$query = $this->db->get();
			return $query->num_rows();
		} else {
			$logged_in_user_id = $this->session->userdata('niy');

			$this->db->select('month(tanggal)');
			$this->db->from('absensi'); // Ganti 'nama_tabel' dengan nama tabel Anda
			if ($tahun != '') {
				$this->db->where('YEAR(tanggal)', $tahun);
			}
			$this->db->where('absensi.niy', $logged_in_user_id);
			$this->db->where('status', 'hadir');
			// 'tanggal' adalah nama kolom tanggal dalam tabel
			$this->db->where('month(tanggal)', $month); // 'tanggal' adalah nama kolom tanggal dalam tabel
			$query = $this->db->get();
			return $query->num_rows();
		}

	}
	public function getDataByYear2($tahun, $month)
	{
		$role = $this->session->userdata('role');
		if ($role == 'Admin' || $role == 'kepala sekolah') {
			$this->db->select('month(tanggal)');
			$this->db->from('absensi'); // Ganti 'nama_tabel' dengan nama tabel Anda
			if ($tahun != '') {
				$this->db->where('YEAR(tanggal)', $tahun);
			}
			// 'tanggal' adalah nama kolom tanggal dalam tabel
			$this->db->where('month(tanggal)', $month);
			$this->db->where('status', 'telat');
			$query = $this->db->get();
			return $query->num_rows();
		} else {
			$logged_in_user_id = $this->session->userdata('niy');

			$this->db->select('month(tanggal)');
			$this->db->from('absensi'); // Ganti 'nama_tabel' dengan nama tabel Anda
			if ($tahun != '') {
				$this->db->where('YEAR(tanggal)', $tahun);
			}
			$this->db->where('absensi.niy', $logged_in_user_id);
			$this->db->where('status', 'telat');
			// 'tanggal' adalah nama kolom tanggal dalam tabel
			$this->db->where('month(tanggal)', $month); // 'tanggal' adalah nama kolom tanggal dalam tabel
			$query = $this->db->get();
			return $query->num_rows();
		}
	}
	public function getDataByYear3($tahun, $month)
	{
		$role = $this->session->userdata('role');
		if ($role == 'Admin' || $role == 'kepala sekolah') {
			$this->db->select('month(tanggal)');
			$this->db->from('absensi'); // Ganti 'nama_tabel' dengan nama tabel Anda
			if ($tahun != '') {
				$this->db->where('YEAR(tanggal)', $tahun);
			}
			// 'tanggal' adalah nama kolom tanggal dalam tabel
			$this->db->where('month(tanggal)', $month);
			$this->db->where('status', 'tidak hadir');
			$query = $this->db->get();
			return $query->num_rows();
		} else {
			$logged_in_user_id = $this->session->userdata('niy');

			$this->db->select('month(tanggal)');
			$this->db->from('absensi'); // Ganti 'nama_tabel' dengan nama tabel Anda
			if ($tahun != '') {
				$this->db->where('YEAR(tanggal)', $tahun);
			}
			$this->db->where('absensi.niy', $logged_in_user_id);
			$this->db->where('status', 'tidak hadir');
			// 'tanggal' adalah nama kolom tanggal dalam tabel
			$this->db->where('month(tanggal)', $month); // 'tanggal' adalah nama kolom tanggal dalam tabel
			$query = $this->db->get();
			return $query->num_rows();
		}
	}
	public function byDate($niy, $tanggal)
	{
		$this->db->from($this->table);
		$this->db->where('niy', $niy);
		$this->db->where('tanggal', $tanggal);
		$query = $this->db->get();
		$result = $query->row_array();
		if (empty($result)) {
			return [];
		}
		return $result;

	}
	public function getById($id)
	{
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();

	}
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function insert($data)
	{
		return $this->db->insert_batch($this->table, $data);
	}
	public function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}

}
