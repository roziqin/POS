<?php
session_start();
    include "include/koneksi.php";
    $id = $_SESSION['login_user'];
    date_default_timezone_set('Asia/jakarta');
    $tgl=date('Y-m-j');
    $wkt=date('H:i:s');
    $tgl1= $tgl." ".$wkt;
  
$qn= "SELECT MAX( id ) AS id FROM log_user where user='$id'";
$rn=mysql_query($qn);
$dn=mysql_fetch_array($rn);
$user = $dn['id'];

mysql_query("UPDATE log_user SET logout='$tgl1' WHERE id='$user'");

    
$_SESSION['login_user']=NULL;   
$_SESSION['login'] = 0; 
  session_destroy();
header("location:index.php");
    
?>