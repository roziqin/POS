<?php
date_default_timezone_set('Asia/jakarta');
$bln=date('Y-m');
?>
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Laporan Penjualan</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-12 col-lg-12">
        
        <!-- DATA TABLE -->
        <form action="aksi/laporan.aksi.php" method="post" class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="rs-select2--light rs-select2--md">
                    <select class="form-control" name="jenis_laporan" onchange="HideLap(this.value);">
                        <option value="" selected="selected">Pilih Laporan</option>
                        <option value="omset">Omset</option>
                        <option value="kasir">Kasir</option>
                        <option value="menu">Menu</option>
                    </select>
                </div>
                <div class="rs-select2--light rs-select2--md">
                    <select class="form-control" name="waktu_laporan" onchange="Hide(this.value);">
                        <option value="" selected="selected">Pilih Waktu</option>
                        <option value="harian">Harian</option>
                        <option value="bulanan">Bulanan</option>
                    </select>
                </div>
                <div id="kasir" style="display: none;">
                    <div class="rs-select2--light rs-select2--md">
                        <select class="form-control" name="kasir">
                            <option value="" selected="selected">Pilih Kasir</option>
                            <?php
                            $sql="SELECT * from users";
                            $query=mysql_query($sql);
                            while($data=mysql_fetch_array($query)) {
                                echo "<option value='".$data['id']."'>".$data['name']."</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div id="menu" style="display: none;">
                    <div class="rs-select2--light rs-select2--md">
                        <select class="form-control" name="menu">
                            <option value="" selected="selected">Pilih Menu</option>
                            <?php
                            $sql="SELECT * from barang";
                            $query=mysql_query($sql);
                            while($data=mysql_fetch_array($query)) {
                                echo "<option value='".$data['barang_id']."'>".$data['barang_nama']."</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div id="harian" style="display: none;">
                    <div class="rs-select2--light">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="reservation" name="tanggal_harian">
                        </div>
                    </div>
                </div>
                <div id="bulanan" style="display: none;">
                    <div class="rs-select2--light rs-select2--md">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control" id="month1" name="bulan1" value="<?php echo $bln; ?>">
                        </div>
                    </div>
                    <div class="rs-select2--light rs-select2--sm" style="text-align: center;">
                        Sampai
                    </div>
                    <div class="rs-select2--light rs-select2--md">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control" id="month2" name="bulan2" value="<?php echo $bln; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-data__tool-right">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small" name="proses">
                    proses</button>
            </div>
        </form>
        
        <div class="table-responsive table-responsive-data2">
        <?php
            if ($_GET['jenis']=='omset') {
            ?>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>tanggal</th>
                            <th>omset</th>
                            <th>diskon</th>
                            <th>omset bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $text_line = explode(":",$_GET['date']);
                            $tgl11=$text_line[0];
                            $tgl22=$text_line[1];

                            if ($_GET['waktu']=="harian") {
                                $ket = "transaksi_tanggal"; 
                            } elseif ($_GET['waktu']=="bulanan") {
                                $ket = "transaksi_bulan";     
                            }
                            

                            $sql="SELECT transaksi_tanggal, transaksi_bulan, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon from transaksi WHERE $ket BETWEEN '$tgl11' AND '$tgl22' GROUP BY $ket  ";
                            $query=mysql_query($sql);
                            echo mysql_error();
                            while ($data=mysql_fetch_array($query)) {
                            ?>
                                <tr class="tr-shadow">
                                    <td><?php echo $data[$ket]; ?></td>
                                    <td><?php echo $data['total']+$data['diskon']; ?></td>
                                    <td><?php echo $data['diskon']; ?></td>
                                    <td><?php echo $data['total']; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            } elseif ($_GET['jenis']=='kasir') {
            $kasir = $_GET['data'];
            $text_line = explode(":",$_GET['date']);
            $tgl11=$text_line[0];
            $tgl22=$text_line[1];

            if ($kasir==0) {
                $text1 = '';
                $text2 = ', transaksi_user';
            } else {
                $text1 = 'transaksi_user='.$kasir.' and ';
                $text2 = '';


                $sql="SELECT * from users where id='$kasir'";
                $query=mysql_query($sql);
                $data=mysql_fetch_array($query);
                echo "<h3>".$data['name']."</h3><br>";
            }
            

            
            ?>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>tanggal</th>
                            <th>kasir</th>
                            <th>omset</th>
                            <th>diskon</th>
                            <th>omset bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if ($_GET['waktu']=="harian") {
                                $ket = "transaksi_tanggal"; 
                            } elseif ($_GET['waktu']=="bulanan") {
                                $ket = "transaksi_bulan";     
                            }
                            

                            $sql="SELECT transaksi_tanggal, transaksi_bulan, sum(transaksi_total) as total, sum(transaksi_diskon) as diskon, transaksi_user, id, name from transaksi, users WHERE transaksi_user=id and $text1 $ket BETWEEN '$tgl11' AND '$tgl22' GROUP BY $ket $text2 ";
                            $query=mysql_query($sql);
                            echo mysql_error();
                            while ($data=mysql_fetch_array($query)) {
                            ?>
                                <tr class="tr-shadow">
                                    <td><?php echo $data[$ket]; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['total']+$data['diskon']; ?></td>
                                    <td><?php echo $data['diskon']; ?></td>
                                    <td><?php echo $data['total']; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            } elseif ($_GET['jenis']=='menu') {
            $menu = $_GET['data'];
            $text_line = explode(":",$_GET['date']);
            $tgl11=$text_line[0];
            $tgl22=$text_line[1];

            if ($menu==0) {
                $text1 = '';
                $text2 = ', barang_id';
            } else {
                $text1 = 'barang_id='.$menu.' and ';
                $text2 = '';


            }
            
            ?>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>tanggal</th>
                            <th>menu</th>
                            <th>jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            if ($_GET['waktu']=="harian") {
                                $ket = "transaksi_tanggal"; 
                            } elseif ($_GET['waktu']=="bulanan") {
                                $ket = "transaksi_bulan";     
                            }
                            

                            $sql="SELECT transaksi_tanggal, transaksi_bulan, barang_nama, barang_id, sum(transaksi_detail_jumlah) as jumlah from transaksi, transaksi_detail, barang WHERE transaksi_id=transaksi_detail_nota and transaksi_detail_barang_id=barang_id and $text1 $ket BETWEEN '$tgl11' AND '$tgl22' GROUP BY $ket $text2 ";
                            $query=mysql_query($sql);
                            echo mysql_error();
                            while ($data=mysql_fetch_array($query)) {
                            ?>
                                <tr class="tr-shadow">
                                    <td><?php echo $data[$ket]; ?></td>
                                    <td><?php echo $data['barang_nama']; ?></td>
                                    <td><?php echo $data['jumlah']; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                
            <?php
            }
            
        ?>
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>

<script type="text/javascript">
    function Hide(val) {
        if(val=="harian") {
            document.getElementById('harian').style.display='inline-block';
            document.getElementById('bulanan').style.display='none';
        } else if (val=="bulanan") {
            document.getElementById('harian').style.display='none';
            document.getElementById('bulanan').style.display='inline-block';
        } else {
            document.getElementById('harian').style.display='none';
            document.getElementById('bulanan').style.display='none';
        }
    }

    function HideLap(val) {
        if(val=="kasir") {
            document.getElementById('kasir').style.display='inline-block';
            document.getElementById('menu').style.display='none';
        } else if (val=="menu") {
            document.getElementById('kasir').style.display='none';
            document.getElementById('menu').style.display='inline-block';
        } else {
            document.getElementById('kasir').style.display='none';
            document.getElementById('menu').style.display='none';
        }
    }
</script>