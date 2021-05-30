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
        $this->load->model('metode_pembayaran/metode_pembayaran_model');
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

    public function siswa()
    {
        $data['judul'] = 'Riwayat Transaksi';

        $this->load->view('template_siswa/header', $data);
        $this->load->view('transaksi/transaksi_siswa', $data);
        $this->load->view('template_siswa/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json();
    }

    public function json_siswa() {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->json_siswa();
    }

    public function lastjson() {
        header('Content-Type: application/json');
        echo $this->Transaksi_model->lastjson();
    }

    public function faktur($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);
        
        if ($row) {

            $data['data'] = $row;
            $data['judul'] = 'Faktur ' . $row->no_faktur;
            $data['telah_dibayar'] = $this->Transaksi_model->get_telah_dibayar($row->nis, $row->id_pembayaran);

            $this->load->view('transaksi/transaksi_faktur', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('transaksi'));
        }
    }

    public function invoice($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);
        
        if ($row) {

            $this->load->library('pdf');
            $data['data'] = $row;
            $data['judul'] = 'Faktur ' . $row->no_faktur;
            $data['telah_dibayar'] = $this->Transaksi_model->get_telah_dibayar($row->nis, $row->id_pembayaran);

            $this->pdf->setPaper('A4', 'landscape');
            $this->pdf->name("FAKTUR {$row->no_faktur}.pdf");
            $this->pdf->view('transaksi/transaksi_invoice', $data);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('transaksi'));
        }
    }

    public function read($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_transaksi' => $row->id_transaksi,
              'nama_kategori' => $row->nama_kategori,
              'nama_siswa' => $row->nama_siswa,
              'nis' => $row->nis,
              'tgl' => $row->tgl,
              'tahun_dibayar' => $row->tahun_dibayar,
              'jumlah_dibayar' => $row->jumlah_dibayar,
              'status' => $row->status,
              'bukti_pembayaran' => $row->bukti_pembayaran,
              'keterangan' => $row->keterangan
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

    public function read_siswa($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
              'id_transaksi' => $row->id_transaksi,
              'nama_kategori' => $row->nama_kategori,
              'nama_siswa' => $row->nama_siswa,
              'nis' => $row->nis,
              'tgl' => $row->tgl,
              'tahun_dibayar' => $row->tahun_dibayar,
              'jumlah_dibayar' => $row->jumlah_dibayar,
              'status' => $row->status,
              'bukti_pembayaran' => $row->bukti_pembayaran,
              'keterangan' => $row->keterangan
          );

            $data['judul'] = 'Detail Transaksi';

            $this->load->view('template_siswa/header', $data);
            $this->load->view('transaksi/transaksi_read', $data);
            $this->load->view('template_siswa/footer', $data);
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

    public function create_siswa() 
    {
        $data['judul'] = 'Transaksi Baru';
        $data['kategori'] = $this->pembayaran_model->get_kategori_pembayaran($this->session->userdata('nis'));

        $this->load->view('template_siswa/header', $data);
        $this->load->view('transaksi/transaksi_new_siswa', $data);
        $this->load->view('template_siswa/footer', $data);
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

    public function pilih_metode_pembayaran($nis, $id_pembayaran) 
    {
        $data['judul'] = 'Pembayaran';
        $data['pembayaran'] = $this->pembayaran_model->get_by_id($id_pembayaran);
        $data['metode_pembayaran'] = $this->metode_pembayaran_model->get_all();

        $this->load->view('template_siswa/header', $data);
        $this->load->view('transaksi/transaksi_pilih_metode_pembayaran', $data);
        $this->load->view('template_siswa/footer', $data);
    }

    public function get_telah_dibayar($nis, $id_pembayaran)
    {
        echo $this->Transaksi_model->get_telah_dibayar($nis, $id_pembayaran);
    }


    public function bayar_siswa($nis, $id_pembayaran) 
    {
        $data['judul'] = 'Pembayaran';
        $data['pembayaran'] = $this->pembayaran_model->get_by_id($id_pembayaran);
        $data['siswa'] = $this->siswa_model->get_by_nis($nis);
        $data['telah_dibayar'] = $this->Transaksi_model->get_telah_dibayar($nis, $id_pembayaran);

        $this->load->view('template_siswa/header', $data);
        $this->load->view('transaksi/transaksi_bayar_siswa', $data);
        $this->load->view('template_siswa/footer', $data);
    }

    public function tambah_rek() 
    {
        $data['judul'] = 'Informasi Pengirim';
        $data['rek'] = $this->db->get_where('siswa', ['id_siswa' => $this->session->userdata('id_siswa')])->row_array();

        $this->load->view('template_siswa/header', $data);
        $this->load->view('transaksi/transaksi_tambah_rek', $data);
        $this->load->view('template_siswa/footer', $data);
    }

    public function tambah_rek_aksi()
    {
        $post = $this->input->post();

        $data = [
            'atas_nama' => $post['atas_nama'],
            'no_rekening' => $post['no_rekening'],
            'bank' => $post['bank']
        ];

        $this->db->where('id_siswa', $this->session->userdata('id_siswa'));
        $this->db->update('siswa', $data);

        $this->session->set_flashdata('success', 'Diubah');
        redirect(site_url('transaksi/tambah_rek'));
    }

    public function create_action($siswa = false) 
    {
        $data = array(
            'id_pembayaran' => $this->input->post('id_pembayaran',TRUE),
            'nis' => $this->input->post('nis',TRUE),
            'no_faktur' => $this->input->post('no_faktur',TRUE),
            'jumlah_dibayar' => $this->input->post('jumlah_dibayar',TRUE),
            'tahun_dibayar' => date('Y')
        );

        if ($siswa == false) {
            $data['status'] = 'diterima';
        }else{
            $data['status'] = 'pending';
        }

        if ($_FILES['bukti']['name']) {
            $data['bukti_pembayaran'] = _upload('bukti', 'transaksi/bayar/' . $this->input->post('nis') . '/' . $this->input->post('id_pembayaran'), 'transaksi');
        }

        $this->Transaksi_model->insert($data);
        $this->session->set_flashdata('success', 'Ditambah');

        if ($siswa == false) {
            $id = $this->db->insert_id();
            redirect(site_url('transaksi/faktur/' . $id));
        }else{
            redirect(site_url('transaksi/siswa'));
        }

    }

    public function update($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {

            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
                'id_transaksi' => set_value('id_transaksi', $row->id_transaksi),
                'id_pembayaran' => set_value('id_pembayaran', $row->id_pembayaran),
                'nis' => set_value('nis', $row->nis),
                'tgl' => set_value('tgl', $row->tgl),
                'tahun_dibayar' => set_value('tahun_dibayar', $row->tahun_dibayar),
                'jumlah_dibayar' => set_value('jumlah_dibayar', $row->jumlah_dibayar),
                'status' => set_value('status', $row->status),
                'bukti_pembayaran' => set_value('bukti_pembayaran', $row->bukti_pembayaran),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'atas_nama' => set_value('atas_nama', $row->atas_nama),
                'no_rekening' => set_value('no_rekening', $row->no_rekening),
                'bank' => set_value('bank', $row->bank),
            );

            $data['judul'] = 'Ubah Transaksi';
            $data['siswa'] = $this->siswa_model->get_all();
            $data['kategori'] = $this->pembayaran_model->get_kategori_pembayaran($row->nis);

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
                'id_pembayaran' => $this->input->post('id_pembayaran',TRUE),
                'nis' => $this->input->post('nis',TRUE),
                'tgl' => $this->input->post('tgl',TRUE),
                'tahun_dibayar' => $this->input->post('tahun_dibayar',TRUE),
                'jumlah_dibayar' => $this->input->post('jumlah_dibayar',TRUE),
                'status' => $this->input->post('status',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE)
            );

            if ($_FILES['bukti']['name']) {
                delImage('transaksi', $this->input->post('id_transaksi'), 'bukti_pembayaran');
                $data['bukti_pembayaran'] = _upload('bukti', 'transaksi/update/' . $this->input->post('id_transaksi'), 'transaksi');
            }

            $this->Transaksi_model->update($this->input->post('id_transaksi', TRUE), $data);
            $this->session->set_flashdata('success', 'Diubah');
            redirect(site_url('transaksi'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            delImage('transaksi', $id, 'bukti_pembayaran');
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
        $this->form_validation->set_rules('id_pembayaran', 'id pembayaran', 'trim|required|numeric');
        $this->form_validation->set_rules('nis', 'nis', 'trim|required|numeric');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
        $this->form_validation->set_rules('tahun_dibayar', 'tahun dibayar', 'trim|required|numeric');
        $this->form_validation->set_rules('jumlah_dibayar', 'jumlah dibayar', 'trim|required|numeric');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

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
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
        xlsWriteLabel($tablehead, $kolomhead++, "Nis");
        xlsWriteLabel($tablehead, $kolomhead++, "Siswa");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
        xlsWriteLabel($tablehead, $kolomhead++, "Tahun Dibayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Dibayar");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->Transaksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_kategori);
            xlsWriteNumber($tablebody, $kolombody++, $data->nis);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_siswa);
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