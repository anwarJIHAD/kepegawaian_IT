<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Lembur_model extends CI_Model
{
	public $table = 'lembur';
	public $id = 'lembur.id';
	public function __construct()
	{
		parent::__construct();
	}
	public function get()
	{
		$role = $this->session->userdata('role');
		if ($role == 'Admin' || $role == 'kepala sekolah') {
			$this->db->select('pegawai.*, lembur.id AS id_lembur, lembur.*');
			$this->db->from($this->table);
			$this->db->join('pegawai', 'lembur.niy = pegawai.niy', 'inner');
			$query = $this->db->get();
		} else {
			$logged_in_user_id = $this->session->userdata('niy');
			$this->db->select('pegawai.*, lembur.id AS id_lembur, lembur.*');
			$this->db->from($this->table);
			$this->db->join('pegawai', 'lembur.niy = pegawai.niy', 'inner');
			$this->db->where('lembur.niy', $logged_in_user_id);
			$query = $this->db->get();
		}
		return $query->result_array();
	}
	public function insert_batch($data)
	{
		return $this->db->insert_batch($this->table, $data);
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
}
