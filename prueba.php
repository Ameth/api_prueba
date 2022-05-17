<?php
$ar=explode("/",$_SERVER['REQUEST_URI']);
print_r($ar);
$url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".($ar[1]!="" ? $ar[1]."/" : "")."auth.php";
echo $url;
?>