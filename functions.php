<?php 
 //koneksi ke data base
 $conn = mysqli_connect("localhost", "root", "", "latihan");

 function query($query){
 	global $conn;
 	$result = mysqli_query($conn, $query);
 	$rows=[];
 	while( $row = mysqli_fetch_assoc($result)){
 		$rows[] = $row;
 	}
 	return $rows;
 }

 function tambah($data_andre){
	//ambil data dari tiap elemen dalam form
	global $conn;
	$no_absen = htmlspecialchars($data_andre["no_absen"]);
	$nama = htmlspecialchars($data_andre["nama"]);
	$kelas = htmlspecialchars($data_andre["kelas"]);
	$alamat = htmlspecialchars($data_andre["alamat"]);
	$hobi = htmlspecialchars($data_andre["hobi"]);
	$gambar = htmlspecialchars($data_andre["gambar"]);

	$gambar = upload();
	if(!$gambar){
		return false;
	}

	$query = "INSERT INTO data_andre
		VALUES
	('', '$no_absen', '$nama', '$kelas', '$alamat', '$hobi', '$gambar')
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

 function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM data_andre WHERE id = $id");
	return mysqli_affected_rows($conn);
}
function ubah($data_andre){
	global $conn;
	$id=$data_andre["id"];
	$no_absen = htmlspecialchars($data_andre["no_absen"]);
	$nama = htmlspecialchars($data_andre["nama"]);
	$kelas = htmlspecialchars($data_andre["kelas"]);
	$alamat = htmlspecialchars($data_andre["alamat"]);
	$hobi = htmlspecialchars($data_andre["hobi"]);
	//$gambar = htmlspecialchars($data_andre["gambar"]);
	$gambarLama = htmlspecialchars($data_andre["gambarLama"]);

	if($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	}else{
		$gambar = upload();
	}

	//query insert data
	$query = "UPDATE data_andre SET
		no_absen = '$no_absen',
		nama = '$nama',
		kelas = '$kelas',
		alamat = '$alamat',
		hobi = '$hobi',
		gambar = '$gambar'
		WHERE id = $id
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword){
	$query = "SELECT * FROM data_andre
	WHERE
	no_absen LIKE '%$keyword%' OR 
	nama LIKE '%$keyword%' OR
	kelas LIKE '%$keyword%' OR
	alamat LIKE '%$keyword%' OR
	hobi LIKE '%$keyword%' 
	";
	return query($query);
}
function registrasi($data_andre){
	global $conn;

	$username =  strtolower(stripcslashes($data_andre["username"]));
	$password = mysqli_real_escape_string($conn, $data_andre["password"]);
	$password2 = mysqli_real_escape_string($conn, $data_andre["password2"]);

//LANGKAH KE 2 setelah bisa tambah ke database. cek username sudah ada atau belum
	$result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");
	if(mysqli_fetch_assoc($result)) {
		echo "<script>
		alert('username sudah terdaftar!')
		</script>";
		return false;
	}


	//cek konfirmasi password
	if($password !== $password2){
		echo "<script>
		alert  ('konfirmasi password tidak sesuai!');
		</script>";
		return false;
	}
	//enkripsi dulu passwordnya pakai hash
	$password = password_hash($password, PASSWORD_DEFAULT);

	//tambahkan user baru kedatabase
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");
	return mysqli_affected_rows($conn);

}

function upload(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	//langkah ke 5 cek apakah tdk ada gambar yang di upload dan kasih pesan kesalahan
	if($error === 4){
		echo "<script>
		alert('Silahkan pilih gambar dulu!');
		</script>";
		return false;
	}

	//langkah 6 cek yangdiupload pasti adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.',$namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
		alert('Yang Anda upload bukan gambar!');
		</script>";
		return false;
	}

	//langkah 7 cek jika ukuran gambar terlalu besar
	if($ukuranFile > 1000000){
		echo "<script>
		alert('Ukuran file yang Anda upload terlalu besar!');
		</script>";
		return false;
	}
	//langkah 9 generate nama file baru agar tidak merubah file orang lain yang sudah ada dalam data/folder
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	//langkah 8 jika lolos 3 pengecekan di atas, tinggal pindahkan data tsb
	//langkah 10 ubah code ini menjadi move_uploaded_file($tmpName, 'gambar/' . $namaFile);
	move_uploaded_file($tmpName, 'gambar/' . $namaFileBaru);
	return $namaFileBaru;


}

?>

