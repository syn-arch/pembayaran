<?php

function cek_login()
{
	$ci = get_instance();
	if (!$ci->session->userdata('login')) {
		show_404();
	} else {

		$id_role = $ci->session->userdata('id_role');
		$menu = $ci->db->get_where('menu', ['url' => $ci->uri->segment(1) ])->row_array();
		$submenu = $ci->db->get_where('menu', ['url' => $ci->uri->segment(1) . '/' . $ci->uri->segment(2) ])->row_array();

		if ($menu) {

			$userAccessMenu = $ci->db->get_where('akses_role', [
				'id_role' => $id_role,
				'id_menu' => $menu['id_menu']
			])->row_array();

			if ($userAccessMenu){

				if ($submenu) {
					$userAccessSubmenu = $ci->db->get_where('akses_role', [
						'id_role' => $id_role,
						'id_menu' => $submenu['id_menu']
					])->row_array();

					if (!$userAccessSubmenu) die('401 Unauthorized');	
				}

			} else{
				die('401 Unauthorized');
			}
		}
	}
}


function check_menu($id_menu, $id_role)
{
	$ci =& get_instance();

	$ci->db->where('id_menu', $id_menu);
	$ci->db->where('id_role', $id_role);
	$result = $ci->db->get('akses_role')->row_array();

	if ($result) return "checked='checked'";
}

function _upload($name, $url, $path)
{
	$ci =& get_instance();
	$config['upload_path'] = './assets/img/' . $path . '/';
	$config['allowed_types'] = 'pdf|jpg|png|jpeg';
	$config['max_size']  = '4048';

	$ci->load->library('upload', $config);

	if ( ! $ci->upload->do_upload($name)){
		$ci->session->set_flashdata('error', $ci->upload->display_errors());
		redirect($url,'refresh');
	}
	return $ci->upload->data('file_name');
}

function delImage($table, $id, $column = 'gambar')
{
	$ci =& get_instance();
	$gambar_lama = $ci->db->get_where($table, ['id_'.$table => $id])->row_array()[$column];
	$path = 'assets/img/' . $table . '/' . $gambar_lama;

	if (file_exists(FCPATH . $path)) {
		unlink(FCPATH . $path);
	}
}

function autoID($str, $table)
{
	// PLG00001
	$ci =& get_instance();
	$kode = $ci->db->query("SELECT MAX(id_" . $table . ") as kode from $table")->row()->kode;
	$kode_baru = substr($kode, 3, 5) + 1;
	return $str . sprintf("%05s", $kode_baru);
}

function acak($length)
{
	$random= "";
	srand((double)microtime()*1000000);
	$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
	$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
	$data .= "0FGH45OP89";
	for($i = 0; $i < $length; $i++)
	{
		$random .= substr($data, (rand()%(strlen($data))), 1);
	}
	return strtoupper($random);
}

function rrmdir($dir) { 
	if (is_dir($dir)) { 
		$objects = scandir($dir);
		foreach ($objects as $object) { 
			if ($object != "." && $object != "..") { 
				if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
					rrmdir($dir. DIRECTORY_SEPARATOR .$object);
				else
					unlink($dir. DIRECTORY_SEPARATOR .$object); 
			} 
		}
		rmdir($dir); 
	} 
}

function faktur()
{
	$ci =& get_instance();
	//TJ-DDMMYY000X
	$ci->db->where('DATE(tgl)', date('Y-m-d'));
	$ci->db->order_by('no_faktur', 'DESC');
	$latest = $ci->db->get('transaksi')->row();

	if (!$latest) {
		$id = 'FK-' . date('dmy') . sprintf('%04s', 1);
	}else{
		$number = substr($latest->no_faktur, 9,4) + 1;
		$id = 'FK-' . date('dmy') . sprintf('%04s', $number);
	}

	return $id;
}

function penyebut($nilai) {
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " ". $huruf[$nilai];
	} else if ($nilai <20) {
		$temp = penyebut($nilai - 10). " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
	}     
	return $temp;
}

function terbilang($nilai) {
	if($nilai<0) {
		$hasil = "minus ". trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}     		
	return $hasil;
}
