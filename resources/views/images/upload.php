<?php

if ($_FILES) 
{ 
$name = $_FILES['filename']['name'];
switch($_FILES['filename']['type']){
case 'image/jpeg': $ext = 'jpg'; break; 
case 'image/gif': $ext = 'gif'; break; 
case 'image/png': $ext = 'png'; break; 
case 'image/tiff': $ext = 'tif'; break;
default: $ext = ''; break;    
}

 if ($ext){
   move_uploaded_file($_FILES['filename']['tmp_name'], $name); 
echo "Загружаемое изображение '$name'<br><img src='$name'>";  
 }
 else    echo "Загрузки изображения не произошло";
 }



?>