<?php

$name = $_FILES["myfile"]["name"];
$type = $_FILES["myfile"]["type"];
$size = $_FILES["myfile"]["size"];
$temp = $_FILES["myfile"]["tmp_name"];
$error= $_FILES["myfile"]["error"];

if ($error > 0)
    die('Error uploading file! Code $error.');
else{//conditions for the file
        move_uploaded_file($temp, "uploaded/".$name);
        echo"upload complete";
}
?>
<html>
    <style>
img {
    image-orientation: from-image;
}
    </style>
    
</html>