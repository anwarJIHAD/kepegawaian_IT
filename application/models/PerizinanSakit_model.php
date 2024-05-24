<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PerizinanSakit_model extends CI_Model
{
	public $table = 'izin_sakit';
	public $id = 'izin_sakit.id';
	public function __construct()
	{
		parent::__construct();

	}
	public function get()
	{
		$role = $this->session->userdata('role');
		if ($role == 'Admin' || $role == 'kepala sekolah') {
			$this->db->select('pegawai.*, izin_sakit.id AS id_sakit, izin_sakit.*');
			$this->db->from($this->table);
			$this->db->join('pegawai', 'izin_sakit.niy = pegawai.niy', 'inner');
			$query = $this->db->get();
		} else {
			$logged_in_user_id = $this->session->userdata('niy');
			$this->db->select('pegawai.*, izin_sakit.id AS id_sakit, izin_sakit.*');
			$this->db->from($this->table);
			$this->db->join('pegawai', 'izin_sakit.niy = pegawai.niy', 'inner');
			$this->db->where('izin_sakit.niy', $logged_in_user_id);
			$query = $this->db->get();
		}
		return $query->result_array();
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
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}
	public function getDataByYear($tahun, $month)
	{
		$this->db->select('month(tgl_izin)');
		$this->db->from('izin_sakit'); // Ganti 'nama_tabel' dengan nama tabel Anda
		if ($tahun != '') {
			$this->db->where('YEAR(tgl_izin)', $tahun);
		}
		// 'tanggal' adalah nama kolom tanggal dalam tabel
		$this->db->where('month(tgl_izin)', $month); // 'tanggal' adalah nama kolom tanggal dalam tabel
		$query = $this->db->get();
		return $query->num_rows();
	}

}
