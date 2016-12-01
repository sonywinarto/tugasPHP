<?php 
session_start() 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
require_once "konek.php";

$username = $_POST["username"];
	$password = sha1($_POST["password"]);

	$conn= konek_db();

	$query = $conn->prepare("select * from login where username=? and password=?");
	$query->bind_param("ss",$username,$password);
	$result = $query->execute();

	if($result) {
		$res = $query->get_result();
		if($res->num_rows ==1){
			//login user
			$_SESSION["username"] = $username;
			//redirect ke content
			header("Location: pengunjung.php");
			//jika username/password salah tampilkan warning
		}else {
			//echo "<p>Username/Password salah</p>";
			echo '<script>';
			echo 'alert("Username/Password Invalid!");';
			echo 'location.href="index.html"';
			echo '</script>';
		}
	} else {
		echo "<p>Lagi ada masalah dengan system. Coba beberapa saat lagi</p>";
	}


?>


<a href="index.html">Kembali</a>
</body>
</html>
