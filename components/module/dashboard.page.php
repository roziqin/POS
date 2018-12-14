<?php
session_start();
include "../include/koneksi.php";
include "../include/slug.php";
date_default_timezone_set('Asia/jakarta');
$tgl=date('Y-m-j');
$bln=date('Y-m');

$sql="SELECT sum(transaksi_total) as total, count(transaksi_id) as jumlah from transaksi where transaksi_tanggal='$tgl'";
$query=mysql_query($sql);
$data=mysql_fetch_array($query);

?>
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Dashboard</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
<?php 
    if ($role=="admin") {
    ?>
        <div class="col-sm-6 col-lg-6">
            <div class="overview-item overview-item--c1">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-money"></i>
                        </div>
                        <div class="text">
                            <h2>Rp. <?php echo format_rupiah($data['total']); ?></h2>
                            <span>total omset</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="overview-item overview-item--c2">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                        <div class="text">
                            <h2><?php echo $data['jumlah']; ?></h2>
                            <span>jumlah transaksi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    } else {
        # code...
    }
    
?>
    
</div>
<div class="row">
    <div class="col-lg-9">
        <h2 class="title-1 m-b-25">Per Items</h2>
        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning" style="height: 450px;">
                <thead>
                    <tr>
                        <th>tanggal</th>
                        <th>ID</th>
                        <th>nama</th>
                        <th class="text-right">jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT * FROM transaksi, transaksi_detail, barang where transaksi_id=transaksi_detail_nota and transaksi_detail_barang_id=barang_id and transaksi_bulan='$bln' ORDER BY transaksi_detail_id DESC";
                        $query=mysql_query($sql);
                        while ($data=mysql_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $data['transaksi_tanggal']; ?></td>
                                <td><?php echo $data['transaksi_id']; ?></td>
                                <td><?php echo $data['barang_nama']; ?></td>
                                <td class="text-right"><?php echo $data['transaksi_detail_jumlah']; ?></td>
                            </tr>
                        <?php      
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-3">
        <h2 class="title-1 m-b-25">Top 10 Menu</h2>
        <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
            <div class="au-card-inner">
                <div class="table-responsive">
                    <table class="table table-top-countries">
                        <tbody>
                            <?php
                                $sql="SELECT barang_nama, sum(transaksi_detail_jumlah) as jumlah FROM transaksi, transaksi_detail, barang where transaksi_id=transaksi_detail_nota and transaksi_detail_barang_id=barang_id and transaksi_bulan='$bln' GROUP BY barang_id ORDER BY jumlah DESC LIMIT 10";
                                $query=mysql_query($sql);
                                while ($data=mysql_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $data['barang_nama']; ?></td>
                                        <td class="text-right"><?php echo $data['jumlah']; ?></td>
                                    </tr>
                                <?php      
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>