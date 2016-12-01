<?php 
require "konek.php";
if(isset($_POST["username"]) &&($_POST["password"])) {
	$username = $_POST["username"];
	$password = sha1($_POST["password"]);

	$conn = konek_db();

	$query = $conn->prepare("Insert into login values(?,?)");
	$query->bind_param("ss",$username,$password);

	$hasil = $query->execute();

		if($hasil) {
			echo '<script>';
			echo 'alert("User Berhasil ditambahkan");';
			echo 'location.href="index.html"';
			echo '</script>';
		}else {
			//echo "<p>Username/Password salah</p>";
			echo '<script>';
			echo 'alert("User Gagal ditambahkan");';
			echo 'location.href="index.html"';
			echo '</script>';
		}
	} else {
			echo '<script>';
			echo 'alert("User/Password tidak dikirim");';
			echo 'location.href="index.html"';
			echo '</script>';
	}



 // 	if($hasil)
 // 		$pesan = "User berhasil ditambahkan";
 // 	else 
 // 		$pesan = "Gagal tambah user"; 
 // } else {
	// $pesan = "User/Password tidak dikirim";


?>
