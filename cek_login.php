<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
@$username = $_POST['username'];
@$password = md5($_POST['password']);


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'") or die(mysqli_error($koneksi));
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

$data = mysqli_fetch_assoc($login);
if ($cek > 0 && $data['is_verified'] == 1) {


	// cek jika user login sebagai admin
	if ($data['level'] == "Admin") {

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $data['id'];
		$_SESSION['level'] = "Admin";
		// alihkan ke halaman dashboard admin
		header("location:index.php?page=dashboard");

		// cek jika user login sebagai pegawai
	} else if ($data['level'] == "Pelanggan") {

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['id'] = $data['id'];
		$_SESSION['level'] = "Pelanggan";
		// alihkan ke halaman dashboard admin
		header("location:index.php?page=dashboard");

		// cek jika user login sebagai pegawai
	}
} else if ($data['is_verified'] == 0) {
	header("location:login.php?pesan=verifikasi");
} else if ($data['is_verified'] == 2) {
	header("location:login.php?pesan=diblokir");
} else {
	header("location:login.php?pesan=gagal");
}
