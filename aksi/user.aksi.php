<?php
session_start();
include "../include/koneksi.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');

if(isset($_POST['inputuser'])){
	$nama = $_POST['ip-nama'];
	$user = $_POST['ip-user'];
	$password = md5($_POST['ip-password']);
	$roles = $_POST['ip-roles'];

	$sql = "INSERT into users(name,username,password,role,remember_token)values('$nama','$user','$password','$roles','0')";
	$c=mysql_query($sql);
	if($c){
		echo ("<script>location.href='../admin.php?menu=user&id=0'</script>");
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal diubah!');
		}
		</script>";
	}

} elseif(isset($_POST['edituser'])){
	$id = $_POST['user_id'];
	$nama = $_POST['ip-nama'];
	$user = $_POST['ip-user'];
	$password = md5($_POST['ip-password']);
	$roles = $_POST['ip-roles'];
	
	if ($_POST['ip-password']!='') {
		$sql="UPDATE users set name='$nama',username='$user',password='$password',role='$roles' where id='$id'";
	} else {
		$sql="UPDATE users set name='$nama',username='$user',role='$roles' where id='$id'";
	}
	$c=mysql_query($sql);
	if($c){
		echo ("<script>location.href='../admin.php?menu=user&id=0'</script>");
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal diubah!');
		}
		</script>";
	}

}

?>