<?php
$district = $_GET['district'];
$style = $_GET['style'];

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webuser";
$response = array();
$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query("set character set 'utf8'");
$conn->query("set names 'utf8'");

if($district=="选择区域"){
    if($style=="选择户型")
        $sql = "SELECT * FROM house where
          country='柬埔寨' and pay='租房'";
    else $sql = "SELECT * FROM house WHERE style = '{$style}'
          and country='柬埔寨' and pay='租房'";
}
else if ($style=="选择户型")
    $sql = "SELECT * FROM house WHERE district = '{$district}'
      and country='柬埔寨' and pay='租房'";
else $sql = "SELECT * FROM house WHERE district = '{$district}'AND style = '{$style}'
      and country='柬埔寨' and pay='租房'";

$result = $conn->query($sql);
while($row = $result->fetch_array()){
    //echo json_encode($row[image],JSON_UNESCAPED_SLASHES);
    $response[] = $row;
}
echo json_encode($response,JSON_UNESCAPED_SLASHES);
$conn->close();
?>