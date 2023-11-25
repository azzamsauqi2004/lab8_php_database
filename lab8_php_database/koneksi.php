<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "latihan02";
$koneksi = mysqli_connect($host, $user, $pass, $db);
if($koneksi){
    $buka=mysqli_select_db($koneksi,$db);
    echo"database dapat terhubung";
    if($buka){
        echo"database tidak dapat terhubung";
    }
  }else{
    echo  "mysql tidak terhubung";
}

?>

