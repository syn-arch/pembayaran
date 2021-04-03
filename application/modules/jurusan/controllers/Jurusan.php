<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['judul'] = 'Data Jurusan';

        $this->load->view('templates/header', $data);
        $this->load->view('jurusan/jurusan_list', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Jurusan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_jurusan' => $row->id_jurusan,
              'nama_jurusan' => $row->nama_jurusan,
          );

            $data['judul'] = 'Detail Jurusan';

            $this->load->view('templates/header', $data);
            $this->load->view('jurusan/jurusan_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('jurusan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jurusan/create_action'),
            'id_jurusan' => set_value('id_jurusan'),
            'nama_jurusan' => set_value('nama_jurusan'),
        );

        $data['judul'] = 'Tambah Jurusan';

        $this->load->view('templates/header', $data);
        $this->load->view('jurusan/jurusan_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
          );

            $this->Jurusan_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('jurusan'));
        }
    }

    public function update($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jurusan/update_action'),
                'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
                'nama_jurusan' => set_value('nama_jurusan', $row->nama_jurusan),
            );

            $data['judul'] = 'Ubah Jurusan';

            $this->load->view('templates/header', $data);
            $this->load->view('jurusan/jurusan_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('jurusan'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jurusan', TRUE));
        } else {
            $data = array(
              'nama_jurusan' => $this->input->post('nama_jurusan',TRUE),
          );

            $this->Jurusan_model->update($this->input->post('id_jurusan', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('jurusan'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);

        if ($row) {
            $this->Jurusan_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('jurusan'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('jurusan'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('nama_jurusan', 'nama jurusan', 'trim|required');

       $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "jurusan.xls";
    $judul = "jurusan";
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

    foreach ($this->Jurusan_model->get_all() as $data) {
        $kolombody = 0;

        //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_jurusan);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=jurusan.doc");

    $data = array(
        'jurusan_data' => $this->Jurusan_model->get_all(),
        'start' => 0
    );

    $this->load->view('jurusan/jurusan_doc',$data);
}

}

/* End of file Jurusan.php */
/* Location: ./application/controllers/Jurusan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 17:04:31 */
                        /* http://harviacode.com */