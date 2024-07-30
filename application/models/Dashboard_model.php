

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
		// $this->db->where('jabatan <>', 'Kepala Sekolah');
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_cuti()
	{
		if (in_array($this->session->userdata('role'), ['guru', 'pustakawati'])) {
			$this->db->where('niy', $this->session->userdata('niy'));
		}
		return $this->db->count_all_results('izin_cuti');
	}
	public function jumlah_sakit()
	{
		if (in_array($this->session->userdata('role'), ['guru', 'pustakawati'])) {
			$this->db->where('niy', $this->session->userdata('niy'));
		}
		return $this->db->count_all_results('izin_sakit');
	}
	public function jumlah_lembur()
	{
		if (in_array($this->session->userdata('role'), ['guru', 'pustakawati'])) {
			$this->db->where('niy', $this->session->userdata('niy'));
		}
		return $this->db->count_all_results('lembur');
	}
	public function jumlah_cuti_pegawai($tahun = '')
	{
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('izin_cuti');
		$this->db->where('niy', $this->session->userdata['niy']);
		$this->db->where('jenis_cuti', 'Cuti');
		if ($tahun != '') {
			$this->db->where('YEAR(tgl_izin)', $tahun);
		}
		$this->db->where('status', 'Diterima');
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_cuti_diterima($tahun = '')
	{
		if (in_array($this->session->userdata('role'), ['guru', 'pustakawati'])) {
			$this->db->where('niy', $this->session->userdata('niy'));
		}
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('izin_cuti');
		$this->db->where('status', 'Diterima');
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_cuti_ditolak($tahun = '')
	{
		if (in_array($this->session->userdata('role'), ['guru', 'pustakawati'])) {
			$this->db->where('niy', $this->session->userdata('niy'));
		}
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('izin_cuti');
		$this->db->where('status', 'Ditolak');
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_sakit_pegawai()
	{
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('izin_sakit');
		$this->db->where('niy', $this->session->userdata['niy']);
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_sakit_disetujui($tahun = '')
	{
		if (in_array($this->session->userdata('role'), ['guru', 'pustakawati'])) {
			$this->db->where('niy', $this->session->userdata('niy'));
		}
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('izin_sakit');
		$this->db->where('status', 'Disetujui');
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_sakit_ditolak($tahun = '')
	{
		if (in_array($this->session->userdata('role'), ['guru', 'pustakawati'])) {
			$this->db->where('niy', $this->session->userdata('niy'));
		}
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('izin_sakit');
		$this->db->where('status', 'Ditolak');
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
	public function jumlah_lembur_pegawai()
	{
		$this->db->select('COUNT(*) as jumlah');
		$this->db->from('lembur');
		$this->db->where('niy', $this->session->userdata['niy']);
		$query = $this->db->get();
		return $query->row()->jumlah;
	}
}

