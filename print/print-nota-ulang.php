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
<!-- Print style -->
<link rel="stylesheet" href="dist/css/print.css">
<script type="text/javascript">
  window.setTimeout(function() {
    window.close();
  },1000)
</script>
</head>

<body onLoad="window.print()" style="
  font-family: 'Merchant Copy'; font-size: 13px;">
    <div class="wrapper">
<img src="../images/logo-mini.png" style="margin: 0 auto 10px;
    display: block;">
<table  width="100%" border="0"  style='font-size: 16px;'>
  <tr>
    <th colspan="4"><?php echo $datapengaturan['pengaturan_alamat']; ?></th>
  </tr>
  <tr>
    <th colspan="4"><?php echo $datapengaturan['pengaturan_telp']; ?></th>
  </tr>
  <tr>
    <th colspan="4"><?php echo $tgl." - ".$wkt; ?></th>
  </tr>
  <tr>
    <td width="60">Pelanggan</td>
    <td width="10">:</td>
    <td ><?php echo $pelanggan;?></td>
    <td  align="right">Nota - <?php echo $t; ?></td>
  </tr>
  <tr>
    <td>No Meja</td>
    <td>:</td>
    <td><?php echo $meja;?></td>
    <td  align="right">Lt-<?php echo $lantai; ?></td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
</table>
<table width="100%" border="0"  style='font-size: 16px;'>
  <tr>
    <td align="center">Menu</td>
    <td width="24" align="center">Jml.</td>
    <td width="60" align="center">Harga</td>
    <td width="60" align="center">Subtotal</td>
  </tr>
   <?php
    $no=1;
    $sql="SELECT * from transaksi,transaksi_detail,barang WHERE transaksi_id=transaksi_detail_nota and transaksi_detail_barang_id=barang_id and transaksi_id='$t'";
    $query=mysql_query($sql);
    while ($data=mysql_fetch_array($query)) {
      
		  
      $barang=$data['barang_nama'];
      $jumlah=$data['transaksi_detail_jumlah'];
      $harga=$data['transaksi_detail_harga'];
      $diskon=$data['transaksi_diskon'];
      $tot=$jumlah*$harga;
      $tran_tot = $data['transaksi_total'];
      $bayar = $data['transaksi_bayar'];
      $kembalian = $bayar - $tran_tot;

      echo "

      <tr>
        <td>".$barang."</td>
        <td align='center'>".$jumlah."</td>
        <td align='right'>".format_rupiah($harga)."</td>
        <td align='right'>".format_rupiah($tot)."</td>
      </tr>
      ";
      
      $no=$no+1;
    }         
  ?>
  <tr>
    <td colspan="4"><hr color="black"></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Subtotal </th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo format_rupiah($tran_tot+$diskon); ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Diskon </th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo format_rupiah($diskon); ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Total</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo format_rupiah($tran_tot) ; ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Bayar</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo format_rupiah($bayar) ; ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Kembalian</th>
    <td align="right">: Rp.</td>
    <td align="right"><?php echo format_rupiah($kembalian) ; ?></td>
  </tr>
  <tr>
    <th align="left" scope="row" colspan="2">Pembayaran</th>
    <td align="left">&nbsp;</td>
    <td align="right"><?php echo $type ; ?></td>
  </tr>
  <tr>
    <th colspan="4">TERIMA KASIH</th>
  </tr>
</table>
</div>
</body>
</html>
