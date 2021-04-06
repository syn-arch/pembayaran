<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi_model');
        $this->load->model('siswa/siswa_model');
        $this->load->model('kategori/kategori_model');
        $this->load->model('pembayaran/pembayaran_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['judul'] = 'Data Transaksi';

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi/transaksi_list', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json();
    }

    public function lastjson() {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->lastjson();
    }

    public function read($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_transaksi' => $row->id_transaksi,
              'nama_id_pembayaran' => $row->nama_id_pembayaran,
              'nama_siswa' => $row->nama_siswa,
              'nis' => $row->nis,
              'tgl' => $row->tgl,
              'tahun_dibayar' => $row->tahun_dibayar,
              'jumlah_dibayar' => $row->jumlah_dibayar,
              'status' => $row->status,
              'bukti_pembayaran' => $row->bukti_pembayaran,
          );

            $data['judul'] = 'Detail Transaksi';

            $this->load->view('templates/header', $data);
            $this->load->view('transaksi/transaksi_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('transaksi'));
        }
    }

    public function create() 
    {
        $data['judul'] = 'Transaksi Baru';
        $data['kategori'] = $this->pembayaran_model->get_kategori_pembayaran($this->input->get('nis'));

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi/transaksi_add', $data);
        $this->load->view('templates/footer', $data);
    }

    public function bayar($nis, $id_pembayaran) 
    {
        $data['judul'] = 'Pembayaran';
        $data['pembayaran'] = $this->pembayaran_model->get_by_id($id_pembayaran);
        $data['siswa'] = $this->siswa_model->get_by_nis($nis);
        $data['telah_dibayar'] = $this->Transaksi_model->get_telah_dibayar($nis, $id_pembayaran);

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi/transaksi_bayar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {

        $data = array(
          'id_pembayaran' => $this->input->post('id_pembayaran',TRUE),
          'nis' => $this->input->post('nis',TRUE),
          'no_faktur' => $this->input->post('no_faktur',TRUE),
          'jumlah_dibayar' => $this->input->post('jumlah_dibayar',TRUE),
          'tahun_dibayar' => date('Y'),
          'status' => 'dierima',
          'bukti_pembayaran' => _upload('bukti', 'transaksi/bayar/' . $this->input->post('nis') . '/' . $this->input->post('id_pembayaran'), 'bukti_pembayaran')
        );

        $this->Transaksi_model->insert($data);
        $this->session->set_flashdata('success', 'Ditambah');
        redirect(site_url('transaksi'));
    }

    public function update($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
                'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
                'id_id_pembayaran' => set_value('id_id_pembayaran', $row->id_id_pembayaran),
                'nis' => set_value('nis', $row->nis),
                'tgl' => set_value('tgl', $row->tgl),
                'tahun_dibayar' => set_value('tahun_dibayar', $row->tahun_dibayar),
                'jumlah_dibayar' => set_value('jumlah_dibayar', $row->jumlah_dibayar),
                'status' => set_value('status', $row->status),
                'bukti_pembayaran' => set_value('bukti_pembayaran', $row->bukti_pembayaran),
            );

            $data['judul'] = 'Ubah Transaksi';
            $data['id_pembayaran'] = $this->kategori_model->get_all();
            $data['siswa'] = $this->siswa_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('transaksi/transaksi_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('transaksi'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_transaksi', TRUE));
        } else {
            $data = array(
              'id_id_pembayaran' => $this->input->post('id_id_pembayaran',TRUE),
              'nis' => $this->input->post('nis',TRUE),
              'tgl' => $this->input->post('tgl',TRUE),
              'tahun_dibayar' => $this->input->post('tahun_dibayar',TRUE),
              'jumlah_dibayar' => $this->input->post('jumlah_dibayar',TRUE),
              'status' => $this->input->post('status',TRUE),
              'bukti_pembayaran' => $this->input->post('bukti_pembayaran',TRUE),
          );

            $this->Transaksi_model->update($this->input->post('id_transaksi', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('transaksi'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('transaksi'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('transaksi'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('id_id_pembayaran', 'id id_pembayaran', 'trim|required|numeric');
       $this->form_validation->set_rules('nis', 'nis', 'trim|required|numeric');
       $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
       $this->form_validation->set_rules('tahun_dibayar', 'tahun dibayar', 'trim|required|numeric');
       $this->form_validation->set_rules('jumlah_dibayar', 'jumlah dibayar', 'trim|required|numeric');
       $this->form_validation->set_rules('status', 'status', 'trim|required');
       $this->form_validation->set_rules('bukti_pembayaran', 'bukti pembayaran', 'trim');

       $this->form_validation->set_rules('id_transaksi', 'id_transaksi', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "transaksi.xls";
    $judul = "transaksi";
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
    xlsWriteLabel($tablehead, $kolomhead++, "id_pembayaran");
    xlsWriteLabel($tablehead, $kolomhead++, "Siswa");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
    xlsWriteLabel($tablehead, $kolomhead++, "Tahun Dibayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Dibayar");
    xlsWriteLabel($tablehead, $kolomhead++, "Status");

    foreach ($this->Transaksi_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteNumber($tablebody, $kolombody++, $data->nama_id_pembayaran);
        xlsWriteNumber($tablebody, $kolombody++, $data->nama_siswa);
        xlsWriteLabel($tablebody, $kolombody++, $data->tgl);
        xlsWriteNumber($tablebody, $kolombody++, $data->tahun_dibayar);
        xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_dibayar);
        xlsWriteLabel($tablebody, $kolombody++, $data->status);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=transaksi.doc");

    $data = array(
        'transaksi_data' => $this->Transaksi_model->get_all(),
        'start' => 0
    );

    $this->load->view('transaksi/transaksi_doc',$data);
}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 19:17:59 */
                        /* http://harviacode.com */