<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Notifikasi_model extends CI_Model
{
    public $table = 'notifikasi';
    public $id = 'notifikasi.id';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function getcuti()
    {
        $this->db->select('notifikasi.*, izin_cuti.*');
        $this->db->from('notifikasi');
        $this->db->join('izin_cuti', 'notifikasi.izin_cuti_id = izin_cuti.id');
        $this->db->where('izin_cuti.status', 'Diajukan'); // Filter berdasarkan status izin cuti
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getsakit()
    {
        $this->db->select('notifikasi.*, izin_sakit.*');
        $this->db->from('notifikasi');
        $this->db->join('izin_sakit', 'notifikasi.izin_sakit_id = izin_sakit.id');
        $this->db->where('izin_sakit.status', 'Diajukan'); // Filter berdasarkan status izin cuti
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getizin()
    {
        $this->db->select('notifikasi.*, izin.*');
        $this->db->from('notifikasi');
        $this->db->join('izin', 'notifikasi.izin_id = izin.id');
        $this->db->where('izin.status', 'Diajukan'); // Filter berdasarkan status izin cuti
        $query = $this->db->get();
        return $query->result_array();
    }
}
