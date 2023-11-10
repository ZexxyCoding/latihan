<?php
require 'functions.php';
$data_andre = query("SELECT * FROM data_andre");
if (isset($_POST["cari"])) {
	$data_andre = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Utama</title>
</head>
<body>
<h1><center>DATA DIRI</center></h1>

<center><a href="tambah.php">Tambah data Siswa</a></center>
<br>
<center><a href="login.php"><button style="background-color: pink">Logout</logout></a></center>
<br>
<center>
<form action="" method="post" >
	
	<input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off">
	<button type="submit" name="cari">Cari</button></center>
</form>
<br>
<table border="1" cellpadding="10" cellspacing="0" align="center">
<tr style="background-color: yellow">
<th>No.</th>
<th>Aksi</th>
<th>No. Absen</th>
<th>Nama</th>
<th>Kelas</th>
<th>alamat</th>
<th>Hobi</th>
<th>Foto</th>
</tr>

<?php $i = 1; ?>
<?php foreach ( $data_andre as $row) : ?>
<tr>
	<td><?= $i; ?></td>
	<td>
	<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a>
	<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('YAKIN?');">Hapus</a>
</td>
<td><?= $row["no_absen"]; ?></td>
<td><?= $row["nama"]; ?></td>
<td><?= $row["kelas"]; ?></td>
<td><?= $row["alamat"]; ?></td>
<td><?= $row["hobi"]; ?></td>
<td><img src="gambar/<?= $row["gambar"]; ?>" width="100"></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>
<br>
</body>
</html>