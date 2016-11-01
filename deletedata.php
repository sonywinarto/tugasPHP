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

$id = $_GET["id"];
$query = $conn -> prepare("select * from puskesmas where id=?");
$query->bind_param("i",$id);
$result = $query->execute();

if(!$result)
    die("gagal query");
$rows = $query->get_result();
if($rows->num_rows==0)
    die("produk tidak ditemukan");


$query = $conn->prepare("delete from puskesmas where id=?");
$query->bind_param("i",$id);
$result = $query->execute();

if($result)
    echo"<p>Data produk berhasil di didelete</p>";
else
    echo"<p>Gagal mendelete data produk</p>";
?>
</body>
<a href="pengunjung.php">Kembali</a>
</html>