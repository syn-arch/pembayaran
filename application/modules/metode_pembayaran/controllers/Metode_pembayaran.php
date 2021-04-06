<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Metode_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Metode_pembayaran_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['judul'] = 'Metode Pembayaran';

        $this->load->view('templates/header', $data);
        $this->load->view('metode_pembayaran/metode_pembayaran_list', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Metode_pembayaran_model->json();
    }

    public function read($id) 
    {
        $row = $this->Metode_pembayaran_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_metode_pembayaran' => $row->id_metode_pembayaran,
              'nama_bank' => $row->nama_bank,
              'atas_nama' => $row->atas_nama,
              'no_rekening' => $row->no_rekening,
              'keterangan' => $row->keterangan,
          );

            $data['judul'] = 'Detail Metode_pembayaran';

            $this->load->view('templates/header', $data);
            $this->load->view('metode_pembayaran/metode_pembayaran_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('metode_pembayaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('metode_pembayaran/create_action'),
            'id_metode_pembayaran' => set_value('id_metode_pembayaran'),
            'nama_bank' => set_value('nama_bank'),
            'atas_nama' => set_value('atas_nama'),
            'no_rekening' => set_value('no_rekening'),
            'keterangan' => set_value('keterangan'),
        );

        $data['judul'] = 'Tambah Metode Pembayaran';

        $this->load->view('templates/header', $data);
        $this->load->view('metode_pembayaran/metode_pembayaran_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'nama_bank' => $this->input->post('nama_bank',TRUE),
              'atas_nama' => $this->input->post('atas_nama',TRUE),
              'no_rekening' => $this->input->post('no_rekening',TRUE),
              'keterangan' => $this->input->post('keterangan',TRUE),
          );

            $this->Metode_pembayaran_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('metode_pembayaran'));
        }
    }

    public function update($id) 
    {
        $row = $this->Metode_pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('metode_pembayaran/update_action'),
                'id_metode_pembayaran' => set_value('id_metode_pembayaran', $row->id_metode_pembayaran),
                'nama_bank' => set_value('nama_bank', $row->nama_bank),
                'atas_nama' => set_value('atas_nama', $row->atas_nama),
                'no_rekening' => set_value('no_rekening', $row->no_rekening),
                'keterangan' => set_value('keterangan', $row->keterangan),
            );

            $data['judul'] = 'Ubah Metode Pembayaran';

            $this->load->view('templates/header', $data);
            $this->load->view('metode_pembayaran/metode_pembayaran_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('metode_pembayaran'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_metode_pembayaran', TRUE));
        } else {
            $data = array(
              'nama_bank' => $this->input->post('nama_bank',TRUE),
              'atas_nama' => $this->input->post('atas_nama',TRUE),
              'no_rekening' => $this->input->post('no_rekening',TRUE),
              'keterangan' => $this->input->post('keterangan',TRUE),
          );

            $this->Metode_pembayaran_model->update($this->input->post('id_metode_pembayaran', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('metode_pembayaran'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Metode_pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Metode_pembayaran_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('metode_pembayaran'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('metode_pembayaran'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('nama_bank', 'nama bank', 'trim|required');
       $this->form_validation->set_rules('atas_nama', 'atas nama', 'trim|required');
       $this->form_validation->set_rules('no_rekening', 'no rekening', 'trim|required');
       $this->form_validation->set_rules('keterangan', 'keterangan', 'trim');

       $this->form_validation->set_rules('id_metode_pembayaran', 'id_metode_pembayaran', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "metode_pembayaran.xls";
    $judul = "metode_pembayaran";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Bank");
    xlsWriteLabel($tablehead, $kolomhead++, "Atas Nama");
    xlsWriteLabel($tablehead, $kolomhead++, "No Rekening");
    xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

    foreach ($this->Metode_pembayaran_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_bank);
        xlsWriteLabel($tablebody, $kolombody++, $data->atas_nama);
        xlsWriteLabel($tablebody, $kolombody++, $data->no_rekening);
        xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=metode_pembayaran.doc");

    $data = array(
        'metode_pembayaran_data' => $this->Metode_pembayaran_model->get_all(),
        'start' => 0
    );

    $this->load->view('metode_pembayaran/metode_pembayaran_doc',$data);
}

}

/* End of file Metode_pembayaran.php */
/* Location: ./application/controllers/Metode_pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-06 11:08:10 */
                        /* http://harviacode.com */