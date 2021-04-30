<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function reset()
	{
		$this->db->query("DELETE FROM tahun_ajaran");
		$this->db->query("DELETE FROM kelas");
		$this->db->query("DELETE FROM jurusan");
		$this->db->query("DELETE FROM siswa");

		echo "berhasil";
		
	}

}
