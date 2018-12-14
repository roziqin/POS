<?php
session_start();
include "../include/koneksi.php";
include "../include/slug.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');

if(isset($_POST['inputbarang'])){
	$nama = $_POST['ip-nama'];
	$kategori = $_POST['ip-kategori'];
	$beli = $_POST['ip-beli'];
	$jual = $_POST['ip-jual'];
	$setstok = $_POST['ip-setstok'];
	$stok = $_POST['ip-stok'];
	$batas = $_POST['ip-batas'];
	$disable = $_POST['ip-disable'];

	$sql = "INSERT into barang(barang_nama,barang_kategori,barang_harga_beli,barang_harga_jual,barang_set_stok,barang_stok,barang_batas_stok,barang_disable)values('$nama','$kategori','$beli','$jual','$setstok','$stok','$batas','$disable')";
	$c=mysql_query($sql);
	if($c){
		echo ("<script>location.href='../admin.php?menu=barang&id=0'</script>");
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal diubah!');
		}
		</script>";
	}

} elseif(isset($_POST['editbarang'])){
	$id = $_POST['barang_id'];
	$nama = $_POST['ip-nama'];
	$kategori = $_POST['ip-kategori'];
	$beli = $_POST['ip-beli'];
	$jual = $_POST['ip-jual'];
	$setstok = $_POST['ip-setstok'];
	$stok = $_POST['ip-stok'];
	$batas = $_POST['ip-batas'];
	$disable = $_POST['ip-disable'];
	$user = $_SESSION['login_user'];

	$sql="SELECT * from barang where barang_id='$id'";
	$query=mysql_query($sql);
	$data=mysql_fetch_array($query);

	mysql_query("INSERT INTO log_harga(barang_id,harga_beli_awal,harga_beli_baru,harga_jual_awal,harga_jual_baru,user,tanggal) VALUES ('$id','$data[barang_harga_beli]','$beli','$data[barang_harga_jual]','$jual','$user','$tgl')");

	$sql="UPDATE barang set barang_nama='$nama',barang_kategori='$kategori',barang_harga_beli='$beli',barang_harga_jual='$jual',barang_set_stok='$setstok',barang_stok='$stok',barang_batas_stok='$batas',barang_disable='$disable' where barang_id='$id'";
	$c=mysql_query($sql);
	if($c){
		echo ("<script>location.href='../admin.php?menu=barang&id=0'</script>");
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal diubah!');
		}
		</script>";
	}

} elseif(isset($_POST['inputkategori'])){
	$nama = $_POST['ip-nama'];	
	$jenis = $_POST['ip-jenis'];
	$slug = slugify($nama);

	$sql = "INSERT into kategori(kategori_nama,kategori_jenis,kategori_slug)values('$nama','$jenis','$slug')";
	$c=mysql_query($sql);
	if($c){
		echo ("<script>location.href='../admin.php?menu=category&id=0'</script>");
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal diubah!');
		}
		</script>";
	}

} elseif(isset($_POST['editkategori'])){
	$id = $_POST['kategori_id'];
	$nama = $_POST['ip-nama'];
	$jenis = $_POST['ip-jenis'];
	$slug = slugify($nama);

	$sql="UPDATE kategori set kategori_nama='$nama',kategori_jenis='$jenis', kategori_slug='$slug' where kategori_id='$id'";
	$c=mysql_query($sql);
	echo mysql_error();
	if($c){
		echo ("<script>location.href='../admin.php?menu=category&id=0'</script>");
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal diubah!');
		}
		</script>";
	}

} elseif(isset($_POST['inputstok'])){
	$id = $_POST['barang_id'];
	$user = $_SESSION['login_user'];

	$sql="SELECT * from barang where barang_id='$id'";
	$query=mysql_query($sql);
	$data=mysql_fetch_array($query);
	$awal=$data['barang_stok'];
	$jumlah = $_POST['ip-jumlah']+$awal;

	$sql = "INSERT into log_stok(user,barang,stok_awal,stok_jumlah,tanggal)values('$user','$id','$awal','$jumlah','$tgl')";
	mysql_query($sql);

	$sql="UPDATE barang set barang_stok='$jumlah' where barang_id='$id'";
	$c=mysql_query($sql);

	if($c){
		echo ("<script>location.href='../admin.php?menu=stok&ket=&id=0'</script>");
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal diubah!');
		}
		</script>";
	}

} elseif(isset($_POST['editstok'])){
	$id = $_POST['barang_id'];
	$ket = $_POST['ip-ket'];
	$user = $_SESSION['login_user'];

	$sql="SELECT * from barang where barang_id='$id'";
	$query=mysql_query($sql);
	$data=mysql_fetch_array($query);
	$awal=$data['barang_stok'];
	$jumlah = $awal-$_POST['ip-jumlah'];

	$sql = "INSERT into log_stok(user,barang,stok_awal,stok_jumlah,tanggal,alasan)values('$user','$id','$awal','$jumlah','$tgl','$ket')";
	mysql_query($sql);

	$sql="UPDATE barang set barang_stok='$jumlah' where barang_id='$id'";
	$c=mysql_query($sql);

	if($c){
		echo ("<script>location.href='../admin.php?menu=stok&ket=&id=0'</script>");
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data gagal diubah!');
		}
		</script>";
	}

}

?>