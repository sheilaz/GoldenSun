<?php
$servername = "localhost";
$username = "webuser";
$password = "admin123";
$dbname = "webuser";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("set character set 'utf8'");
$conn->query("set names 'utf8'");

$sql = "SELECT * FROM guest WHERE email = '{$_POST['acconut']}' AND password = '{$_POST['pw']}'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<script>alert('用户".$row["lname"].$row["fname"]."登陆成功！')</script>";
		$url='../index.html';
		echo "<script>window.location.href='$url';</script>";
    }
    
} 
else {
	echo "<script>alert('用户名或密码错误')</script>";
	$url='../login.html';
	echo "<script>window.location.href='$url';</script>";
}

$conn->close();

?>