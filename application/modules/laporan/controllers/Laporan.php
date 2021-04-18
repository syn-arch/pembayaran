<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('laporan_model');
        $this->load->model('kelas/kelas_model');
        $this->load->model('jurusan/jurusan_model');
        $this->load->model('kategori/kategori_model');
        $this->load->model('pembayaran/pembayaran_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['judul'] = 'Laporan Transaksi';

        $this->load->view('templates/header', $data);
        $this->load->view('laporan/laporan', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function per_siswa()
    {
        $id_pembayaran = $this->input->get('id_pembayaran');
        $id_kelas = $this->input->get('id_kelas');

        $data['judul'] = 'Laporan Per Siswa';
        $data['kelas'] = $this->kelas_model->get_all();
        $data['kategori'] = $this->pembayaran_model->get_all();

        if ($id_pembayaran) {
            $data['laporan'] = $this->laporan_model->get_laporan_per_siswa($id_pembayaran, $id_kelas);
            $data['pembayaran'] = $this->pembayaran_model->get_by_id($id_pembayaran);
            $data['kelas'] = $this->kelas_model->get_by_id($id_kelas);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('laporan/per_siswa', $data);
        $this->load->view('templates/footer', $data);
    } 


    public function per_kelas()
    {
        $id_pembayaran = $this->input->get('id_pembayaran');

        $data['judul'] = 'Laporan Per Kelas';
        $data['kategori'] = $this->pembayaran_model->get_all();

        if ($id_pembayaran) {
            $data['pembayaran'] = $this->pembayaran_model->get_by_id($id_pembayaran);
            $data['laporan'] = $this->laporan_model->get_laporan_per_kelas($id_pembayaran, $data['pembayaran']->id_jurusan);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('laporan/per_kelas', $data);
        $this->load->view('templates/footer', $data);
    } 


    public function per_jurusan()
    {
        $id_kategori = $this->input->get('id_kategori');
        $tahun_angkatan = $this->input->get('tahun_angkatan');

        $data['judul'] = 'Laporan Per jurusan';
        $data['kategori'] = $this->kategori_model->get_all();

        if ($id_kategori) {
            $data['kategori'] = $this->kategori_model->get_by_id($this->input->get('id_kategori'));
            $data['pembayaran'] = $this->pembayaran_model->get_pembayaran($id_kategori, $tahun_angkatan);
            $data['laporan'] = $this->laporan_model->get_laporan_per_jurusan($id_kategori, $tahun_angkatan);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('laporan/per_jurusan', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function export_persiswa($id_pembayaran, $id_kelas)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan per siswa.xls";
        $judul = "laporan per siswa";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        // penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Siswa");
        xlsWriteLabel($tablehead, $kolomhead++, "NIS");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Dibayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        $lap = $this->laporan_model->get_laporan_per_siswa($id_pembayaran, $id_kelas);
        $pembayaran = $this->pembayaran_model->get_by_id($id_pembayaran);


        foreach ($lap as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['nama_siswa']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nis']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jk']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jumlah_dibayar']);

            if ($data['nominal'] == 0){
                xlsWriteLabel($tablebody, $kolombody++, $pembayaran->nominal);
                xlsWriteLabel($tablebody, $kolombody++, 'BELUM BAYAR');
            }else{
                xlsWriteLabel($tablebody, $kolombody++, $data['sisa_bayar']);

                if ($data['jumlah_dibayar'] >= $pembayaran->nominal) {
                    xlsWriteLabel($tablebody, $kolombody++, 'LUNAS');
                }else{
                    xlsWriteLabel($tablebody, $kolombody++, 'BELUM LUNAS');
                }
            }


            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function export_perkelas($id_pembayaran)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan per kelas.xls";
        $judul = "laporan per kelas";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Kelas");
        xlsWriteLabel($tablehead, $kolomhead++, "Telah Dibayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Siswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Siswa Bayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah SIswa Belum Bayar");

        $pembayaran = $this->pembayaran_model->get_by_id($id_pembayaran);
        $lap = $this->laporan_model->get_laporan_per_kelas($id_pembayaran, $pembayaran->id_jurusan);

        foreach ($lap as $row) {
            $kolombody = 0;

            $this->db->select('count(distinct(nis)) as sudah_bayar');
            $this->db->join('siswa', 'nis');
            $this->db->where('siswa.id_kelas', $row['id_kelas']);
            $sudah_bayar = $this->db->get('transaksi')->row_array()['sudah_bayar'];

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $row['nama_kelas']);
            xlsWriteLabel($tablebody, $kolombody++, $row['telah_dibayar']);
            xlsWriteLabel($tablebody, $kolombody++, ($pembayaran->nominal * $row['jml_siswa']) -  $row['telah_dibayar']);
            xlsWriteLabel($tablebody, $kolombody++, $row['jml_siswa']);
            xlsWriteLabel($tablebody, $kolombody++, $sudah_bayar);
            xlsWriteLabel($tablebody, $kolombody++, $row['jml_siswa'] - $sudah_bayar);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function export_perjurusan($id_kategori, $tahun_angkatan)
    {
        $this->load->helper('exportexcel');
        $namaFile = "laporan per jurusan.xls";
        $judul = "laporan per jurusan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Jurusan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nominal");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Kelas");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Siswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Harus Dibayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Telah Dibayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Sisa Bayar");

        $pembayaran = $this->pembayaran_model->get_pembayaran($id_kategori, $tahun_angkatan);
        $lap = $this->laporan_model->get_laporan_per_jurusan($id_kategori, $tahun_angkatan);

        foreach ($lap as $index => $row) {
            $kolombody = 0;

            $pembayaran_nominal = $pembayaran[$index]->nominal ?? 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $row['nama_jurusan']);
            xlsWriteLabel($tablebody, $kolombody++, $pembayaran_nominal);
            xlsWriteLabel($tablebody, $kolombody++, $row['jml_kelas']);
            xlsWriteLabel($tablebody, $kolombody++, $row['jml_siswa']);
            xlsWriteLabel($tablebody, $kolombody++, $row['jml_siswa'] * $pembayaran_nominal);
            xlsWriteLabel($tablebody, $kolombody++, $row['telah_dibayar']);
            xlsWriteLabel($tablebody, $kolombody++, $row['jml_siswa'] * $pembayaran_nominal - $row['telah_dibayar'] );

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file laporan.php */
/* Location: ./application/controllers/laporan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 17:16:57 */
/* http://harviacode.com */