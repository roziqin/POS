<?php  
session_start();
include "include/koneksi.php";  

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dapur</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

   
    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link href="css/custom.css" rel="stylesheet" media="all">

</head>

<body style="background-color: #fff8dc;">
    <div class="page-wrapper" id="dp">
        <div >
            <div style="background-color: #000000; height: 100%; width: 2px; left: calc(50% - 1px); position: fixed; bottom: 0px; top: 0px;"></div>
            <div class="container" style="max-width: 100%!important">
                <div class="row">
                    <div class="col-6" style="height: 100vh; overflow: auto; padding-bottom: 50px;">
                        <h3 style="text-align: center; padding-top: 30px;">Proses</h3>
                        <ul class="dapur">
                        <?php
                            $sql = "SELECT count(transaksi_detail_status) as jumlah, transaksi_id, transaksi_pelanggan, transaksi_no_meja, transaksi_lantai, transaksi_detail_nota FROM transaksi,transaksi_detail WHERE transaksi_id=transaksi_detail_nota AND transaksi_detail_status='1' GROUP BY transaksi_detail_nota ORDER BY transaksi_tanggal, transaksi_waktu ASC";
                            $query=mysql_query($sql);
                            echo mysql_error();
                            while ($data=mysql_fetch_array($query)) {
                                if($data['jumlah']>0){
                                ?>
                                    <li class="list-dapur">
                                        <span>Nama: <?php echo $data['transaksi_pelanggan']; ?></span> <span style="float: right;">Meja: <?php echo $data['transaksi_no_meja']; ?></span>
                                        <br>
                                        <span>No Nota: <b style="font-size: 20px;"><?php echo $data['transaksi_id']; ?></b></span> <span style="float: right;">Lantai: <?php echo $data['transaksi_lantai']; ?></span>
                                        <table>
                                            <tr>
                                                <th>Menu</th>
                                                <th style='text-align: right;'>Jumlah</th>
                                            </tr>
                                            <?php
                                                $sql1 = "SELECT * FROM transaksi_detail, barang WHERE barang_id=transaksi_detail_barang_id AND transaksi_detail_status='1' and transaksi_detail_nota='$data[transaksi_detail_nota]'";
                                                $query1=mysql_query($sql1);
                                                echo mysql_error();
                                                while ($data1=mysql_fetch_array($query1)) {

                                                    echo "
                                                        <tr>
                                                            <td><a href='aksi/dapur.aksi.php?menu=update&id=".$data1['transaksi_detail_id']."'>".$data1['barang_nama']."</a></td>
                                                            <td style='text-align: right;'><a href='aksi/dapur.aksi.php?menu=update&id=".$data1['transaksi_detail_id']."'>".$data1['transaksi_detail_jumlah']."</a></td>
                                                        </tr>
                                                    ";

                                                }


                                            ?>
                                        </table>
                                    </li>


                                <?php
                                }
                            }
                            
                        ?>
                        </ul>
                    </div>
                    <div class="col-6" style="height: 100vh; overflow: auto; padding-bottom: 50px;">
                        <h3 style="text-align: center; padding-top: 30px;">Selesai</h3>
                        <ul class="dapur">
                        <?php
                            $sql = "SELECT count(transaksi_detail_status) as jumlah, transaksi_id, transaksi_pelanggan, transaksi_no_meja, transaksi_lantai, transaksi_detail_nota FROM transaksi,transaksi_detail WHERE transaksi_id=transaksi_detail_nota AND transaksi_detail_status='2' GROUP BY transaksi_detail_nota ORDER BY transaksi_tanggal, transaksi_waktu ASC";
                            $query=mysql_query($sql);
                            echo mysql_error();
                            while ($data=mysql_fetch_array($query)) {
                                if($data['jumlah']>0){
                                ?>
                                    <li class="list-dapur">
                                        <span>Nama: <?php echo $data['transaksi_pelanggan']; ?></span> <span style="float: right;">Meja: <?php echo $data['transaksi_no_meja']; ?></span>
                                        <br>
                                        <span>No Nota: <b style="font-size: 20px;"><?php echo $data['transaksi_id']; ?></b></span> <span style="float: right;">Lantai: <?php echo $data['transaksi_lantai']; ?></span>
                                        <table class="custom">
                                            <tr>
                                                <th>Menu</th>
                                                <th style='text-align: right;'>Jumlah</th>
                                            </tr>
                                            <?php
                                                $sql1 = "SELECT * FROM transaksi_detail, barang WHERE barang_id=transaksi_detail_barang_id AND transaksi_detail_status='2' and transaksi_detail_nota='$data[transaksi_detail_nota]'";
                                                $query1=mysql_query($sql1);
                                                echo mysql_error();
                                                while ($data1=mysql_fetch_array($query1)) {

                                                    echo "
                                                        <tr>
                                                            <td><a href='aksi/dapur.aksi.php?menu=close&id=".$data1['transaksi_detail_id']."'>".$data1['barang_nama']."</a></td>
                                                            <td style='text-align: right;'><a href='aksi/dapur.aksi.php?menu=close&id=".$data1['transaksi_detail_id']."'>".$data1['transaksi_detail_jumlah']."</a></td>
                                                        </tr>
                                                    ";

                                                }


                                            ?>
                                        </table>
                                    </li>


                                <?php
                                }
                            }
                            
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){ 

       setInterval(function(){ 
        $.ajax({url: "dapur_kontent.php", success: function(result){
            $("#dp").html(result);
        }});
      }, 3000);
    });
    </script>
</body>

</html>
<!-- end document-->