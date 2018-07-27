<?php
$building = $_GET['building'];
$servername = "localhost";
$username = "webuser";
$password = "admin123";
$dbname = "webuser";
$response = array();
$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query("set character set 'utf8'"); 
$conn->query("set names 'utf8'");

$sql = "SELECT * FROM image WHERE building = '{$building}'";

$result = $conn->query($sql);
while($row = $result->fetch_array()){
    $response[] = $row;
}
echo json_encode($response,JSON_UNESCAPED_SLASHES);
$conn->close();
?>