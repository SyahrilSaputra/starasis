<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_Aplikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('hak_akses') != "admin") {
			redirect(base_url());
		} else {
			$this->load->Model('Crud');
		}
	}

	public function index()
	{
		$d['judul'] = "Data Daftar Aplikasi Sistem Sekolah";
		// $d['pengumuman'] = $this->Daftar_Aplikasi_Model->pengumuman();

		$d['daftar_aplikasi'] = $this->Crud->gao('mst_daftar_aplikasi', 'urutan_app');
		$this->load->view('top', $d);
		$this->load->view('menu');
		$this->load->view('daftar_aplikasi/daftar_aplikasi');
		$this->load->view('bottom');
	}

	public function daftar_aplikasi_tambah()
	{
		$d['judul'] = "Tambah Aplikasi Sistem Sekolah";
		$d['tipe'] = 'add';
		$d['judul_pengumuman'] = "";
		$d['isi'] = "";
		$d['gambar'] = "";
		$d['id_pengumuman'] = "";
		$this->load->view('top', $d);
		$this->load->view('menu');
		$this->load->view('daftar_aplikasi/daftar_aplikasi_tambah');
		$this->load->view('bottom');
	}

	public function daftar_aplikasi_edit($id)
	{	
		$where = array('urutan_app' => $id);
		$d['judul'] = "Ubah Aplikasi Sistem Sekolah";
		$d['tipe'] = 'add';
		$d['judul_pengumuman'] = "";
		$d['isi'] = "";
		$d['gambar'] = "";
		$d['id_pengumuman'] = "";
		$d['data_aplikasi'] = $this->Crud->gw('mst_daftar_aplikasi', $where);
		$this->load->view('top', $d);
		$this->load->view('menu');
		$this->load->view('daftar_aplikasi/daftar_aplikasi_edit');
		$this->load->view('bottom');
	}

	public function save()
	{
		$input = $this->input->post(NULL, FALSE);

		$data = array(
			'urutan_app'		=> $input['urutan'],
			'nama_app'			=> $input['nama'],
			'deskripsi_app'		=> $input['deskripsi'],
			'icon_app'			=> $input['icon'],
			'warna_app'			=> $input['warna'],
			'jenis_link_app'	=> $input['jenis_link'],
			'link_app'			=> $input['link'],
		);

		$this->db->insert("mst_daftar_aplikasi",$data);
		$this->session->set_flashdata("success","Tambah Menu Aplikasi Berhasil");	
		redirect("Daftar_Aplikasi");
	}

	public function edit()
	{
		$input = $this->input->post(NULL, FALSE);
		$where  = array('urutan_app' => $input['urutan_lama'],);
		$data = array(
			'urutan_app'		=> $input['urutan'],
			'nama_app'			=> $input['nama'],
			'deskripsi_app'		=> $input['deskripsi'],
			'icon_app'			=> $input['icon'],
			'warna_app'			=> $input['warna'],
			'jenis_link_app'	=> $input['jenis_link'],
			'link_app'			=> $input['link'],
		);

		$this->Crud->u('mst_daftar_aplikasi', $data, $where);
		$this->session->set_flashdata("success","Ubah Menu Aplikasi Berhasil");	
		redirect("Daftar_Aplikasi");
	}

	public function delete($id)
	{
		$where = array('urutan_app' => $id,);
        $this->Crud->d('mst_daftar_aplikasi', $where);
        $this->session->set_flashdata("success", "Hapus Menu Aplikasi Berhasil");
		redirect("Daftar_Aplikasi");
	}

}

/* End of file Daftar_Aplikasi */
/* Location: ./application/controllers/Daftar_Aplikasi */