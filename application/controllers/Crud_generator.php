<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require './vendor/autoload.php';


class Crud_generator extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$data['judul'] = "CRUD Generator";

		$this->load->view('templates/header', $data, FALSE);
		$this->load->view('crud_generator', $data, FALSE);
		$this->load->view('templates/footer', $data, FALSE);
    }


}

/* End of file Crud_generator.php */
/* Location: ./application/modules/Crud_generator/controllers/Crud_generator.php */ ?>
