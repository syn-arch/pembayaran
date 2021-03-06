<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('kelas/kelas_model');
        $this->load->model('jurusan/jurusan_model');
        $this->load->model('tahun_ajaran/tahun_ajaran_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

    public function siswajson()
    {
        $key =  $this->input->get('search');
        header('Content-Type: application/json');

        $this->db->like('nama_siswa', $key, 'BOTH');
        $this->db->limit(10);
        $siswa = $this->db->get('siswa')->result_array();

        $list = array();
        foreach ($siswa as $index => $row) {
            $list[$index]['id'] = $row['nis'];
            $list[$index]['text'] = $row['nama_siswa']; 
        }

        echo json_encode($list);
    }

    public function index()
    {
        $data['judul'] = 'Data Siswa';

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/siswa_list', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Siswa_model->json();
    }

    public function get_siswa($id = '')
    {
        $row = $this->Siswa_model->get_by_id($id);
        if ($row) {
            echo json_encode($row);
        }else{
            echo "error";
        }
    }

    public function read($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
              'barcode' => $row->barcode,
              'id_siswa' => $row->id_siswa,
              'nama_jurusan' => $row->nama_jurusan,
              'nama_kelas' => $row->nama_kelas,
              'nis' => $row->nis,
              'nama_siswa' => $row->nama_siswa,
              'tgl_lahir' => $row->tgl_lahir,
              'jk' => $row->jk,
              'tahun_ajaran' => $row->tahun_ajaran,
              'email' => $row->email,
              'aktif' => $row->aktif
          );

            $data['judul'] = 'Detail Siswa';

            $this->load->view('templates/header', $data);
            $this->load->view('siswa/siswa_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('siswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('siswa/create_action'),
            'id_siswa' => set_value('id_siswa'),
            'barcode' => set_value('barcode'),
            'id_jurusan' => set_value('id_jurusan'),
            'id_kelas' => set_value('id_kelas'),
            'nis' => set_value('nis'),
            'nama_siswa' => set_value('nama_siswa'),
            'tgl_lahir' => set_value('tgl_lahir'),
            'jk' => set_value('jk'),
            'id_tahun_ajaran' => set_value('id_tahun_ajaran'),
            'email' => set_value('email'),
            'aktif' => set_value('aktif'),
        );

        $data['judul'] = 'Tambah Siswa';
        $data['kelas'] = $this->kelas_model->get_all();
        $data['jurusan'] = $this->jurusan_model->get_all();
        $data['tahun_ajaran'] = $this->tahun_ajaran_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/siswa_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'barcode' => $this->input->post('barcode',TRUE),
              'id_jurusan' => $this->input->post('id_jurusan',TRUE),
              'id_kelas' => $this->input->post('id_kelas',TRUE),
              'nis' => $this->input->post('nis',TRUE),
              'nama_siswa' => $this->input->post('nama_siswa',TRUE),
              'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
              'jk' => $this->input->post('jk',TRUE),
              'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran',TRUE),
              'email' => $this->input->post('email',TRUE),
              'password' => password_hash($this->input->post('password',TRUE), PASSWORD_DEFAULT),
              'aktif' => $this->input->post('aktif',TRUE)
          );

            $this->Siswa_model->insert($data);
            $this->session->set_flashdata('success', 'Ditambah');
            redirect(site_url('siswa'));
        }
    }

    public function update($id) 
    {
        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siswa/update_action'),
                'id_siswa' => set_value('id_siswa', $row->id_siswa),
                'barcode' => set_value('barcode', $row->barcode),
                'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
                'id_kelas' => set_value('id_kelas', $row->id_kelas),
                'nis' => set_value('nis', $row->nis),
                'nama_siswa' => set_value('nama_siswa', $row->nama_siswa),
                'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
                'jk' => set_value('jk', $row->jk),
                'id_tahun_ajaran' => set_value('id_tahun_ajaran', $row->id_tahun_ajaran),
                'email' => set_value('email', $row->email),
                'aktif' => set_value('aktif', $row->aktif),
            );

            $data['judul'] = 'Ubah Siswa';
            $data['kelas'] = $this->kelas_model->get_all();
            $data['jurusan'] = $this->jurusan_model->get_all();
            $data['tahun_ajaran'] = $this->tahun_ajaran_model->get_all();

            $this->load->view('templates/header', $data);
            $this->load->view('siswa/siswa_form', $data);
            $this->load->view('templates/footer', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('siswa'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_siswa', TRUE));
        } else {

            $data = array(
                'barcode' => $this->input->post('barcode',TRUE),
                'id_jurusan' => $this->input->post('id_jurusan',TRUE),
                'id_kelas' => $this->input->post('id_kelas',TRUE),
                'nis' => $this->input->post('nis',TRUE),
                'nama_siswa' => $this->input->post('nama_siswa',TRUE),
                'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
                'jk' => $this->input->post('jk',TRUE),
                'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran',TRUE),
                'email' => $this->input->post('email',TRUE),
                'aktif' => $this->input->post('aktif',TRUE),
            );

            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->Siswa_model->update($this->input->post('id_siswa', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('siswa'));
        }
    }

    public function delete($id) 
    {
        $nis = $this->db->get_where('siswa', ['id_siswa'])->row()->nis;

        if ($this->db->get_where('transaksi', ['nis' => $nis])->row_array()) {
            $this->session->set_flashdata('error', 'Masih terdapat data turunan yang berhubungan');
            redirect(site_url('siswa'));
        }

        $row = $this->Siswa_model->get_by_id($id);

        if ($row) {
            $this->Siswa_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('siswa'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('siswa'));
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('id_jurusan', 'id jurusan', 'trim|required|numeric');
        $this->form_validation->set_rules('id_kelas', 'id kelas', 'trim|required|numeric');
        $this->form_validation->set_rules('nis', 'nis', 'trim|required|numeric');
        $this->form_validation->set_rules('nama_siswa', 'nama siswa', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');
        $this->form_validation->set_rules('jk', 'jk', 'trim|required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'tahun ajaran', 'trim|required|numeric');

        $this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "siswa.xls";
        $judul = "siswa";
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
        xlsWriteLabel($tablehead, $kolomhead++, "barcode");
        xlsWriteLabel($tablehead, $kolomhead++, "Jurusan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kelas");
        xlsWriteLabel($tablehead, $kolomhead++, "Nis");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Siswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
        xlsWriteLabel($tablehead, $kolomhead++, "Jk");
        xlsWriteLabel($tablehead, $kolomhead++, "Tahun Ajaran");

        foreach ($this->Siswa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->barcode);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_jurusan);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_kelas);
            xlsWriteNumber($tablebody, $kolombody++, $data->nis);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_siswa);
            xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
            xlsWriteLabel($tablebody, $kolombody++, $data->jk);
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
        header("Content-Disposition: attachment;Filename=siswa.doc");

        $data = array(
            'siswa_data' => $this->Siswa_model->get_all(),
            'start' => 0
        );

        $this->load->view('siswa/siswa_doc',$data);
    }

    public function template()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Jurusan')
        ->setCellValue('B1', 'Kelas')
        ->setCellValue('C1', 'NIS')
        ->setCellValue('D1', 'Nama Siswa')
        ->setCellValue('E1', 'Tanggal Lahir (YYYY-MM-DD)')
        ->setCellValue('F1', 'Jk (L/P)')
        ->setCellValue('G1', 'Tahun Ajaran')
        ->setCellValue('H1', 'Barcode')
        ;                      

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Template Siswa.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function import()
    {
        $file = explode('.', $_FILES['excel']['name']);
        $extension = end($file);

        if($extension == 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $this->db->trans_start();

        for($i = 1;$i < count($sheetData); $i++)
        {
            $nama_jurusan = $sheetData[$i]['0'];
            $nama_kelas = $sheetData[$i]['1'];
            $nama_tahun_ajaran = $sheetData[$i]['6'];

            $jurusan = $this->db->get_where('jurusan', ['nama_jurusan' => $nama_jurusan])->row_array();
            if ($jurusan) {
                $id_jurusan = $jurusan['id_jurusan'];
            }else{
                $this->db->insert('jurusan', [
                    'nama_jurusan' => $nama_jurusan
                ]);
                $id_jurusan = $this->db->insert_id();
            }

            $kelas = $this->db->get_where('kelas', ['nama_kelas' => $nama_kelas])->row_array();
            if ($kelas) {
                $id_kelas = $kelas['id_kelas'];
            }else{
                $this->db->insert('kelas', [
                 'nama_kelas' => $nama_kelas,
                 'id_jurusan' => $id_jurusan
             ]);
                $id_kelas = $this->db->insert_id();
            }

            $tahun_ajaran = $this->db->get_where('tahun_ajaran', ['tahun_ajaran' => $nama_tahun_ajaran])->row_array();

            if ($tahun_ajaran) {
                $id_tahun_ajaran = $tahun_ajaran['id_tahun_ajaran'];
            }else{
                $this->db->insert('tahun_ajaran', [
                 'tahun_ajaran' => $nama_tahun_ajaran,
             ]);
                $id_tahun_ajaran = $this->db->insert_id();
            }

            if ($sheetData[$i]['0'] != '') {
                $data = [
                    'id_jurusan' => $id_jurusan,
                    'id_kelas' => $id_kelas,
                    'nis' => $sheetData[$i]['2'],
                    'nama_siswa' => $sheetData[$i]['3'],
                    'tgl_lahir' => str_replace('/', '-', $sheetData[$i]['4']),
                    'jk' => $sheetData[$i]['5'],
                    'id_tahun_ajaran' => $id_tahun_ajaran,
                    'barcode' => $sheetData[$i]['7'],
                    'password' => password_hash($sheetData[$i]['2'], PASSWORD_DEFAULT)
                ];

                $this->db->insert('siswa', $data);
            }
        }

        $this->db->trans_complete();

        $this->session->set_flashdata('success', 'Di import');
        redirect('siswa','refresh');
    }

}

/* End of file Siswa.php */
/* Location: ./application/controllers/Siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-03 18:01:09 */
                        /* http://harviacode.com */