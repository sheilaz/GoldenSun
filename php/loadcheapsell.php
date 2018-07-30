<?php
$country = $_GET['country'];
$district = $_GET['district'];

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webuser";
$response = array();
$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query("set character set 'utf8'");
$conn->query("set names 'utf8'");
if($country=="选择国家"){
    if($district=="选择楼盘")
        $sql = "SELECT * FROM house where pay='售房' and specialoffer='特价' order by rand() limit 12";
    else $sql = "SELECT * FROM house WHERE pay='售房' and specialoffer='特价' and district = '{$district}' order by rand() limit 12";
}
else if ($district=="选择楼盘")
    $sql = "SELECT * FROM house WHERE pay='售房' and specialoffer='特价' and country = '{$country}' order by rand() limit 12";
else $sql = "SELECT * FROM house WHERE pay='售房' and specialoffer='特价' and country = '{$country}' and district = '{$district}' order by rand() limit 12";

//$sql = "SELECT * FROM house where pay='售房' and specialoffer='特价' order by rand() limit 12";
$result = $conn->query($sql);
while($row = $result->fetch_array()){
    //echo json_encode($row[image],JSON_UNESCAPED_SLASHES);
    $response[] = $row;
}
echo json_encode($response,JSON_UNESCAPED_SLASHES);
$conn->close();
?>