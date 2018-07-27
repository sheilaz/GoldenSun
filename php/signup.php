<?php
$servername = "localhost";
$username = "webuser";
$password = "admin123";
$dbname = "webuser";

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query("set character set 'utf8'");
$conn->query("set names 'utf8'");

$sql02 = "SELECT * FROM guest WHERE email = '{$_POST['emailaddress']}'";
$result = $conn->query($sql02);
if ($result->num_rows > 0 ) {
    while($row = $result->fetch_assoc()) {
        echo "<script>alert('该邮箱已被注册，请更换邮箱！')</script>";
        $url='../login.html';
        echo "<script>window.location.href='$url';</script>";
    }

}
else {
    $sql01 = "
	INSERT INTO guest (email, password, fname, lname, phone)
	VALUES ('{$_POST['emailaddress']}', '{$_POST['password']}', '{$_POST['firstname']}', '{$_POST['lastname']}', '{$_POST['phonenumber']}')
	";
    $conn->query($sql01);
    echo "<script>alert('注册成功，请登陆！')</script>";
    $url='../login.html';
    echo "<script>window.location.href='$url';</script>";
}
$conn->close();
?>