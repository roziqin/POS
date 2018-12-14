<?php
session_start();
include "../include/koneksi.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$id=$_GET['id'];
if ($_GET['ket']=='kategori') {
	$sql="DELETE from kategori where kategori_id='$id'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}else{
		echo "<script>location.href='../admin.php?menu=category&id=0'</script>";
	
	}
} elseif ($_GET['ket']=='user') {
	$sql="DELETE from users where id='$id'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}else{
		echo "<script>location.href='../admin.php?menu=user&id=0'</script>";
	
	}
} elseif ($_GET['ket']=='barang') {
	$sql="DELETE from barang where barang_id='$id'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}else{
		echo "<script>location.href='../admin.php?menu=barang&id=0'</script>";
	
	}
}  elseif ($_GET['ket']=='transaksi_menu') {
	$sql="DELETE from transaksi_detail_temp where transaksi_detail_temp_id='$id'";
	if (!mysql_query($sql)) {
		echo "Data tidak terhapus";
		# code...
	}else{
		echo "<script>location.href='../home.php?menu=home&pelanggan='</script>";
	
	}
}  elseif ($_GET['ket']=='transaksi_menu_pelanggan') {
	
	echo "transaksi_menu_pelanggan";
}
?>