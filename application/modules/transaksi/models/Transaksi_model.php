<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $table = 'transaksi';
    public $id = 'id_transaksi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json_siswa() {
        $this->datatables->select('id_transaksi,no_faktur,nis,nama_kategori,nama_siswa,tgl,tahun_dibayar,jumlah_dibayar,status,bukti_pembayaran,transaksi.keterangan');
        $this->datatables->from('transaksi');
        //add this line for join
        $this->datatables->join('pembayaran', 'id_pembayaran');
        $this->datatables->join('kategori', 'kategori.id_kategori = pembayaran.id_kategori');
        $this->datatables->join('siswa', 'nis');
        $this->datatables->where('id_siswa', $this->session->userdata('id_siswa'));
        $this->datatables->add_column('action', 
            '<a target="_blank" href="'  . site_url('transaksi/invoice/$1') . '" class="btn btn-primary"><i class="fa fa-print"></i> CETAK</a>', 'id_transaksi
            ');
        return $this->datatables->generate();
    }


    // datatables
    function json() {
        if ($this->session->userdata('petugas') == 1) {
            $this->datatables->where('siswa.id_jurusan', $this->session->userdata('id_jurusan'));
        }

        $this->datatables->select('id_transaksi,no_faktur,nis,nama_kategori,nama_siswa,tgl,tahun_dibayar,jumlah_dibayar,status,bukti_pembayaran');
        $this->datatables->from('transaksi');
        //add this line for join
        $this->datatables->join('pembayaran', 'id_pembayaran');
        $this->datatables->join('kategori', 'kategori.id_kategori = pembayaran.id_kategori');
        $this->datatables->join('siswa', 'nis');
        $this->datatables->add_column('action', 
            '<a href="'  . site_url('transaksi/read/$1') . '" class="btn btn-info"><i class="fa fa-eye"></i></a> 
            <a target="_blank" href="'  . site_url('transaksi/invoice/$1') . '" class="btn btn-success"><i class="fa fa-print"></i></a> 
            <a href="'  . site_url('transaksi/update/$1') . '" class="btn btn-warning"><i class="fa fa-edit"></i></a> 
            <a data-href="'  . site_url('transaksi/delete/$1') . '" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>', 'id_transaksi');
        return $this->datatables->generate();
    }

    // datatables
    function lastjson() {
        $this->datatables->select('id_transaksi,no_faktur,nis,nama_kategori,nama_siswa,tgl,tahun_dibayar,jumlah_dibayar,status,bukti_pembayaran');
        $this->datatables->from('transaksi');
        //add this line for join
        $this->db->order_by('id_transaksi', 'desc');
        $this->db->limit(10);
        $this->datatables->join('pembayaran', 'id_pembayaran');
        $this->datatables->join('kategori', 'kategori.id_kategori = pembayaran.id_kategori');
        $this->datatables->join('siswa', 'nis');
        $this->datatables->add_column('action', 
            '<a href="'  . site_url('transaksi/read/$1') . '" class="btn btn-info"><i class="fa fa-eye"></i></a> 
            <a href="'  . site_url('transaksi/update/$1') . '" class="btn btn-warning"><i class="fa fa-edit"></i></a> 
            <a data-href="'  . site_url('transaksi/delete/$1') . '" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>', 'id_transaksi');
        return $this->datatables->generate();
    }

    public function get_telah_dibayar($nis, $id_pembayaran)
    {
        $this->db->select_sum('jumlah_dibayar', 'telah_dibayar');
        $this->db->where('nis', $nis);
        $this->db->where('status', 'diterima');
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->get('transaksi')->row()->telah_dibayar;
    }

    // get all
    function get_all()
    {
        $this->db->join('pembayaran', 'id_pembayaran');
        $this->db->join('kategori', 'kategori.id_kategori = pembayaran.id_kategori', 'left');
        $this->db->join('siswa', 'nis', 'left');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {

        if ($this->session->userdata('nis')) {
            $trs = $this->db->get_where('transaksi', ['nis' => $this->session->userdata('nis'), 'id_transaksi' => $id])->row_array();

            if ($trs['nis'] != $this->session->userdata('nis')) {
                die('INVALID');
            }
        }

        $this->db->select('*, transaksi.keterangan');
        $this->db->join('pembayaran', 'id_pembayaran');
        $this->db->join('kategori', 'kategori.id_kategori = pembayaran.id_kategori', 'left');
        $this->db->join('siswa', 'nis', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = siswa.id_jurusan');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_transaksi', $q);
        $this->db->or_like('id_kategori', $q);
        $this->db->or_like('nis', $q);
        $this->db->or_like('tgl', $q);
        $this->db->or_like('tahun_dibayar', $q);
        $this->db->or_like('jumlah_dibayar', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('bukti_pembayaran', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_transaksi', $q);
        $this->db->or_like('id_kategori', $q);
        $this->db->or_like('nis', $q);
        $this->db->or_like('tgl', $q);
        $this->db->or_like('tahun_dibayar', $q);
        $this->db->or_like('jumlah_dibayar', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('bukti_pembayaran', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 19:17:59 */
/* http://harviacode.com */