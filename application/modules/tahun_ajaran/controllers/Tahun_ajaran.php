<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun_ajaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tahun_ajaran_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['judul'] = 'Data Tahun Ajaran';

        $this->load->view('templates/header', $data);
        $this->load->view('tahun_ajaran/tahun_ajaran_list', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Tahun_ajaran_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tahun_ajaran_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_tahun_ajaran' => $row->id_tahun_ajaran,
              'tahun_ajaran' => $row->tahun_ajaran,
          );

            $data['judul'] = 'Detail Tahun_ajaran';

            $this->load->view('templates/header', $data);
            $this->load->view('tahun_ajaran/tahun_ajaran_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tahun_ajaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tahun_ajaran/create_action'),
            'id_tahun_ajaran' => set_value('id_tahun_ajaran'),
            'tahun_ajaran' => set_value('tahun_ajaran'),
        );

        $data['judul'] = 'Tambah Tahun Ajaran';

        $this->load->view('templates/header', $data);
        $this->load->view('tahun_ajaran/tahun_ajaran_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
          );

            $this->Tahun_ajaran_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('tahun_ajaran'));
        }
    }

    public function update($id) 
    {
        $row = $this->Tahun_ajaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tahun_ajaran/update_action'),
                'id_tahun_ajaran' => set_value('id_tahun_ajaran', $row->id_tahun_ajaran),
                'tahun_ajaran' => set_value('tahun_ajaran', $row->tahun_ajaran),
            );

            $data['judul'] = 'Ubah Tahun Ajaran';

            $this->load->view('templates/header', $data);
            $this->load->view('tahun_ajaran/tahun_ajaran_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tahun_ajaran'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tahun_ajaran', TRUE));
        } else {
            $data = array(
              'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
          );

            $this->Tahun_ajaran_model->update($this->input->post('id_tahun_ajaran', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('tahun_ajaran'));
        }
    }

    public function delete($id) 
    {
        if ($this->db->get_where('siswa', ['id_tahun_ajaran' => $id])->row_array()) {
            $this->session->set_flashdata('error', 'Masih terdapat data turunan yang berhubungan');
            redirect(site_url('tahun_ajaran'));
        }
        if ($this->db->get_where('pembayaran', ['id_tahun_ajaran' => $id])->row_array()) {
            $this->session->set_flashdata('error', 'Masih terdapat data turunan yang berhubungan');
            redirect(site_url('tahun_ajaran'));
        }

        $row = $this->Tahun_ajaran_model->get_by_id($id);

        if ($row) {
            $this->Tahun_ajaran_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('tahun_ajaran'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('tahun_ajaran'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('tahun_ajaran', 'tahun ajaran', 'trim|required');

       $this->form_validation->set_rules('id_tahun_ajaran', 'id_tahun_ajaran', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "tahun_ajaran.xls";
    $judul = "tahun_ajaran";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Tahun Ajaran");

    foreach ($this->Tahun_ajaran_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteNumber($tablebody, $kolombody++, $data->tahun_ajaran);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=tahun_ajaran.doc");

    $data = array(
        'tahun_ajaran_data' => $this->Tahun_ajaran_model->get_all(),
        'start' => 0
    );

    $this->load->view('tahun_ajaran/tahun_ajaran_doc',$data);
}

}

/* End of file Tahun_ajaran.php */
/* Location: ./application/controllers/Tahun_ajaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-30 13:24:00 */
                        /* http://harviacode.com */