<?php
session_start();
  include"../include/koneksi.php";
  include "../include/fungsi_rupiah.php";
   date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$wkt=date('G:i:s');

$aid = $_SESSION['login_user'];
$aa = "select * from users where id='$aid'";
  $bb = mysql_query($aa) or die(mysql_error());
  $cc = mysql_fetch_array($bb);
  $id=$cc['name'];
  $iduser=$cc['id'];
  
    $sqlpengaturan="SELECT * from pengaturan_perusahaan where  pengaturan_id='1' ";
    $querypengaturan=mysql_query($sqlpengaturan);
    $datapengaturan=mysql_fetch_array($querypengaturan);


      $t = $_SESSION['no-nota'];
    $sql="SELECT * from transaksi where  transaksi_id='$t' ";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      $pelanggan=$data['transaksi_pelanggan'];
      $type=$data['transaksi_type_bayar'];
      $meja=$data['transaksi_no_meja'];
      $lantai=$data['transaksi_lantai'];
      $tanggal = $data['transaksi_tanggal'];
    }
        

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../style-print.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Bar</title>

<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
</head>

<body onLoad="window.print()">
  <div class="wrapper">
<table width="100%" border="0">
<tr>
    <td></td>
    <td></td>
    <td style="text-align:right;"><?php echo $id; ?></td>
  </tr>
    <tr>
    <td></td>
    <td></td>
    <td style="text-align:right;"></td>
  </tr>
  <tr>
    <td>Bar</td>
    <td colspan=2 style="text-align:right;"><?php echo $t; ?></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td>Tanggal</td>
    <td>:</td>
    <td style="text-align:right;"><?php echo $tanggal; ?></td>
  </tr>
  <tr>
    <td>Customer</td>
    <td>:</td>
    <td style="text-align:right;"><?php echo $pelanggan; ?></td>
  </tr>
   <tr>
    <td>Lantai</td>
    <td>:</td>
    <td style="text-align:right;"><?php echo $lantai; ?></td>
  </tr>
  <tr>
    <td>No. Meja</td>
    <td>:</td>
    <td style="text-align:right;"><?php echo $meja; ?></td>
  </tr>
</table>
<br />
<br />
<table width="100%" border="0">
  <?php
    
    $sql="SELECT * from transaksi_detail jd, barang b, kategori where barang_kategori=kategori_id and barang_id=transaksi_detail_barang_id and transaksi_detail_nota='$t' and kategori_jenis='Minuman' ";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      $namamenu=$data['barang_nama'];
	  $ket_lain="  (".$data['transaksi_detail_keterangan'].")";
    
      $tran_jumlah=$data['transaksi_detail_jumlah'];
      echo "
      <tr>
        <td>".$namamenu."".$ket_lain."</td>
    
        <td style='text-align:right;'>(".$tran_jumlah.")</td>
      </tr>
      <tr>
        <td colspan=2><hr></td>
     </tr>
      ";
      
    }
  ?>

</table>
</div>
</body>
</html>
