<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

	}
	public function jumlah_pegawai()
	{
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('pegawai');
		$this->db->where('jabatan <>', 'Kepala Sekolah');
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_cuti()
	{
		return $this->db->count_all('izin_cuti');
	}
	public function jumlah_sakit()
	{
		return $this->db->count_all('izin_sakit');
	}
	public function jumlah_lembur()
	{
		return $this->db->count_all('lembur');
	}
	public function jumlah_cuti_pegawai()
	{
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('izin_cuti');
		$this->db->where('niy', $this->session->userdata['niy']);
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_sakit_pegawai()
	{
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('izin_sakit');
		$this->db->where('nama', $this->session->userdata['nama']);
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_lembur_pegawai()
	{
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('lembur');
		$this->db->where('nama', $this->session->userdata['nama']);
		$query = $this->db->get();
		return $query->row()->jumlah;
	}

}
