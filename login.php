<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
	body {
		font-family: sans-serif;
		background: #ebf9fb;
	}

	h1 {
		text-align: center;
		/*ketebalan font*/
		font-weight: 300;
	}

	.tulisan_login {
		text-align: center;
		/*membuat semua huruf menjadi kapital*/
		text-transform: uppercase;
	}

	.kotak_login {
		width: 350px;
		background: white;
		/*meletakkan form ke tengah*/
		margin: 80px auto;
		padding: 30px 20px;
		box-shadow: 0px 0px 100px 4px #d6d6d6;
	}

	label {
		font-size: 11pt;
	}

	.form_login {
		/*membuat lebar form penuh*/
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		font-size: 11pt;
		margin-bottom: 20px;
	}

	.tombol_login {
		background: #2aa7e2;
		color: white;
		font-size: 11pt;
		width: 100%;
		border: none;
		border-radius: 3px;
		padding: 10px 20px;
	}

	.tombol_daftar {
		background: green;
		color: white;
		font-size: 11pt;
		width: 100%;
		border: none;
		border-radius: 3px;
		padding: 10px 20px;
	}

	.link {
		color: #232323;
		text-decoration: none;
		font-size: 10pt;
	}

	.alert {
		background: #e44e4e;
		color: white;
		padding: 10px;
		text-align: center;
		border: 1px solid #b32929;
	}
</style>

<body>

	<h1 align="center">BIKA FROZENFOOD</h1>

	<?php
	if (isset($_GET['pesan'])) {
		if ($_GET['pesan'] == "gagal") {
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		} else if ($_GET['pesan'] == "verifikasi") {
			echo "<div class='alert'>Email belum di verifikasi !</div>";
		} else if ($_GET['pesan'] == "diblokir") {
			echo "<div class='alert'>Akun telah DIBLOK !</div>";
		} {
		}
	}
	?>

	<div class="kotak_login">
		<p class="tulisan_login">Silahkan login</p>

		<form action="cek_login.php" method="post">
			<label>Username</label>
			<input type="text" name="username" class="form_login" placeholder="Username .." required="required">

			<label>Password</label>
			<input type="password" name="password" class="form_login" placeholder="Password .." required="required">

			<input type="submit" class="tombol_login" value="LOGIN">

			<br />
			<br />
			<center>
				<a class="link" href="register.php" class="tombol_daftar">Daftar</a>
			</center>
		</form>

	</div>


</body>

</html>