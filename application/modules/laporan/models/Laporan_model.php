<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    public function get_laporan_per_siswa($id_pembayaran = '', $id_kelas = '')
    {
        $this->db->join('siswa', 'nis');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->where('kelas.id_kelas', $id_kelas);
        $trs =  $transaksi_kelas = $this->db->get('transaksi')->result_array();
        
        if ($trs) {
            $null = false;
        }else{
            $null = true;
        }

        $this->db->select('*, COALESCE(SUM(jumlah_dibayar),0) AS jumlah_dibayar, COALESCE(nominal, 0) - COALESCE(SUM(jumlah_dibayar),0) AS sisa_bayar');
        $this->db->join('siswa', 'nis', 'right');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');
        $this->db->join('pembayaran', 'id_pembayaran', 'left');
        if (!$null) {
             $this->db->where('id_pembayaran', $id_pembayaran);
        }
        $this->db->or_where('id_pembayaran is null');            
        $this->db->where('kelas.id_kelas', $id_kelas);
        $this->db->group_by('nis');
        return $this->db->get('transaksi')->result_array();
    }

    public function get_laporan_per_kelas($id_pembayaran = '', $id_jurusan = '')
    {
        $this->db->select('
            kelas.id_kelas,
            nama_kelas, 
            nominal, 
            COUNT(DISTINCT(siswa.id_siswa)) AS jml_siswa,
            nominal * COUNT(DISTINCT(siswa.id_siswa)) AS harus_bayar,
            SUM(jumlah_dibayar) AS telah_dibayar
            ');
        $this->db->join('siswa', 'nis', 'right');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pembayaran', 'id_pembayaran', 'left');
        $this->db->where('id_pembayaran', $id_pembayaran);
        $this->db->or_where('id_pembayaran is null');
        $this->db->where('kelas.id_jurusan', $id_jurusan);
        $this->db->group_by('kelas.id_kelas');
        return $this->db->get('transaksi')->result_array();
    }

    public function get_laporan_per_jurusan($id_kategori = '', $tahun_angkatan = '')
    {
        $this->db->select('
            jurusan.id_jurusan,
            nama_jurusan, 
            pembayaran.nominal,
            COUNT(DISTINCT(kelas.id_kelas)) AS jml_kelas,
            COUNT(DISTINCT(siswa.id_siswa)) AS jml_siswa,
            nominal * COUNT(DISTINCT(siswa.id_siswa)) AS harus_dibayar,
            SUM(jumlah_dibayar) AS telah_dibayar
            ');
        $this->db->join('siswa', 'nis', 'right');
        $this->db->join('jurusan', 'siswa.id_jurusan = jurusan.id_jurusan');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
        $this->db->join('pembayaran', 'id_pembayaran', 'left');
        $this->db->where('pembayaran.tahun_angkatan', $tahun_angkatan);
        $this->db->where('id_kategori', $id_kategori);
        $this->db->or_where('id_pembayaran is null');
        $this->db->or_where('id_kategori is null');
        $this->db->group_by('jurusan.id_jurusan');
        return $this->db->get('transaksi')->result_array();
    }

}

/* End of file Laporan_model.php */
/* Location: ./application/models/Laporan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 17:16:57 */
/* http://harviacode.com */