<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    public function get_laporan_per_siswa($id_pembayaran = '', $id_kelas = '')
    {
        $this->db->select('*, COALESCE(SUM(jumlah_dibayar),0) AS jumlah_dibayar, COALESCE(nominal, 0) - COALESCE(SUM(jumlah_dibayar),0) AS sisa_bayar');
        $this->db->join('siswa', 'nis', 'right');
        $this->db->join('pembayaran', 'id_pembayaran', 'left');
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->or_where('id_pembayaran is null');
        $this->db->where('siswa.id_kelas', $id_kelas);
        $this->db->group_by('nis');
        return $this->db->get('transaksi')->result_array();
    }

}

/* End of file Laporan_model.php */
/* Location: ./application/models/Laporan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 17:16:57 */
/* http://harviacode.com */