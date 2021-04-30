<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 function __construct()
    {
        parent::__construct();
        $this->load->model('siswa/siswa_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
    }

	public function index()
	{
		cek_login();
		
		$data['judul'] = "Dashboard";

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('dashboard', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
	}

	public function siswa()
	{	
		$data['judul'] = "Dashboard";
		$data['siswa'] = $this->siswa_model->get_by_id($this->session->userdata('id_siswa'));

		$this->load->view('template_siswa/header', $data, FALSE);
		$this->load->view('dashboard_siswa', $data, FALSE);
		$this->load->view('template_siswa/footer', $data, FALSE);
	}

}
