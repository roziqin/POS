<?php
session_start();
include "../include/koneksi.php";
include "../include/slug.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$bln=date('Y-m');
$wkt=date('H:i:s');

if(isset($_POST['inputmenutemp'])){
	$id = $_POST['ip-barang'];	
	$jumlah = $_POST['ip-jumlah'];
	$ket = $_POST['ip-ket'];
	$user = $_SESSION['login_user'];

	$sql="SELECT * from barang where barang_id='$id'";
	$query=mysql_query($sql);
	$data=mysql_fetch_array($query);

	$sqla="SELECT * from transaksi_detail_temp where transaksi_detail_temp_barang_id='$id'";
	$querya=mysql_query($sqla);
	$dataa=mysql_fetch_array($querya);

	if($dataa) {
		$jml=$dataa['transaksi_detail_temp_jumlah']+$jumlah;
	} else {
		$jml=$jumlah;
	}

	if ($data['barang_set_stok']==1 && $jml>$data['barang_stok']) {
		echo ("<script>location.href='../home.php?menu=jumlah&id=$id&nama=$data[barang_nama]&ket=Stok Kurang&pelanggan='</script>");
	} else {

		$tot = $data['barang_harga_jual']*$jumlah;
		
		$sql = "INSERT INTO transaksi_detail_temp(transaksi_detail_temp_barang_id,transaksi_detail_temp_harga,transaksi_detail_temp_jumlah,transaksi_detail_temp_total,transaksi_detail_temp_keterangan,transaksi_detail_temp_user)values('$id','$data[barang_harga_jual]','$jumlah','$tot','$ket','$user')";
		$c=mysql_query($sql);
		echo mysql_error();
		if($c){
			echo ("<script>location.href='../home.php?menu=home&pelanggan='</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
	}

} elseif(isset($_POST['editmenutemp'])){
	$idtemp = $_POST['ip-temp'];
	$id = $_POST['ip-barang'];		
	$jumlah = $_POST['ip-jumlah'];
	$ket = $_POST['ip-ket'];
	$user = $_SESSION['login_user'];

	$sql="SELECT * from barang where barang_id='$id'";
	$query=mysql_query($sql);
	$data=mysql_fetch_array($query);	

	if ($data['barang_set_stok']==1 && $jumlah>$data['barang_stok']) {
		echo ("<script>location.href='../home.php?menu=editjumlah&id=$idtemp&nama=$data[barang_nama]&ket=Stok Kurang&pelanggan='</script>");
	} else {

		$tot = $data['barang_harga_jual']*$jumlah;
		
		$sql="UPDATE transaksi_detail_temp set transaksi_detail_temp_jumlah='$jumlah',transaksi_detail_temp_total='$tot', transaksi_detail_temp_keterangan='$ket' where transaksi_detail_temp_id='$idtemp'";

		$c=mysql_query($sql);
		echo mysql_error();
		if($c){
			echo ("<script>location.href='../home.php?menu=home&pelanggan='</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
		
	}

} elseif(isset($_POST['editmenupel'])){
	$idtemp = $_POST['ip-temp'];
	$id = $_POST['ip-barang'];		
	$jumlahdetail = $_POST['ip-jumlah-detail'];	
	$jumlah = $_POST['ip-jumlah'];
	$ket = $_POST['ip-ket'];
	$pel = $_POST['ip-pelanggan'];
	$user = $_SESSION['login_user'];

	$sql="SELECT * from barang where barang_id='$id'";
	$query=mysql_query($sql);
	$data=mysql_fetch_array($query);	

	if ($data['barang_set_stok']==1 && $jumlah>$data['barang_stok']) {
		echo ("<script>location.href='../home.php?menu=editjumlahpelanggan&id=$idtemp&nama=$data[barang_nama]&ket=Stok Kurang&pelanggan=$pel'</script>");
	} else {

		$tot = $data['barang_harga_jual']*$jumlah;
		
		$sql="UPDATE transaksi_detail set transaksi_detail_jumlah='$jumlah',transaksi_detail_total='$tot', transaksi_detail_keterangan='$ket' where transaksi_detail_id='$idtemp'";

		if($data['barang_set_stok']!=0) {
        	$jml_stok = $data['barang_stok'] + $jumlahdetail - $jumlah;
        
	        mysql_query("UPDATE barang SET barang_stok='$jml_stok' WHERE barang_id='$id'");
        }

		$c=mysql_query($sql);
		echo mysql_error();
		if($c){
			echo ("<script>location.href='../home.php?menu=home&pelanggan=$pel'</script>");
		}else{
		echo "<script type='text/javascript'>
			onload =function(){
			alert('Data gagal diubah!');
			}
			</script>";
		}
		
	}

} elseif(isset($_POST['prosestransaksi'])){
	$nama = $_POST['ip-nama'];
	$meja = $_POST['ip-meja'];	
	$lantai = $_POST['ip-lantai'];		
	$total = $_POST['ip-total'];
	$tipe_bayar = $_POST['ip-tipe-bayar'];
	$potongan = $_POST['ip-potongan'];
	$diskon = $_POST['ip-diskon'];
	$user = $_SESSION['login_user'];

	if ($potongan=='Diskon') {
		$jmldiskon = $total*$diskon/100;
	} else {
		$jmldiskon = $diskon;
	}
	
	$tot = $total - $jmldiskon;
	$tax = $_POST['ip-tax'];
	$tot = $tot+$tax;

    $text_line = explode(".",$_POST['ip-bayar']);
    $length=count($text_line);
    if ($length==1) {
      $bayar=$text_line[0];
      # code...
    }elseif ($length==2) {
      $bayar=$text_line[0]."".$text_line[1];
      # code...
    }elseif ($length==3) {
      # code...
      $bayar=$text_line[0]."".$text_line[1]."".$text_line[2];
    }elseif ($length==4) {
      # code...
      $bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
    }elseif ($length==5) {
      # code...
      $bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
    }

    $kembalian = $bayar - $tot;

	if ($kembalian < 0) {
		# code...
	    echo ("<script>location.href='../home.php?menu=kurang&pelanggan='</script>");
	} else {

		$sql = "INSERT INTO transaksi(transaksi_tanggal,transaksi_waktu,transaksi_bulan,transaksi_pelanggan,transaksi_no_meja,transaksi_lantai,transaksi_total,transaksi_diskon,transaksi_bayar,transaksi_type_bayar,transaksi_user,transaksi_tax)values('$tgl','$wkt','$bln','$nama','$meja','$lantai','$tot','$jmldiskon','$bayar','$tipe_bayar','$user','$tax')";
		mysql_query($sql);
		
		$qn= "SELECT MAX( transaksi_id ) AS nota FROM transaksi where transaksi_user='$user'";
	    $rn=mysql_query($qn);
	    $dn=mysql_fetch_array($rn);
	    $no_not = $dn['nota'];
	    $_SESSION['no-nota'] = $no_not;	

	    $sql="SELECT * from transaksi_detail_temp where transaksi_detail_temp_user='$user'";
	    $query=mysql_query($sql);
	    while ($data1=mysql_fetch_array($query)) {

	    	$barang = $data1['transaksi_detail_temp_barang_id'];
	    	$harga = $data1['transaksi_detail_temp_harga'];
	    	$jumlah = $data1['transaksi_detail_temp_jumlah'];
	    	$total = $data1['transaksi_detail_temp_total'];
	    	$ket = $data1['transaksi_detail_temp_keterangan'];
	    	$user = $data1['transaksi_detail_temp_user'];

	    	$sql = "INSERT INTO transaksi_detail(transaksi_detail_nota,transaksi_detail_barang_id,transaksi_detail_harga,transaksi_detail_jumlah,transaksi_detail_total,transaksi_detail_keterangan,transaksi_detail_user,transaksi_detail_status)values('$no_not','$barang','$harga','$jumlah','$total','$ket','$user','1')";
			$c=mysql_query($sql);

			$sqlkem11="SELECT * from barang where barang_id='$barang'";
	        $querykem11=mysql_query($sqlkem11);
	        $datakem11=mysql_fetch_array($querykem11);

	        if($datakem11['barang_set_stok']!=0) {
	        	$jml_stok = $datakem11['barang_stok'] - $jumlah;
	        
		        mysql_query("UPDATE barang SET barang_stok='$jml_stok' WHERE barang_id='$barang'");
	        }
	        
	    }


        $sqlmin=mysql_query("SELECT COUNT(*) as min from transaksi_detail_temp, barang, kategori where transaksi_detail_temp_barang_id=barang_id and barang_kategori=kategori_id and kategori_jenis='Minuman' and transaksi_detail_temp_user='$user'");
        $datamin=mysql_fetch_array($sqlmin);
        $min=$datamin['min'];

        $sqlrisol=mysql_query("SELECT COUNT(*) as snack from transaksi_detail_temp, barang, kategori where transaksi_detail_temp_barang_id=barang_id and barang_kategori=kategori_id and kategori_jenis='Snack' and transaksi_detail_temp_user='$user'");
        $datarisol=mysql_fetch_array($sqlrisol);
        $snack=$datarisol['snack'];

        $sqlmin1=mysql_query("SELECT COUNT(*) as makanan from transaksi_detail_temp, barang, kategori where transaksi_detail_temp_barang_id=barang_id and barang_kategori=kategori_id and kategori_jenis='Makanan' and transaksi_detail_temp_user='$user'");
        $datamin1=mysql_fetch_array($sqlmin1);
        $makanan=$datamin1['makanan'];

        $_SESSION['kembalian'] = $kembalian;
        $_SESSION['print'] = 'ya';

        mysql_query("DELETE from transaksi_detail_temp where transaksi_detail_temp_user='$user'");


        echo mysql_error();
		echo ("<script>location.href='../home.php?menu=kembalian&kem=$kembalian&pelanggan=&min=$min&snack=$snack&makanan=$makanan'</script>");
	} 


} elseif(isset($_POST['prosespelanggan'])){
	$nama = $_POST['ip-nama'];
	$meja = $_POST['ip-meja'];	
	$lantai = $_POST['ip-lantai'];		
	$total = $_POST['ip-total'];
	$tipe_bayar = '';
	$diskon = 0;
	$user = $_SESSION['login_user'];

	$jmldiskon = 0;
	
	$tot = 0;

    $bayar=0;
    

    $kembalian = $bayar - $tot;

	$sql = "INSERT INTO transaksi(transaksi_tanggal,transaksi_waktu,transaksi_bulan,transaksi_pelanggan,transaksi_no_meja,transaksi_lantai,transaksi_total,transaksi_diskon,transaksi_bayar,transaksi_type_bayar,transaksi_user)values('$tgl','$wkt','$bln','$nama','$meja','$lantai','$tot','$jmldiskon','$bayar','$tipe_bayar','$user')";
	mysql_query($sql);
	
	$qn= "SELECT MAX( transaksi_id ) AS nota FROM transaksi where transaksi_user='$user'";
    $rn=mysql_query($qn);
    $dn=mysql_fetch_array($rn);
    $no_not = $dn['nota'];
    $_SESSION['no-nota'] = $no_not;	

    $sql="SELECT * from transaksi_detail_temp where transaksi_detail_temp_user='$user'";
    $query=mysql_query($sql);
    while ($data1=mysql_fetch_array($query)) {

    	$barang = $data1['transaksi_detail_temp_barang_id'];
    	$harga = $data1['transaksi_detail_temp_harga'];
    	$jumlah = $data1['transaksi_detail_temp_jumlah'];
    	$total = $data1['transaksi_detail_temp_total'];
    	$ket = $data1['transaksi_detail_temp_keterangan'];
    	$user = $data1['transaksi_detail_temp_user'];

    	$sql = "INSERT INTO transaksi_detail(transaksi_detail_nota,transaksi_detail_barang_id,transaksi_detail_harga,transaksi_detail_jumlah,transaksi_detail_total,transaksi_detail_keterangan,transaksi_detail_user,transaksi_detail_status)values('$no_not','$barang','$harga','$jumlah','$total','$ket','$user','3')";
		$c=mysql_query($sql);

		$sqlkem11="SELECT * from barang where barang_id='$barang'";
        $querykem11=mysql_query($sqlkem11);
        $datakem11=mysql_fetch_array($querykem11);

        if($datakem11['barang_set_stok']!=0) {
        	$jml_stok = $datakem11['barang_stok'] - $jumlah;
        
	        mysql_query("UPDATE barang SET barang_stok='$jml_stok' WHERE barang_id='$barang'");
        }
        
    }

    $_SESSION['kembalian'] = $kembalian;
    $_SESSION['print'] = 'tidak';

    mysql_query("DELETE from transaksi_detail_temp where transaksi_detail_temp_user='$user'");
	
    echo mysql_error();
	echo ("<script>location.href='../home.php?menu=berhasil&pelanggan='</script>");



} elseif(isset($_POST['updatepelanggan'])){
	$nama = $_POST['ip-nama'];
	$meja = $_POST['ip-meja'];	
	$lantai = $_POST['ip-lantai'];		
	$total = $_POST['ip-total'];
	$nota = $_POST['ip-nota'];
	$tipe_bayar = $_POST['ip-tipe-bayar'];
	$potongan = $_POST['ip-potongan'];
	$diskon = $_POST['ip-diskon'];
	$user = $_SESSION['login_user'];

	if ($potongan=='Diskon') {
		$jmldiskon = $total*$diskon/100;
	} else {
		$jmldiskon = $diskon;
	}
	
	$tot = $total - $jmldiskon;

    $text_line = explode(".",$_POST['ip-bayar']);
    $length=count($text_line);
    if ($length==1) {
      $bayar=$text_line[0];
      # code...
    }elseif ($length==2) {
      $bayar=$text_line[0]."".$text_line[1];
      # code...
    }elseif ($length==3) {
      # code...
      $bayar=$text_line[0]."".$text_line[1]."".$text_line[2];
    }elseif ($length==4) {
      # code...
      $bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3];
    }elseif ($length==5) {
      # code...
      $bayar=$text_line[0]."".$text_line[1]."".$text_line[2]."".$text_line[3]."".$text_line[4];
    }

    $kembalian = $bayar - $tot;

	if ($kembalian < 0) {
		# code...
	    echo ("<script>location.href='../home.php?menu=kurang&pelanggan=$nota'</script>");
	} else {

        mysql_query("UPDATE transaksi SET transaksi_waktu='$wkt' ,transaksi_pelanggan='$nama' ,transaksi_no_meja='$meja' ,transaksi_lantai='$lantai' ,transaksi_total='$tot' ,transaksi_diskon='$jmldiskon' ,transaksi_bayar='$bayar' ,transaksi_type_bayar='$tipe_bayar' ,transaksi_user='$user' WHERE transaksi_id='$nota'");

		echo mysql_error();
		
		$_SESSION['no-nota'] = $nota;	

	    $sql="SELECT * from transaksi_detail where transaksi_detail_nota='$nota'";
	    $query=mysql_query($sql);
	    while ($data1=mysql_fetch_array($query)) {

	    	$barang = $data1['transaksi_detail_barang_id'];
	    	$transaksiid = $data1['transaksi_detail_id'];
	    	$status = $data1['transaksi_detail_status'];
	    	

	        mysql_query("UPDATE transaksi_detail SET transaksi_detail_status='1' WHERE transaksi_detail_id='$transaksiid'");
	        
	    }


        $sqlmin=mysql_query("SELECT COUNT(*) as min from transaksi_detail, barang, kategori where transaksi_detail_barang_id=barang_id and barang_kateori=kategori_id and kategori_jenis='Minuman' and transaksi_detail_nota='$tot'");
        $datamin=mysql_fetch_array($sqlmin);
        $min=$datamin['min'];

        $_SESSION['kembalian'] = $kembalian;
        $_SESSION['print'] = 'ya';

		
        echo mysql_error();
		echo ("<script>location.href='../home.php?menu=kembalian&kem=$kembalian&pelanggan=&min=$min'</script>");
	} 

} elseif(isset($_POST['resettransaksi'])){
	$user = $_SESSION['login_user'];

    mysql_query("DELETE from transaksi_detail_temp where transaksi_detail_temp_user='$user'");
	
    echo mysql_error();
	echo ("<script>location.href='../home.php?menu=home&pelanggan='</script>");

} elseif(isset($_POST['ceknota'])){
	$nota = $_POST['ip-nota'];
    $_SESSION['no-nota'] = $nota;	

    echo ("<script>location.href='../home.php?menu=ceknota&nota=$nota&print=tidak&pelanggan='</script>");

} elseif(isset($_POST['validasi'])){

	$omset = $_POST['ip-omset'];
	$user = $_SESSION['login_user'];

	$sql1="SELECT * from users where id='$user'";
	$query1=mysql_query($sql1);
	$data1=mysql_fetch_array($query1);
	$usernama=$data1['name'];

	$sql="SELECT sum(transaksi_total) as jumlah from transaksi where transaksi_tanggal='$tgl' and transaksi_user='$user'";
	$query=mysql_query($sql);
	$data=mysql_fetch_array($query);	


	$sql = "INSERT into validasi(validasi_tanggal,validasi_waktu,validasi_user_id,validasi_user_nama,validasi_jumlah,validasi_omset)values('$tgl','$wkt','$user','$usernama','$omset','$data[jumlah]')";
	mysql_query($sql);
	echo mysql_error();
	$_SESSION['print_nota']='ya';

    echo ("<script>location.href='../home.php?menu=validasi&pelanggan='</script>");

}
?>