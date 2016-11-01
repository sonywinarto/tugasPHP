<!DOCTYPE html>
<html>
<head>
	<title>Contoh update data ke database</title>
</head>
<body>
<?php 
require_once "konek.php"; 

$conn = konek_db();

if(! isset($_GET["id"]))
	die("tidak ada id pasien");
//verifikasi data yang ada di database

$id = $_GET["id"];
$query = $conn->prepare("select * from puskesmas where id=?");
$query->bind_param("i", $id);
$result = $query->execute();

if (! $result)
	die("gagal query");

$rows = $query->get_result();
if ($rows->num_rows == 0)
	die("Data Pasien tidak ditemukan");

if(! isset($_POST["nama"]) || ! isset($_POST['kelamin']) || ! isset($_POST['tanggal']) || ! isset($_POST['tanggal2']))
	die("data Pasien tidak lengkap");
$nama  = $_POST["nama"];
$kelamin = $_POST["kelamin"];
$tanggal = $_POST["tanggal"];
$tanggal2 = $_POST["tanggal2"];

$produk = $rows->fetch_object();
$id = $_GET['id'];
$query = $conn->prepare("UPDATE puskesmas set Nama=?, Kelamin=?, Masuk=?, Keluar=? where id=?");
$query->bind_param("ssssi",$nama,$kelamin,$tanggal,$tanggal2,$id);
$result = $query->execute();

if($result)
	echo "<p>Data Pasien berhasil di update</p>";
else
	echo "<p>Gagal Mengupdate Data Pasien</p>"; 
?>
</body>
</html>