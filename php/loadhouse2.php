<?php
$district = $_GET['district'];
$style = $_GET['style'];

$servername = "localhost";
$username = "webuser";
$password = "admin123";
$dbname = "webuser";
$response = array();
$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query("set character set 'utf8'"); 
$conn->query("set names 'utf8'");

if($district=="选择区域"){
    if($style=="选择户型"){
        if($type=="选择类型")
            $sql = "SELECT * FROM house";
        else
            $sql = "SELECT * FROM house WHERE type ='{$type}'";
    }
    else if($type == "选择类型")
        $sql = "SELECT * FROM house WHERE style = '{$style}'";
    else $sql = "SELECT * FROM house WHERE style = '{$style}' AND type = '{$type}'";
}
else if ($style=="选择户型"){
    if($type=="选择类型")
        $sql = "SELECT * FROM house";
    else $sql = "SELECT * FROM house WHERE type ='{$type}'";
}
else if($type=="选择类型")
    $sql = "SELECT * FROM house WHERE district = '{$district}'AND style = '{$style}'";
else $sql = "SELECT * FROM house WHERE district = '{$district}'AND style = '{$style}' AND type = '{$type}'";//

$result = $conn->query($sql);
while($row = $result->fetch_array()){
    //echo json_encode($row[image],JSON_UNESCAPED_SLASHES); 
    $response[] = $row;
}
echo json_encode($response,JSON_UNESCAPED_SLASHES);
$conn->close();
?>