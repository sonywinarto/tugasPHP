<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contoh menambah data ke database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "konek.php";
if (isset($_POST["nama"]) && isset($_POST["kelamin"]) && isset($_POST["tanggal"]) && isset($_POST["tanggal2"])) {
    $nama  = $_POST["nama"];
    $kelamin = $_POST["kelamin"];
    $tanggal = $_POST["tanggal"];
    $tanggal2 = $_POST["tanggal2"];

    $conn = konek_db();


    // bangun query yang akan dieksekusi menggunakan prepared statement
    // simbol ? pada statement query akan diisikan dengan parameter query
    // sesuai dengan parameter pada pemanggilan method bind_param
    $query = $conn->prepare("insert into puskesmas(Nama,Kelamin,Masuk,Keluar) values(?, ?, ?, ?)");
    // pasangkan parameter query dengan method bind_param
    // parameter pertama adalah string yang berisikan format data 
    // masing-masing parameter query
    // s -- string
    // i -- integer
    // d -- double
    // b -- blob/binary
    // parameter ke-dua dan seterusnya adalah parameter query
    // yang akan dipasangkan pada statement query
    $query->bind_param("ssss", $nama, $kelamin , $tanggal , $tanggal2);

    // jalankan query
    $result = $query->execute();

 
    if (! $result)
        die("<p>Proses query gagal.</p>");

    echo "<p>Data produk berhasil ditambahkan.</p>";
} else {
    echo "<p>Data produk belum diisi!</p>";
}
?>
<hr>
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
</table>
<a href="pengunjung.php">Kembali</a>
</body>
</html>
