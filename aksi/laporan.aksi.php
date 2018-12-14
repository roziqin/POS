<?php
session_start();
include "../include/koneksi.php";
include "../include/slug.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');

if(isset($_POST['proses'])){
	$jenis_laporan = $_POST['jenis_laporan'];
	$waktu_laporan = $_POST['waktu_laporan'];
	$kasir = $_POST['kasir'];
	$menu = $_POST['menu'];
	$tangal_harian = $_POST['tanggal_harian'];
	$bulan1 = $_POST['bulan1'];
	$bulan2 = $_POST['bulan2'];


	if ($jenis_laporan=="omset") {
		
		if ($waktu_laporan=="harian") {
			
			echo ("<script>location.href='../admin.php?menu=laporan&ket=penjualan&jenis=$jenis_laporan&waktu=$waktu_laporan&date=$tangal_harian&data='</script>");
		} elseif ($waktu_laporan=="bulanan") {
			$bln=$bulan1.":".$bulan2;
			echo ("<script>location.href='../admin.php?menu=laporan&ket=penjualan&jenis=$jenis_laporan&waktu=$waktu_laporan&date=$bln&data='</script>");
			
		}
		
	} elseif ($jenis_laporan=="kasir") {
		
		if ($waktu_laporan=="harian") {
			
			echo ("<script>location.href='../admin.php?menu=laporan&ket=penjualan&jenis=$jenis_laporan&waktu=$waktu_laporan&date=$tangal_harian&data=$kasir'</script>");
		} elseif ($waktu_laporan=="bulanan") {
			$bln=$bulan1.":".$bulan2;
			echo ("<script>location.href='../admin.php?menu=laporan&ket=penjualan&jenis=$jenis_laporan&waktu=$waktu_laporan&date=$bln&data=$kasir'</script>");
			
		}
		
	} elseif ($jenis_laporan=="menu") {
		
		if ($waktu_laporan=="harian") {
			
			echo ("<script>location.href='../admin.php?menu=laporan&ket=penjualan&jenis=$jenis_laporan&waktu=$waktu_laporan&date=$tangal_harian&data=$menu'</script>");
		} elseif ($waktu_laporan=="bulanan") {
			$bln=$bulan1.":".$bulan2;
			echo ("<script>location.href='../admin.php?menu=laporan&ket=penjualan&jenis=$jenis_laporan&waktu=$waktu_laporan&date=$bln&data=$menu'</script>");
			
		}
		
	}
}
elseif(isset($_POST['log'])){
	$ket_log = $_POST['ket_log'];
	$tangal_harian = $_POST['tanggal_harian'];
	
	echo ("<script>location.href='../admin.php?menu=log&ket=$ket_log&waktu=$tangal_harian'</script>");
	

}
?>