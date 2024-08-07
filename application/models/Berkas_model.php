<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Berkas_model extends CI_Model
{
    public $table = 'berkas';
    public $id = 'berkas.id';
    public function __construct()
    {
        parent::__construct();
    }
    public function get()
    {
        $logged_in_user_id = $this->session->userdata('id');

        // Ambil peran pengguna yang sedang login
        $this->db->select('role');
        $this->db->from('pegawai');
        $this->db->where('id', $logged_in_user_id);
        $query = $this->db->get();
        $logged_in_user = $query->row();

        // Cek apakah pengguna yang sedang login adalah kepala sekolah
        if ($logged_in_user->role !== 'kepala sekolah') {
            $this->db->where('pegawai.id', $logged_in_user_id);
        }

        // Ambil data pegawai dan berkas
        $this->db->select('pegawai.niy, pegawai.nama, berkas.file_berkas, berkas.keterangan, berkas.id,berkas.id_pegawai');
        $this->db->from('pegawai');
        $this->db->join('berkas', 'berkas.id_pegawai = pegawai.id');
        $query = $this->db->get();

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
}
