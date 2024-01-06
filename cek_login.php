<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksi.php';
 
// menangkap data yang dikirim dari form login
@$username = $_POST['username'];
@$password = md5($_POST['password']);
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'")or die(mysqli_error($koneksi));
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="Admin" || $data['level']=="Pelanggan"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
        $_SESSION['id'] = $data['id'];
		$_SESSION['level'] = "Admin";
		// alihkan ke halaman dashboard admin
		header("location:index.php?page=dashboard");
 
	// cek jika user login sebagai pegawai
	}
}else{
	header("location:index.php?pesan=gagal");
}
 
?>