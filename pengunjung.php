<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh menambah data ke database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Menambah data Pasien Puskesmas</h1>

    <form method="post" action="createdata.php" enctype="multipart/form-data">
        <div>
            <label>Nama Pasien</label>
            <input type="text" name="nama" placeholder="Nama Pengunjung">
        </div>
        <div>
            <label>Jenis Kelamin:</label>
            <input type="text" name="kelamin" placeholder="Kelamin">
        </div>
        <div>
            <label>Tanggal Masuk</label>
            <input type="text" name="tanggal" placeholder="Tanggal Masuk">
        </div>
        <div>
        	<label>Tanggal Keluar</label>
        	<input type="text" name="tanggal2" placeholder="Tanggal Keluar">
        </div>
        <div>
        	<label></label>
        </div>
        <div>
            <input type="submit" value="Tambah">
        </div>
    </form>
    <?php 
require_once "konek.php";

$conn = konek_db();
//eksekusi query untuk tarik data dari database
$query = $conn->prepare("select * from puskesmas");
$result = $query->execute();

if(! $result)
    die("Gagal Query");

//tarik data ke result set
$rows = $query->get_result();
 ?>
 <table>
        <tr>
            <th>ID</th>
            <th>Nama Pasien</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th> 
        </tr>
        <?php 
        while ($row = $rows->fetch_array()) {
            //$url_edit = "edit.php?id=" . $row['id'];
            //$url_delete = "delete.php?id=" . $row['id'];
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['Nama'] . "</td>";
            echo "<td>" . $row['Kelamin'] . "</td>";
            echo "<td>" . $row['Masuk'] . "</td>";
            echo "<td>" . $row['Keluar'] . "</td>";
            //echo "<td><a href ='" . $url_edit . "'><button>Edit</button></a>";
            //echo "<a href='" . $url_delete . "'><button>Delete</button></a></td>";
            echo "</tr>";
        }
         ?>
</body>
</html>
