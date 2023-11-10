<?php 
require 'functions.php';
//langkah 1 ubah text jadi file pada input gambar
//langkah ke 2 tambahkan 

//koneksi ke DBMS
//cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"])) {


	//cek apakah data berhasil ditambahkan atau tidak
	if(tambah($_POST) > 0 ){
		echo "
		<script>
		alert('Data Berhasil Ditambahkan!');
		document.location.href = 'index.php';
		</script>
		";
	}else {
		echo "
		<script>
		alert('Data Gagal Ditambahkan!');
		document.location.href = 'index.php';
		</script>
		";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Siswa</title>
</head>
<body>
<h1>Tambah Data Siswa</h1>

<form action="" method="post" enctype="multipart/form-data">
	<ul>
		<li>
			<label for="no_absen">No Absen : </label>
			<input type="text" name="no_absen" id="no_absen" required>
		</li>
		<li>
			<label for="nama">Nama : </label>
			<input type="text" name="nama" id="nama" required>
		</li>
		<li>
			<label for="kelas">Kelas : </label>
			<input type="text" name="kelas" id="kelas">
		</li>
		<li>
			<label for="alamat">Alamat : </label>
			<input type="text" name="alamat" id="alamat">
		</li>
		<li>
			<label for="hobi">Hobi : </label>
			<input type="text" name="hobi" id="hobi">
		</li>
		<li>			
			<label for="gambar">Gambar : </label>
			<input type="file" name="gambar" id="gambar">
		</li>
		<li>
			<button type="submit" name="submit">Tambah Data!</button>
		</li>


	</ul>

</form>

</body>
</html>