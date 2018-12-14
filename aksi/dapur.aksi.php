<?php
include "../include/koneksi.php";
	$id=$_GET['id'];
		
		if ($_GET['menu']=='update') {
			mysql_query("UPDATE transaksi_detail set transaksi_detail_status='2' where transaksi_detail_id='$id'");
		} elseif ($_GET['menu']=='close') {
			mysql_query("UPDATE transaksi_detail set transaksi_detail_status='0' where transaksi_detail_id='$id'");
		}
		
		
      			echo "<script>location.href='../dapur.php'</script>";
		//header("location:gudangpage.php?menu=cekorder&opt=sukses");

?>