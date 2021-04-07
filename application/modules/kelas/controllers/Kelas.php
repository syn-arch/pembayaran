<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('jurusan/jurusan_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['judul'] = 'Data Kelas';

        $this->load->view('templates/header', $data);
        $this->load->view('kelas/kelas_list', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Kelas_model->json();
    }

    public function read($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_kelas' => $row->id_kelas,
              'nama_jurusan' => $row->nama_jurusan,
              'nama_kelas' => $row->nama_kelas,
          );

            $data['judul'] = 'Detail Kelas';

            $this->load->view('templates/header', $data);
            $this->load->view('kelas/kelas_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('kelas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelas/create_action'),
            'id_kelas' => set_value('id_kelas'),
            'id_jurusan' => set_value('id_jurusan'),
            'nama_kelas' => set_value('nama_kelas'),
        );

        $data['judul'] = 'Tambah Kelas';
        $data['jurusan'] = $this->jurusan_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('kelas/kelas_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'nama_kelas' => $this->input->post('nama_kelas',TRUE),
              'id_jurusan' => $this->input->post('id_jurusan',TRUE),
          );

            $this->Kelas_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('kelas'));
        }
    }

    public function update($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelas/update_action'),
                'id_kelas' => set_value('id_kelas', $row->id_kelas),
                'nama_kelas' => set_value('nama_kelas', $row->nama_kelas),
                'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
            );

            $data['judul'] = 'Ubah Kelas';
            $data['jurusan'] = $this->jurusan_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('kelas/kelas_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('kelas'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelas', TRUE));
        } else {
            $data = array(
              'nama_kelas' => $this->input->post('nama_kelas',TRUE),
              'id_jurusan' => $this->input->post('id_jurusan',TRUE),
          );

            $this->Kelas_model->update($this->input->post('id_kelas', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('kelas'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Kelas_model->get_by_id($id);

        if ($row) {
            $this->Kelas_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('kelas'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('kelas'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('nama_kelas', 'nama kelas', 'trim|required');
       $this->form_validation->set_rules('id_jurusan', 'nama jurusan', 'trim|required');

       $this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "kelas.xls";
    $judul = "kelas";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Jurusan");

    foreach ($this->Kelas_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_kelas);
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
    header("Content-Disposition: attachment;Filename=kelas.doc");

    $data = array(
        'kelas_data' => $this->Kelas_model->get_all(),
        'start' => 0
    );

    $this->load->view('kelas/kelas_doc',$data);
}

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 17:16:49 */
                        /* http://harviacode.com */