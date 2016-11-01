<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php  
require_once "konek.php";
if (! isset($_GET['id']))
    die("Informasi Pasien tidak ditemukan");
$conn = konek_db();

$id = $_GET["id"];
$query = $conn->prepare("select * from puskesmas where id = ?");
$query->bind_param("i", $id);
$result = $query->execute();

if(! $result)
    die("Gagal query");

$rows = $query->get_result();
if ($rows->num_rows == 0)
    die ("<p>informasi Pasien tidak ditemukan</p>");
$data = $rows->fetch_object();

?>
<form method="post" action="updatedata.php?id=<?php echo $data->id; ?>">
        <div>
            <label>ID</label>
            <p><?php echo $data->id;?></p>
        </div>
        <div>
            <label>Nama</label>
            <input type="text" name="nama">
        </div>
        <div>
            <label>Jenis Kelamin</label>
            <input type="text" name="kelamin">
        </div>
        <div>
            <label>Tanggal Masuk</label>
            <input type="text" name="tanggal">
        </div>
        <div>
            <label>Tanggal Keluar</label>
            <input type="text" name="tanggal2">
        </div>
        
        <div><input type="submit" name="Update"></div>
        </form>
</body>
</html>