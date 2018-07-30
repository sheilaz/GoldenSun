<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webuser";
$building = time();

$conn = new mysqli($servername, $username, $password, $dbname);

$conn->query("set character set 'utf8'"); 
$conn->query("set names 'utf8'");

$sql = "
	INSERT INTO house (building, country, district, style, balcony, direction, pay, specialoffer, price, area, bn, fn, rn)
	VALUES ('{$building}', '{$_POST['country']}', '{$_POST['district']}', '{$_POST['style']}', '{$_POST['balcony']}', '{$_POST['direction']}',
	'{$_POST['pay']}', '{$_POST['specialoffer']}', '{$_POST['price']}', '{$_POST['area']}', '{$_POST['place01']}', '{$_POST['place02']}', '{$_POST['place03']}')
	";
$conn->query($sql);

if($_FILES) {
	foreach($_FILES['overall']['type'] as $key=>$value) {
		$type = 'overall';
        switch ($value) {
            case 'image/jpeg': $ext = 'jpg';
                break;
            case 'image/png': $ext = 'png';
                break;
            case 'image/gif': $ext = 'gif';
            default:
                $ext = '';
                break;
        }
        if($ext) {
            $name = 'upload/'.time().$type.'_'."$key.$ext";
            move_uploaded_file($_FILES['overall']['tmp_name'][$key], $name);
			$name = 'php/'.$name;
			$sql = "
			UPDATE house SET image = '{$name}' WHERE building = '{$building}'
			";
			$conn->query($sql);
			$sql = "
			INSERT INTO image (building, type, url)
			VALUES('{$building}', 'overall', '{$name}')
			";
			$conn->query($sql);
        }
		
    }
	foreach($_FILES['external']['type'] as $key=>$value) {
		$type = 'external';
        switch ($value) {
            case 'image/jpeg': $ext = 'jpg';
                break;
            case 'image/png': $ext = 'png';
                break;
            case 'image/gif': $ext = 'gif';
            default:
                $ext = '';
                break;
        }
        if($ext) {
            $name = 'upload/'.time().$type.'_'."$key.$ext";
            move_uploaded_file($_FILES['external']['tmp_name'][$key], $name);
			$name = 'php/'.$name;
			$sql = "
			INSERT INTO image (building, type, url)
			VALUES('{$building}', 'external', '{$name}')
			";
			$conn->query($sql);
        }
		
    }
	foreach($_FILES['internal']['type'] as $key=>$value) {
		$type = 'internal';
        switch ($value) {
            case 'image/jpeg': $ext = 'jpg';
                break;
            case 'image/png': $ext = 'png';
                break;
            case 'image/gif': $ext = 'gif';
            default:
                $ext = '';
                break;
        }
        if($ext) {
            $name = 'upload/'.time().$type.'_'."$key.$ext";
            move_uploaded_file($_FILES['internal']['tmp_name'][$key], $name);
			$name = 'php/'.$name;
			$sql = "
			INSERT INTO image (building, type, url)
			VALUES('{$building}', 'internal','{$name}')
			";
			$conn->query($sql);
        }
		
    }

	
}

//echo '<META HTTP-EQUIV="Refresh" CONTENT="0"; URL="index.html">';
echo "<script>alert('添加成功！')</script>";
$url='../addhouse.html';
echo "<script>window.location.href='$url';</script>";
$conn->close();
?>