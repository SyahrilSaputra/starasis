<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

	public function cek($in)
	{
		
		$username = $in['username'];
		$password = $in['password'];
		$type = $in['type'];

		if($type == "payrol"){
			$db2 = $this->load->database('payroll', TRUE);
			$l_payrol = $db2->query("SELECT * FROM t_user WHERE username='$username' AND password='".sha1($password)."'");

			foreach ($l_payrol->result() as $data) {
				$_SESSION['id_user'] =  $data->id_user;
				$session['pesan'] = 'Selamat datang '.$data->nm_user.'  di sistem Payroll Solution, login anda sebagai '.$data->level_user.'';
				redirect("../payroll/masukapi.php?id=$data->id_user&nm=$data->nm_user&lv=$data->level_user");
				
		}

		
	}
	else{
		////////////////////////// mst_admin dan mst_guru , mst_siswa, mst_staff, mst_kepala_sekolah //////////////////
		$q_admin = $this->db->from("mst_admin")->where("username",$username)->where("password",$password)->get();
		//$q_admin = $this->db->query("SELECT * FROM mst_admin WHERE username = '$username' AND password = '$password'");
		
		$q_bk = $this->db->from("mst_guru")->join("mst_jabatan","mst_guru.id_jabatan = mst_jabatan.id_jabatan")->where("nip",$username)->where("password",$password)->where("mst_guru.id_jabatan",3)->get();
		//$q_bk = $this->db->query("SELECT * FROM mst_guru INNER JOIN mst_jabatan ON mst_guru.id_jabatan = mst_jabatan.id_jabatan WHERE nip = '$username' AND password = '$password' AND mst_guru.id_jabatan = 3");

		$q_guru = $this->db->from("mst_guru")->join("mst_jabatan","mst_guru.id_jabatan = mst_jabatan.id_jabatan")->where("nip",$username)->where("password",$password)->where("mst_guru.id_jabatan",2)->get();
		//$q_guru = $this->db->query("SELECT * FROM mst_guru INNER JOIN mst_jabatan ON mst_guru.id_jabatan = mst_jabatan.id_jabatan WHERE nip = '$username' AND password = '$password' AND mst_guru.id_jabatan = 2");

		$q_siswa = $this->db->from("mst_siswa")->where("nis",$username)->where("password",$password)->get();
		//$q_siswa = $this->db->query("SELECT * FROM mst_siswa WHERE nis = '$username' AND password = '$password'");
		
		$q_staff = $this->db->from("mst_staff")->join("mst_jabatan","mst_staff.id_jabatan = mst_jabatan.id_jabatan")->where("nip",$username)->where("password",$password)->where("mst_staff.id_jabatan",7)->get();
		//$q_staff = $this->db->query("SELECT * FROM mst_staff INNER JOIN mst_jabatan ON mst_staff.id_jabatan = mst_jabatan.id_jabatan WHERE nip = '$username' AND password = '$password' AND (mst_staff.id_jabatan = '25' or mst_staff.id_jabatan = '7') ");
		
		$q_kepalasekolah = $this->db->from("mst_kepala_sekolah")->join("mst_jabatan","mst_kepala_sekolah.id_jabatan = mst_jabatan.id_jabatan")->where("nip",$username)->where("password",$password)->where("mst_kepala_sekolah.id_jabatan",19)->get();
		//$q_kepalasekolah = $this->db->query("SELECT * FROM mst_kepala_sekolah INNER JOIN mst_jabatan ON mst_kepala_sekolah.id_jabatan = mst_jabatan.id_jabatan WHERE nip = '$username' AND password = '$password' AND mst_kepala_sekolah.id_jabatan = '19'");

		///////////////////////////////// mst_user ///////////////////////////////////////
		
		$q_wakasek = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",14)->get();
		//$q_wakasek = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '14'");

		$q_keuangan = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("(mst_user.id_jabatan = '10' OR hak_akses = 'dasview' OR hak_akses = 'das' OR hak_akses = 'kasir' OR hak_akses = 'bendahara')")->get();
		//$q_keuangan = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND (mst_user.id_jabatan = '10' OR hak_akses = 'dasview' OR hak_akses = 'das' OR hak_akses = 'kasir' OR hak_akses = 'bendahara')");

		$q_perpus = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",20)->get();
		//$q_perpus = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '20'");

		$q_alumni = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",21)->get();
		//$q_alumni = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '21'");

		$q_bukutamu = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",22)->get();
		//$q_bukutamu = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '22'");

		$q_ppdb = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",23)->get();
		//$q_ppdb = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '23'");

		$q_kelulusan = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",24)->get();
		//$q_kelulusan = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '24'");

		$q_akademik = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",9)->get();
		//$q_akademik = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '9'");

		$q_sarpras = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("(mst_user.id_jabatan = '26' OR mst_user.id_jabatan = '15')")->get();
		//$q_sarpras = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND (mst_user.id_jabatan = '26' OR mst_user.id_jabatan = '15')");

		$q_elearning = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",27)->get();
		//$q_elearning = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '27'");
		
		$q_cbt = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",28)->get();
		//$q_cbt = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '28'");
	
		//////////////////////////////////////////////////////////////
		$q_penggajian = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",33)->get();
		//$q_penggajian = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '33'");
	
		$q_tabungan = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",29)->get();
		//$q_tabungan = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '29'");

		$q_kartupelajar = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",30)->get();
		//$q_kartupelajar = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '30'");

		$q_sms = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",31)->get();
		//$q_sms = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '31'");

		$q_absensi = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",32)->get();
		//$q_absensi = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '32'");
		
		$q_yayasan = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",18)->get();
		//$q_yayasan = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '18'");

		$q_admkesiswaan = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("(mst_user.id_jabatan = '13' OR mst_user.id_jabatan = '16')")->get();
		//$q_admkesiswaan = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND (mst_user.id_jabatan = '13' OR mst_user.id_jabatan = '16')");

		$q_kejuruan = $this->db->from("mst_user")->join("mst_jabatan","mst_user.id_jabatan = mst_jabatan.id_jabatan")->where("username",$username)->where("password",$password)->where("mst_user.id_jabatan",17)->get();
		//$q_kejuruan = $this->db->query("SELECT * FROM mst_user INNER JOIN mst_jabatan ON mst_user.id_jabatan = mst_jabatan.id_jabatan WHERE username = '$username' AND password = '$password' AND mst_user.id_jabatan = '17'");

		

		if ($q_admin->num_rows() > 0) {
			foreach ($q_admin->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = 'admin';
				$session['nama_jabatan'] = 'Administrator';
				$session['tipe'] = $data->tipe;
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("home");
		} else if ($q_bk->num_rows() > 0) {
			foreach ($q_bk->result() as $data) {
				$session['username'] = $data->nip;
				$session['id'] = $data->id_guru;
				$session['id_guru'] = $data->id_guru;
				$session['foto'] = $data->foto;
				$session['nama'] = $data->nama_guru;
				$session['hak_akses'] = $data->hak_akses;
				$session['tipe'] = 'gurupiket';
				$session['password'] = $data->password;
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../kesiswaan");
		} else if ($q_guru->num_rows() > 0) {
			foreach ($q_guru->result() as $data) {
				$session['username'] = $data->nip;
				$session['id'] = $data->id_guru;
				$session['id_guru'] = $data->id_guru;
				$session['foto'] = $data->foto;
				$session['nama'] = $data->nama_guru;
				$session['hak_akses'] = $data->hak_akses;
				$session['tipe'] = 'gurupiket';
				$session['password'] = $data->password;
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../akademik");
			} else if ($q_wakasek->num_rows() > 0) {
			foreach ($q_wakasek->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'wakasek';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../akademik");
		} else if ($q_keuangan->num_rows() > 0) {
			foreach ($q_keuangan->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'keuangan';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../keuangan");
		} else if ($q_siswa->num_rows() > 0) {
			foreach ($q_siswa->result() as $data) {
				$session['username'] = $data->nis;
				$session['id'] = $data->id_siswa;
				$session['id_siswa'] = $data->id_siswa;
				$session['foto'] = $data->foto;
				$session['nama'] = $data->nama_siswa;
				$session['hak_akses'] = 'siswa';
				$session['tipe'] = 'siswa';
				$session['id_kelas'] = $data->id_kelas;
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../akademik");
		} else if ($q_perpus->num_rows() > 0) {
			foreach ($q_perpus->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'perpus';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../perpustakaan");
		} else if ($q_alumni->num_rows() > 0) {
			foreach ($q_alumni->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'alumni';
				$this->session->set_userdata($session);
			}
			redirect("../alumni");
		} else if ($q_bukutamu->num_rows() > 0) {
			foreach ($q_bukutamu->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'bukutamu';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../bukutamu");
		} else if ($q_ppdb->num_rows() > 0) {
			foreach ($q_ppdb->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'ppdb';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../ppdb");
		} else if ($q_kelulusan->num_rows() > 0) {
			foreach ($q_kelulusan->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'kelulusan';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../kelulusan");
		} else if ($q_akademik->num_rows() > 0) {
			foreach ($q_akademik->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = 'adminakademik';
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'akademik';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../akademik");
		} else if ($q_sarpras->num_rows() > 0) {
			foreach ($q_sarpras->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = 'admin';
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'sarpras';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../sarpras");
			} else if ($q_elearning->num_rows() > 0) {
			foreach ($q_elearning->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = 'admin';
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'elearning';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../asiselearning/index.php/admin");
			} else if ($q_cbt->num_rows() > 0) {
			foreach ($q_cbt->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = 'admin';
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'cbt';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../asiscbt/index.php/manager");

		}
		else if ($q_staff->num_rows() > 0) {
			$id_jab;
			foreach ($q_staff->result() as $data) {
			
				$session['username'] = $data->username;
				$session['id'] = $data->id_staff;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = 'admin';
				$session['nama_jabatan'] = 'operator';
				$id_jab = $data->id_jabatan;
				$session['tipe'] = 'operator';
				$this->session->set_userdata($session);
				
			}
			if($id_jab == 25){
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../akademik/home");
			}
			else{
				$log['username'] = $session['nama'];
				$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
				$log['hak_akses'] = $session['hak_akses'];
				$this->db->insert("log_login",$log);
				redirect("../keuangan/home");
				
			}
		}

		else if($q_kepalasekolah->num_rows() > 0) {
			foreach ($q_kepalasekolah->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_kepala_sekolah;
				$session['foto'] = $data->foto;
				$session['nama'] = $data->nama;
				$session['hak_akses'] = 'admin';
				$session['nama_jabatan'] = 'Administrator';
				$session['tipe'] = "root";
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = 'admin';
			$this->db->insert("log_login",$log);
			redirect("home");
		}

		else if ($q_penggajian->num_rows() > 0) {
			foreach ($q_penggajian->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'admin';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../payroll");
		}

		else if ($q_tabungan->num_rows() > 0) {
			foreach ($q_tabungan->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'admin';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../tabungan");
		}

		else if ($q_kartupelajar->num_rows() > 0) {
			foreach ($q_kartupelajar->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'admin';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../kartu");
		}

		else if ($q_sms->num_rows() > 0) {
			foreach ($q_sms->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'admin';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../sms");
		}

		else if ($q_absensi->num_rows() > 0) {
			foreach ($q_absensi->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'admin';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../absensi");
		}

		else if ($q_admkesiswaan->num_rows() > 0) {
			foreach ($q_admkesiswaan->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = $data->hak_akses;
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'admin';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../kesiswaan");
		}

		else if ($q_yayasan->num_rows() > 0) {
			foreach ($q_yayasan->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = 'admin';
				$session['nama_jabatan'] = 'Administrator';
				$session['tipe'] = "root";
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("home");
		}

		else if ($q_kejuruan->num_rows() > 0) {
			foreach ($q_kejuruan->result() as $data) {
				$session['username'] = $data->username;
				$session['id'] = $data->id_user;
				$session['nama'] = $data->nama;
				$session['foto'] = $data->foto;
				$session['hak_akses'] = 'admin';
				$session['nama_jabatan'] = $data->nama_jabatan;
				$session['tipe'] = 'root';
				$this->session->set_userdata($session);
			}
			$log['username'] = $session['nama'];
			$log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
			$log['hak_akses'] = $session['hak_akses'];
			$this->db->insert("log_login",$log);
			redirect("../akademik");
		}
		

		else {
			$this->session->set_flashdata("error", "Gagal Login. Username dan Password Salah");
			redirect(base_url());
		}
	}
  }
}
