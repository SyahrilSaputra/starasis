<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct(){
		parent::__construct();
		if ($this->session->userdata('tipe') != "root") {
			redirect("../" . $this->session->userdata('tipe'));
		} else {
			$this->load->Model('User_model');
			$this->load->Model('Combo_model');
		}
	}


	public function index() {
		redirect(base_url());
	}


	public function admin() {
		$d['judul'] = "Data User";
		$d['admin'] = $this->User_model->admin();
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/admin');
		$this->load->view('bottom');	
	}



	public function admin_tambah() {
		$d['judul'] = "Data User";
		$d['judul2'] = "Tambah";
		$d['tipe'] = 'add';
		$d['combo_jabatan'] = $this->Combo_model->combo_jabatan();
		$d['nama'] = "";
		$d['username'] = "";
		$d['password'] = "";
		$d['id_user'] = "";
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/admin_tambah');
		$this->load->view('bottom');
		
	}


	public function admin_edit($id_user) {
		$cek = $this->db->query("SELECT id_user FROM mst_user WHERE id_user = '$id_user'");
		if($cek->num_rows() > 0) { 
			$d['judul'] = "Data Admin";
			$d['judul2'] = "Ubah";
			$d['tipe'] = 'edit';
			$get = $this->User_model->admin_edit($id_user);
			$data = $get->row();
			$d['nama'] = $data->nama;
			$d['username'] = $data->username;
			$d['password'] = $data->password;
			$d['combo_jabatan'] = $this->Combo_model->combo_jabatan($data->id_jabatan);
			$d['id_user'] = $data->id_user;
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('admin/admin_tambah');
			$this->load->view('bottom');
		} else {
			$this->load->view('top');
			$this->load->view('menu');
			$this->load->view('404');
			$this->load->view('bottom');
		}	
	}

	public function admin_save() {
			$tipe = $this->input->post("tipe");	
			$in['nama'] = $this->input->post("nama");
			$in['username'] = $this->input->post("username");
			$in['password'] = $this->input->post("password");
			$in['id_jabatan'] = $this->input->post("id_jabatan");

			$config2['upload_path'] = './../upload/foto';
		$config2['allowed_types']= 'jpg|png';
		$config2['encrypt_name']	= TRUE;
		$config2['remove_spaces']	= TRUE;	
		$config2['max_size']     = '0';
		$config2['max_width']  	= '0';
		$config2['max_height']  	= '0';
		
		$this->load->library('upload', $config2);
			
			if($tipe == "add") {
				$cek = $this->db->query("SELECT username FROM mst_user WHERE username = '$in[username]'");
				if($cek->num_rows() > 0) { 
					$this->session->set_flashdata("error","Gagal Input. Username Sudah Digunakan");
					redirect("user/admin_tambah/");
				}  else { 	
					if(!empty($_FILES['foto']['name'])) {
						if($this->upload->do_upload("foto")) {
							$data	 	= $this->upload->data();
							$in['foto'] = $data['file_name'];	
							$this->db->insert("mst_user",$in);
					$this->session->set_flashdata("success","Tambah Data Admin Berhasil");
					redirect("user/admin/");
						} else {
							$this->session->set_flashdata("error",$this->upload->display_errors());
							redirect("user/admin_tambah/");	
						}
					} else {
						$this->db->insert("mst_user",$in);
						$this->session->set_flashdata("success","Tambah Data Admin Berhasil");
						redirect("user/admin/");
					}	
				}
			} elseif($tipe = 'edit') {
				$where['id_user'] 	= $this->input->post('id_user');
				$cek = $this->db->query("SELECT username FROM mst_user WHERE username = '$in[username]' AND id_user != '$where[id_user]'");
				if($cek->num_rows() > 0) { 
					$this->session->set_flashdata("error","Gagal Input. Username Sudah Digunakan");
					redirect("user/admin_edit/".$this->input->post("id_user"));
				} else { 	
					$this->db->update("mst_user",$in,$where);
					$this->session->set_flashdata("success","Ubah Data Admin Berhasil");
					redirect("user/admin/");
				}
				
			} else {
				redirect(base_url());
			}
	}

	public function admin_hapus($id) {
		$where['id_user'] = $id;
		$this->db->delete("mst_user",$where);
		$this->session->set_flashdata("success","Hapus Data Admin Berhasil");
		redirect("user/admin");
	}

	public function staff()
	{
		$d['judul'] = "Data Staff";
		$d['data_staff'] = $this->Crud->ga('mst_staff');
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/staff');
		$this->load->view('bottom');	
	}

	public function staff_ubah_password($id_staff)
	{
		$where = array('id_staff' => $id_staff,);
		$d['judul'] = "Ubah Password Staff";
		$d['judul2'] = "Ubah";
		$d['tipe'] = 'add';
		$d['data_password'] = $this->Crud->gw('mst_staff', $where);
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/staff_password');
		$this->load->view('bottom');
	}

	public function staff_edit_password($id_staff)
	{
		$where = array('id_staff' => $id_staff);
		$in = $this->input->post(NULL, FALSE);
		$data = array(
			'password'	=> $in['password'],
		);

		$this->Crud->u('mst_staff', $data, $where);
		$this->session->set_flashdata("success","Ubah Password Staff berhasil");
		redirect('User/staff');
	}

	public function kepsek()
	{
		$d['judul'] = "Data Kepala Sekolah";
		$d['data_kepsek'] = $this->Crud->ga('mst_kepala_sekolah');
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/kepsek');
		$this->load->view('bottom');	
	}

	public function kepsek_ubah_password($id_kepala_sekolah)
	{
		$where = array('id_kepala_sekolah' => $id_kepala_sekolah,);
		$d['judul'] = "Ubah Password Kepala Sekolah";
		$d['judul2'] = "Ubah";
		$d['tipe'] = 'add';
		$d['data_password'] = $this->Crud->gw('mst_kepala_sekolah', $where);
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/kepsek_password');
		$this->load->view('bottom');
	}

	public function kepsek_edit_password($id_kepala_sekolah)
	{
		$where = array('id_kepala_sekolah' => $id_kepala_sekolah);
		$in = $this->input->post(NULL, FALSE);
		$data = array(
			'password'	=> $in['password'],
		);

		$this->Crud->u('mst_kepala_sekolah', $data, $where);
		$this->session->set_flashdata("success","Ubah Password Kepala Sekolah berhasil");
		redirect('User/kepsek');
	}

	public function guru()
	{
		$d['judul'] = "Data Guru";
		$d['data_guru'] = $this->Crud->ga('mst_guru');
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/guru');
		$this->load->view('bottom');	
	}

	public function guru_ubah_password($id_guru)
	{
		$where = array('id_guru' => $id_guru,);
		$d['judul'] = "Ubah Password Guru";
		$d['judul2'] = "Ubah";
		$d['tipe'] = 'add';
		$d['data_password'] = $this->Crud->gw('mst_guru', $where);
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/guru_password');
		$this->load->view('bottom');
	}

	public function guru_edit_password($id_guru)
	{
		$where = array('id_guru' => $id_guru);
		$in = $this->input->post(NULL, FALSE);
		$data = array(
			'password'	=> $in['password'],
			'nip'	=> $in['nip'],
		);

		$this->Crud->u('mst_guru', $data, $where);
		$this->session->set_flashdata("success","Ubah Password Guru berhasil");
		redirect('User/guru');
	}

	public function siswa()
	{
		$d['judul'] = "Data Siswa";
		$d['data_siswa'] = $this->Crud->ga('mst_siswa');
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/siswa');
		$this->load->view('bottom');	
	}

	public function siswa_ubah_password($id_siswa)
	{
		$where = array('id_siswa' => $id_siswa,);
		$d['judul'] = "Ubah Password Siswa";
		$d['judul2'] = "Ubah";
		$d['tipe'] = 'add';
		$d['data_password'] = $this->Crud->gw('mst_siswa', $where);
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/siswa_password');
		$this->load->view('bottom');
	}

	public function siswa_edit_password($id_siswa)
	{
		$where = array('id_siswa' => $id_siswa);
		$in = $this->input->post(NULL, FALSE);
		$data = array(
			'password'	=> $in['password'],
			'nis'	=> $in['nis'],
			'nisn'	=> $in['nisn'],
		);

		$this->Crud->u('mst_siswa', $data, $where);
		$this->session->set_flashdata("success","Ubah Password Siswa Berhasil");
		redirect('User/siswa');
	}

	//Administrator Utama Begin
	public function administrator()
	{
		$d['judul'] = "Data Administrator";
		$d['admin'] = $this->Crud->ga('mst_admin');
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/administrator');
		$this->load->view('bottom');
	}

	public function administrator_tambah() {
		$d['judul'] = "Data Administrator";
		$d['judul2'] = "Tambah";
		$d['tipe'] = 'add';
		$d['nama'] = "";
		$d['username'] = "";
		$d['password'] = "";
		$d['id'] = "";
		$this->load->view('top',$d);
		$this->load->view('menu');
		$this->load->view('admin/administrator_tambah');
		$this->load->view('bottom');
		
	}

	public function administrator_edit($id_admin) {
		$cek = $this->db->query("SELECT id FROM mst_admin WHERE id = '$id_admin'");
		if($cek->num_rows() > 0) { 
			$d['judul'] = "Data Administrator";
			$d['judul2'] = "Ubah";
			$d['tipe'] = 'edit';
			$get = $this->User_model->administrator_edit($id_admin);
			$data = $get->row();
			$d['nama'] = $data->nama;
			$d['username'] = $data->username;
			$d['password'] = $data->password;
			$d['id'] = $data->id;
			$this->load->view('top',$d);
			$this->load->view('menu');
			$this->load->view('admin/administrator_tambah');
			$this->load->view('bottom');
		} else {
			$this->load->view('top');
			$this->load->view('menu');
			$this->load->view('404');
			$this->load->view('bottom');
		}	
	}

	public function administrator_save() {
		$tipe = $this->input->post("tipe");	
		$in['nama'] = $this->input->post("nama");
		$in['username'] = $this->input->post("username");
		$in['password'] = $this->input->post("password");
		$in['tipe'] = 'root';

		$config['upload_path'] = './../upload/foto';
		$config['allowed_types']= 'jpg|png';
		$config['encrypt_name']	= TRUE;
		$config['remove_spaces']	= TRUE;	
		$config['max_size']     = '0';
		$config['max_width']  	= '0';
		$config['max_height']  	= '0';

		$this->load->library('upload', $config);
		
		if($tipe == "add") {
			$cek = $this->db->query("SELECT username FROM mst_admin WHERE username = '$in[username]'");
			if($cek->num_rows() > 0) { 
				$this->session->set_flashdata("error","Gagal Input. Username Sudah Digunakan");
				redirect("User/administrator_tambah/");
			}  else { 	
				if(!empty($_FILES['foto']['name'])) {
					if($this->upload->do_upload("foto")) {
						$data	 	= $this->upload->data();
						$in['foto'] = $data['file_name'];	
						$this->db->insert("mst_admin",$in);
						$this->session->set_flashdata("success","Tambah Data Administrator Berhasil");
						redirect("User/administrator");
					} else {
						$this->session->set_flashdata("error",$this->upload->display_errors());
						redirect("User/administrator");	
					}
				} else {
						$this->db->insert("mst_admin",$in);
						$this->session->set_flashdata("success","Tambah Data Administrator Berhasil");
						redirect("User/administrator");
				}	
			}
		} elseif($tipe = 'edit') {
			$where['id'] 	= $this->input->post('id');
			$cek = $this->db->query("SELECT username FROM mst_admin WHERE username = '$in[username]' AND id != '$where[id]'");
			if($cek->num_rows() > 0) { 
				$this->session->set_flashdata("error","Gagal Input. Username Sudah Digunakan");
				redirect("User/administrator_edit/".$this->input->post("id"));
			} else { 	
				$this->db->update("mst_admin",$in,$where);
				$this->session->set_flashdata("success","Ubah Data Administrator Berhasil");
				redirect("User/administrator");
			}
			
		} else {
			redirect(base_url());
		}
	}

	public function administrator_hapus($id) {
		$where['id'] = $id;
		$this->db->delete("mst_admin",$where);
		$this->session->set_flashdata("success","Hapus Data Administrator Berhasil");
		redirect("User/administrator");
	}
	//Administrator Utama End
}