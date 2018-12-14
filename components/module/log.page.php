<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Log</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-12 col-lg-12">
        
        <!-- DATA TABLE -->
        <form action="aksi/laporan.aksi.php" method="post" class="table-data__tool">
            <input type="hidden" name="ket_log" value="<?php echo $_GET['ket']; ?>">
            <div class="table-data__tool-left">
                <div id="harian" style="">
                    <div class="rs-select2--light">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="reservation" name="tanggal_harian">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-data__tool-right">
                <button class="au-btn au-btn-icon au-btn--green au-btn--small" name="log">
                    proses</button>
            </div>
        </form>
        <div class="table-responsive table-responsive-data2">
        <?php
            $text_line = explode(":",$_GET['waktu']);
            $tgl11=$text_line[0];
            $tgl22=$text_line[1];

            if ($_GET['ket']=='login'&&$_GET['waktu']!='') {
            ?>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>nama</th>
                            <th>tanggal login</th>
                            <th>tanggal logout</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql="SELECT * from log_user, users where user=id and login BETWEEN '$tgl11%' AND '$tgl22%' ORDER BY log_id asc";
                            $query=mysql_query($sql);
                            while ($data=mysql_fetch_array($query)) {
                            ?>
                                <tr class="tr-shadow">
                                    <td><?php echo $data['name']; ?></td>
                                    <td><?php echo $data['login']; ?></td>
                                    <td><?php echo $data['logout']; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            } elseif ($_GET['ket']=='validasi'&&$_GET['waktu']!='') {
            ?>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>tanggal</th>
                            <th>waktu</th>
                            <th>nama</th>
                            <th>uang fisik</th>
                            <th>omset</th>
                            <th>selisih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql="SELECT * from  validasi WHERE validasi_tanggal BETWEEN '$tgl11' AND '$tgl22' ORDER BY validasi_id asc";
                            $query=mysql_query($sql);
                            while ($data=mysql_fetch_array($query)) {
                            ?>
                                <tr class="tr-shadow">
                                    <td><?php echo $data['validasi_tanggal']; ?></td>
                                    <td><?php echo $data['validasi_waktu']; ?></td>
                                    <td><?php echo $data['validasi_user_nama']; ?></td>
                                    <td>Rp. <?php echo format_rupiah($data['validasi_jumlah']); ?></td>
                                    <td>Rp. <?php echo format_rupiah($data['validasi_omset']); ?></td>
                                    <td>Rp. <?php echo format_rupiah($data['validasi_jumlah']-$data['validasi_omset']); ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            } elseif ($_GET['ket']=='harga'&&$_GET['waktu']!='') {
            ?>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>tanggal</th>
                            <th>nama</th>
                            <th>harga beli awal</th>
                            <th>harga beli baru</th>
                            <th>harga jual awal</th>
                            <th>harga jual baru</th>
                            <th>user</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql="SELECT * from barang, log_harga, users where barang.barang_id=log_harga.barang_id and user=id and tanggal BETWEEN '$tgl11' AND '$tgl22' ORDER BY log_id asc";
                            $query=mysql_query($sql);
                            while ($data=mysql_fetch_array($query)) {
                            ?>
                                <tr class="tr-shadow">
                                    <td><?php echo $data['tanggal']; ?></td>
                                    <td><?php echo $data['barang_nama']; ?></td>
                                    <td><?php echo $data['harga_beli_awal']; ?></td>
                                    <td><?php echo $data['harga_beli_baru']; ?></td>
                                    <td><?php echo $data['harga_jual_awal']; ?></td>
                                    <td><?php echo $data['harga_jual_baru']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            } elseif ($_GET['ket']=='stok'&&$_GET['waktu']!='') {
            ?>
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>tanggal</th>
                            <th>nama</th>
                            <th>stok awal</th>
                            <th>stok akhir</th>
                            <th>keterangan</th>
                            <th>user</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $sql="SELECT * from barang, log_stok, users where barang_id=barang and user=id and tanggal BETWEEN '$tgl11' AND '$tgl22' ORDER BY log_id asc";
                            $query=mysql_query($sql);
                            while ($data=mysql_fetch_array($query)) {
                            ?>
                                <tr class="tr-shadow">
                                    <td><?php echo $data['tanggal']; ?></td>
                                    <td><?php echo $data['barang_nama']; ?></td>
                                    <td><?php echo $data['stok_awal']; ?></td>
                                    <td><?php echo $data['stok_jumlah']; ?></td>
                                    <td><?php echo $data['alasan']; ?></td>
                                    <td><?php echo $data['name']; ?></td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            
        ?>
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>