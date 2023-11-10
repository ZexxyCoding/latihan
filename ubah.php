<?php 
require 'functions.php';
//langkah 11 ubah bagian input gambar

//koneksi ke DBMS

//ambil data di URL
$id = $_GET["id"];

//query data dataku berdasarkan id
$data_andre = query("SELECT * FROM data_andre WHERE id = $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"])) {
	
	//cek apakah data berhasil ditambahkan atau tidak
	if(ubah($_POST) > 0 ){
		echo "
		<script>
		alert('Data Berhasil Diubah!');
		document.location.href = 'index.php';
		</script>
		";
	}else {
		echo "
		<script>
		alert('Data Gagal Diubah!');
		document.location.href = 'index.php';
		</script>
		";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data</title>
</head>
<body>
<h1>Ubah Data</h1>

<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $data_andre["id"]; ?>">
	
	<ul>
		<li>
			<label for="no_absen">no_absen : </label>
			<input type="text" name="no_absen" id="no_absen" value="<?= $data_andre["no_absen"]; ?>">
		</li>
		<li>
			<label for="nama">Nama : </label>
			<input type="text" name="nama" id="nama" value="<?= $data_andre["nama"]; ?>">
		</li>
		<li>
			<label for="kelas">Kelas : </label>
			<input type="text" name="kelas" id="kelas" value="<?= $data_andre["kelas"]; ?>">
		</li>
        <li>
			<label for="alamat">Alamat : </label>
			<input type="text" name="nama" id="alamat" value="<?= $data_andre["alamat"]; ?>">
		</li>
		<li>
			<label for="hobi">Hobi : </label>
			<input type="text" name="hobi" id="hobi" value="<?= $data_andre["hobi"]; ?>">
		</li>
		<li>
			<label for="gambar">Gambar : </label> <br>
			<img src="gambar/<?= $sis['gambar']; ?>" width="40">  <br>
			<input type="file" name="gambar" id="gambar">
		</li>

		<li>
			<button type="submit" name="submit">Ubah Data!</button>
		</li>
	</ul>

</form>

</body>
</html>