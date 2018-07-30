<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webuser";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("set character set 'utf8'");
$conn->query("set names 'utf8'");

$sql01 = "SELECT * FROM guest WHERE email = '{$_POST['email']}' AND phone = '{$_POST['phone']}'";
$result = $conn->query($sql01);


if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
        $sql02 = "update guest set password = '{$_POST['newpw']}' WHERE email = '{$_POST['email']}' AND phone = '{$_POST['phone']}'";
        $conn->query($sql02);
        echo "<script>alert('密码修改成功，请重新登录')</script>";
        $url='../login.html';
        echo "<script>window.location.href='$url';</script>";
    }
    
} 
else {
	echo "<script>alert('请输入正确的邮箱与手机号')</script>";
	$url='../getpass.html';
	echo "<script>window.location.href='$url';</script>";
}

$conn->close();

?>