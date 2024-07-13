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
