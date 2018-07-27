<?php
$country = $_GET['country'];
$pay = $_GET['pay'];

$servername = "localhost";
$username = "webuser";
$password = "admin123";
$dbname = "webuser";
$response = array();
$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query("set character set 'utf8'");
$conn->query("set names 'utf8'");

if($country=="选择国家"){
    if($pay=="选择交易方式")
        $sql = "SELECT * FROM house order by building desc limit 12";
    else $sql = "SELECT * FROM house WHERE pay = '{$pay}' order by building desc limit 12";
}
else if ($pay=="选择交易方式")
    $sql = "SELECT * FROM house WHERE country = '{$country}' order by building desc limit 12";
else $sql = "SELECT * FROM house WHERE country = '{$country}' and pay = '{$pay}' order by building desc limit 12";

//$sql = "SELECT * FROM house order by building desc limit 3";
$result = $conn->query($sql);
while($row = $result->fetch_array()){
    //echo json_encode($row[image],JSON_UNESCAPED_SLASHES);
    $response[] = $row;
}
echo json_encode($response,JSON_UNESCAPED_SLASHES);
$conn->close();
?>