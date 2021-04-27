<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model');
        $this->load->model('kategori/kategori_model');
        $this->load->model('jurusan/jurusan_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function get_by_id($id = '')
    {
        $this->db->join('kategori', 'id_kategori');
        echo json_encode($this->db->get_where('pembayaran', ['id_pembayaran' => $id])->row_array());
    }

    public function get_kategori_siswa_json($barcode)
    {
        $siswa = $this->db->get_where('siswa',['barcode' => $barcode])->row_array();

        $this->db->where('id_jurusan', $siswa['id_jurusan']);
        $this->db->where('tahun_angkatan', $siswa['tahun_ajaran']);
        $this->db->join('kategori', 'id_kategori');
        echo json_encode($this->db->get('pembayaran')->result_array());
    }

    public function index()
    {
        $data['judul'] = 'Data Pembayaran';

        $this->load->view('templates/header', $data);
        $this->load->view('pembayaran/pembayaran_list', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Pembayaran_model->json();
    }

    public function read($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_pembayaran' => $row->id_pembayaran,
              'nama_kategori' => $row->nama_kategori,
              'nama_jurusan' => $row->nama_jurusan,
              'tahun_angkatan' => $row->tahun_angkatan,
              'nominal' => $row->nominal,
              'keterangan' => $row->keterangan,
          );

            $data['judul'] = 'Detail Pembayaran';

            $this->load->view('templates/header', $data);
            $this->load->view('pembayaran/pembayaran_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('pembayaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pembayaran/create_action'),
            'id_pembayaran' => set_value('id_pembayaran'),
            'id_kategori' => set_value('id_kategori'),
            'id_jurusan' => set_value('id_jurusan'),
            'tahun_angkatan' => set_value('tahun_angkatan'),
            'nominal' => set_value('nominal'),
            'keterangan' => set_value('keterangan'),
        );

        $data['judul'] = 'Tambah Pembayaran';
        $data['kategori'] = $this->kategori_model->get_all();
        $data['jurusan'] = $this->jurusan_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('pembayaran/pembayaran_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'id_kategori' => $this->input->post('id_kategori',TRUE),
              'id_jurusan' => $this->input->post('id_jurusan',TRUE),
              'tahun_angkatan' => $this->input->post('tahun_angkatan',TRUE),
              'nominal' => $this->input->post('nominal',TRUE),
              'keterangan' => $this->input->post('keterangan',TRUE),
          );

            $this->Pembayaran_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('pembayaran'));
        }
    }

    public function update($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pembayaran/update_action'),
                'id_pembayaran' => set_value('id_pembayaran', $row->id_pembayaran),
                'id_kategori' => set_value('id_kategori', $row->id_kategori),
                'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
                'tahun_angkatan' => set_value('tahun_angkatan', $row->tahun_angkatan),
                'nominal' => set_value('nominal', $row->nominal),
                'keterangan' => set_value('keterangan', $row->keterangan),
            );

            $data['judul'] = 'Ubah Pembayaran';
            $data['kategori'] = $this->kategori_model->get_all();
            $data['jurusan'] = $this->jurusan_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('pembayaran/pembayaran_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('pembayaran'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pembayaran', TRUE));
        } else {
            $data = array(
              'id_kategori' => $this->input->post('id_kategori',TRUE),
              'id_jurusan' => $this->input->post('id_jurusan',TRUE),
              'tahun_angkatan' => $this->input->post('tahun_angkatan',TRUE),
              'nominal' => $this->input->post('nominal',TRUE),
              'keterangan' => $this->input->post('keterangan',TRUE),
          );

            $this->Pembayaran_model->update($this->input->post('id_pembayaran', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('pembayaran'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Pembayaran_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('pembayaran'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('pembayaran'));
        }
    }

    public function _rules() 
    {
       $this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required|numeric');
       $this->form_validation->set_rules('id_jurusan', 'id jurusan', 'trim|required|numeric');
       $this->form_validation->set_rules('tahun_angkatan', 'tahun angkatan', 'trim|required|numeric');
       $this->form_validation->set_rules('nominal', 'nominal', 'trim|required|numeric');

       $this->form_validation->set_rules('id_pembayaran', 'id_pembayaran', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "pembayaran.xls";
    $judul = "pembayaran";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
    xlsWriteLabel($tablehead, $kolomhead++, "Jurusan");
    xlsWriteLabel($tablehead, $kolomhead++, "Tahun Angkatan");
    xlsWriteLabel($tablehead, $kolomhead++, "Nominal");
    xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

    foreach ($this->Pembayaran_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_kategori);
        xlsWriteLabel($tablebody, $kolombody++, $data->nama_jurusan);
        xlsWriteNumber($tablebody, $kolombody++, $data->tahun_angkatan);
        xlsWriteNumber($tablebody, $kolombody++, $data->nominal);
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
    header("Content-Disposition: attachment;Filename=pembayaran.doc");

    $data = array(
        'pembayaran_data' => $this->Pembayaran_model->get_all(),
        'start' => 0
    );

    $this->load->view('pembayaran/pembayaran_doc',$data);
}

}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 17:21:20 */
                        /* http://harviacode.com */