<!-- STATISTIC CHART-->
<section class="statistic-chart">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="pull-left">Menu</h4>
                        <?php
                        if ($_SESSION['role']=='pelanggan') {

                        } else {
                        ?>
                            <div id="notification" class="pull-right"></div>
                        <?php
                        }
                        
                        ?>
                    </div>
                    <div class="card-body">
                    <?php
                        if ($_GET['menu']=='home') {
                            $_SESSION['print']='tidak';
                            $_SESSION['print_nota']='tidak';
                        ?>
                            <div class="default-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <?php
                                        $n=0;
                                        $sql="SELECT * from kategori ORDER BY kategori_jenis";
                                        $query=mysql_query($sql);
                                        while ($data1=mysql_fetch_array($query)) {
                                            if ($n==0) {
                                                $ket='active';
                                                $ket1='true';
                                            } else {
                                                $ket='';
                                                $ket1='false';

                                            }
                                        ?>
                                            <a class="nav-item nav-link <?php echo $ket; ?>" id="nav-<?php echo $data1['kategori_slug']; ?>-tab" data-toggle="tab" href="#nav-<?php echo $data1['kategori_slug']; ?>" role="tab" aria-controls="nav-<?php echo $data1['kategori_slug']; ?>"
                                             aria-selected="<?php echo $ket1; ?>"><?php echo $data1['kategori_nama']; ?></a>
                                        <?php
                                        $n++;

                                        }

                                    ?>
                                    </div>
                                </nav>
                                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                    <?php
                                        $n=0;
                                        $sql="SELECT * from kategori ORDER BY kategori_jenis";
                                        $query=mysql_query($sql);
                                        while ($data1=mysql_fetch_array($query)) {
                                            if ($n==0) {
                                                $ket='show active';
                                            } else {
                                                $ket='';

                                            }
                                        ?>
                                            <div class="tab-pane fade <?php echo $ket; ?>" id="nav-<?php echo $data1['kategori_slug']; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $data1['kategori_slug']; ?>-tab">
                                                <div class="row">
                                                    <?php
                                                        $sqlbarang="SELECT * from barang where barang_kategori='$data1[kategori_id]'";
                                                        $querybarang=mysql_query($sqlbarang);
                                                        while ($databarang=mysql_fetch_array($querybarang)) {
                                                            if ($databarang['barang_set_stok']==0) {
                                                                ?>
                                                                    <div class="col-3">
                                                                        <a href="?menu=jumlah&id=<?php echo $databarang['barang_id']; ?>&nama=<?php echo $databarang['barang_nama']; ?>&ket=" class="list-menu">
                                                                            <div class="card custom">
                                                                                <div class="card-body">
                                                                                    <strong class="card-title"><?php echo $databarang['barang_nama']; ?></strong>
                                                                                </div>
                                                                                <div class="card-footer">
                                                                                    Rp. <?php echo format_rupiah($databarang['barang_harga_jual']); ?><br>
                                                                                    &nbsp;
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>


                                                                <?php
                                                                
                                                            } else {
                                                                if ($databarang['barang_stok']!=0) {
                                                                    if ($databarang['barang_stok']<$databarang['barang_batas_stok']) {
                                                                        $stok_status="warning";
                                                                    } else {
                                                                        $stok_status="";
                                                                    }
                                                                    
                                                                    ?>
                                                                        <div class="col-3">
                                                                        <a href="?menu=jumlah&id=<?php echo $databarang['barang_id']; ?>&nama=<?php echo $databarang['barang_nama']; ?>&ket=" class="list-menu">
                                                                                <div class="card custom <?php echo $stok_status; ?>">
                                                                                    <div class="card-body">
                                                                                        <strong class="card-title"><?php echo $databarang['barang_nama']; ?></strong>
                                                                                    </div>
                                                                                    <div class="card-footer">
                                                                                    Rp. <?php echo format_rupiah($databarang['barang_harga_jual']); ?><br>
                                                                                        <span style="color: red;">Stok: <?php echo $databarang['barang_stok']; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <div class="col-3">
                                                                            <div class="card custom">
                                                                                <div class="card-body">
                                                                                    <strong class="card-title"><?php echo $databarang['barang_nama']; ?></strong>
                                                                                </div>
                                                                                <div class="card-footer">
                                                                                    Rp. <?php echo format_rupiah($databarang['barang_harga_jual']); ?><br>
                                                                                    <span style="color: red;">Stok: Habis</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php
                                                                }
                                                                
                                                            }    
                                                        }
                                                        echo mysql_error();
                                                    ?>
                                                </div>
                                            </div>
                                            
                                        <?php
                                        $n++;
                                        }

                                    ?>
                                </div>

                            </div>
                        <?php
                        } elseif ($_GET['menu']=='jumlah') {
                        ?>
                            <form action="aksi/transaksi.aksi.php" method="post" class="">
                                <input type="hidden" name="ip-barang" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label class="form-control-label"><strong><?php echo $_GET['nama']; ?></strong> <strong style="color: red;"><?php echo $_GET['ket']; ?></strong></label>
                                </div>
                                <div class="form-group">
                                    <label for="ip-jumlah" class=" form-control-label">Jumlah</label>
                                    <input type="text" id="ip-jumlah" name="ip-jumlah" placeholder="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ip-ket" class=" form-control-label">Keterangan</label>
                                    <textarea name="ip-ket" id="textarea-input" rows="4" placeholder="" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right" name="inputmenutemp">
                                            <i class="fa fa-dot-circle-o"></i> Proses
                                        </button>
                                </div>
                            </form>

                        <?php
                        } elseif ($_GET['menu']=='editjumlah') {
                        ?>
                            <form action="aksi/transaksi.aksi.php" method="post" class="">
                                <?php
                                $idtemp = $_GET['id'];
                                $sqla="SELECT * from transaksi_detail_temp, barang where transaksi_detail_temp_barang_id=barang_id and transaksi_detail_temp_id='$idtemp'";
                                $querya=mysql_query($sqla);
                                $dataa=mysql_fetch_array($querya);

                                ?>
                                <input type="hidden" name="ip-temp" value="<?php echo $idtemp; ?>">
                                <input type="hidden" name="ip-barang" value="<?php echo $dataa['barang_id']; ?>">
                                <div class="form-group">
                                    <label class="form-control-label"><strong><?php echo $dataa['barang_nama']; ?></strong>  <strong style="color: red;"><?php echo $_GET['ket']; ?></strong></label>
                                </div>
                                <div class="form-group">
                                    <label for="ip-jumlah" class=" form-control-label">Jumlah</label>
                                    <input type="text" id="ip-jumlah" name="ip-jumlah" placeholder="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ip-ket" class=" form-control-label">Keterangan</label>
                                    <textarea name="ip-ket" id="textarea-input" rows="4" placeholder="" class="form-control"><?php echo $dataa['transaksi_detail_temp_keterangan']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right" name="editmenutemp">
                                            <i class="fa fa-dot-circle-o"></i> Proses
                                        </button>
                                </div>
                            </form>

                        <?php
                        } elseif ($_GET['menu']=='editjumlahpelanggan') {
                        ?>
                            <form action="aksi/transaksi.aksi.php" method="post" class="">
                                <?php
                                $idtemp = $_GET['id'];
                                $sqla="SELECT * from transaksi_detail, barang where transaksi_detail_barang_id=barang_id and transaksi_detail_id='$idtemp'";
                                $querya=mysql_query($sqla);
                                $dataa=mysql_fetch_array($querya);

                                ?>
                                <input type="hidden" name="ip-temp" value="<?php echo $idtemp; ?>">
                                <input type="hidden" name="ip-pelanggan" value="<?php echo $_GET['pelanggan']; ?>">
                                <input type="hidden" name="ip-barang" value="<?php echo $dataa['barang_id']; ?>">
                                <input type="hidden" name="ip-jumlah-detail" value="<?php echo $dataa['transaksi_detail_jumlah']; ?>">
                                <div class="form-group">
                                    <label class="form-control-label"><strong><?php echo $dataa['barang_nama']; ?></strong>  <strong style="color: red;"><?php echo $_GET['ket']; ?></strong></label>
                                </div>
                                <div class="form-group">
                                    <label for="ip-jumlah" class=" form-control-label">Jumlah</label>
                                    <input type="text" id="ip-jumlah" name="ip-jumlah" placeholder="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ip-ket" class=" form-control-label">Keterangan</label>
                                    <textarea name="ip-ket" id="textarea-input" rows="4" placeholder="" class="form-control"><?php echo $dataa['transaksi_detail_temp_keterangan']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right" name="editmenupel">
                                            <i class="fa fa-dot-circle-o"></i> Proses
                                        </button>
                                </div>
                            </form>

                        <?php
                        } elseif ($_GET['menu']=='kurang') {
                        ?>
                            <br><br>
                            <h1 class="text-center">Uang yang diinput kurang!</h1>
                            <br><br>

                        <?php
                        } elseif ($_GET['menu']=='berhasil') {
                        ?>
                            <br><br>
                            <h1 class="text-center">Pemesanan Berhasil</h1>
                            <br><br><br><br>
                            <a href="?menu=home" class="btn btn-primary" style="display: block;margin: 0px auto 30px;max-width: 170px;">Transaksi Baru</a>

                        <?php
                        } elseif ($_GET['menu']=='list_pelanggan') {
                        ?>
                            <style type="text/css">
                                table.custom td a {
                                    display: block;
                                    color: #000000;
                                }
                                table.custom td a:hover {
                                    color: #FFF;
                                    background-color: red;
                                }
                            </style>
                            <h3 class="text-center">List input Pelanggan</h3>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-top-campaign custom">
                                    <thead>
                                        <tr>
                                            <th>Pelanggan</th>
                                            <th>No Meja</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $sql="SELECT * from transaksi WHERE transaksi_bayar='0' ";
                                            $query=mysql_query($sql);
                                            while($data=mysql_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td><a href="?menu=list_pelanggan&pelanggan=<?php echo $data['transaksi_id']; ?>"><?php echo $data['transaksi_pelanggan']; ?></a></td>
                                                    <td><a href="?menu=list_pelanggan&pelanggan=<?php echo $data['transaksi_id']; ?>"><?php echo $data['transaksi_no_meja']; ?></a></td>
                                                    <td></td>
                                                </tr>


                                            <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php
                        } elseif ($_GET['menu']=='kembalian') {
                        ?>
                            <br><br>
                            <h3 class="text-center" style="font-weight: 300;">Kembalian: </h3>
                            <h1 class="text-center">Rp. <?php echo format_rupiah($_GET['kem']); ?></h1>
                            <br><br><br><br>
                            <a href="?menu=home" class="btn btn-primary" style="display: block;margin: 0px auto 30px;max-width: 170px;">Transaksi Baru</a>

                        <?php
                            if ($_SESSION['print']=='ya') {
                                if ($_GET['min']==0 && $_GET['snack']==0 && $_GET['makanan']==0) {                                
                                    ?>

                                        <script type="text/javascript">
                                         windowList = new Array('print/print-nota.php');
                                        i = 0;
                                        windowName = "window";
                                        windowInterval = window.setInterval(function(){
                                          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                          i++;
                                          if(i==windowList.length){
                                            window.clearInterval(windowInterval);
                                          }
                                        },1000);
                                        </script>
                                    <?php
                                } elseif ($_GET['min']!=0 && $_GET['snack']==0 && $_GET['makanan']==0) {                                
                                    ?>

                                        <script type="text/javascript">
                                         windowList = new Array('print/print-nota.php','print/print-bar-print.php');
                                        i = 0;
                                        windowName = "window";
                                        windowInterval = window.setInterval(function(){
                                          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                          i++;
                                          if(i==windowList.length){
                                            window.clearInterval(windowInterval);
                                          }
                                        },1000);
                                        </script>
                                    <?php
                                } elseif ($_GET['min']==0 && $_GET['snack']!=0 && $_GET['makanan']==0) {                                
                                    ?>

                                        <script type="text/javascript">
                                         windowList = new Array('print/print-nota.php','print/print-snack-print.php');
                                        i = 0;
                                        windowName = "window";
                                        windowInterval = window.setInterval(function(){
                                          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                          i++;
                                          if(i==windowList.length){
                                            window.clearInterval(windowInterval);
                                          }
                                        },1000);
                                        </script>
                                    <?php
                                }  elseif ($_GET['min']==0 && $_GET['snack']==0 && $_GET['makanan']!=0) {                                
                                    ?>

                                        <script type="text/javascript">
                                         windowList = new Array('print/print-nota.php','print/print-makanan-print.php');
                                        i = 0;
                                        windowName = "window";
                                        windowInterval = window.setInterval(function(){
                                          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                          i++;
                                          if(i==windowList.length){
                                            window.clearInterval(windowInterval);
                                          }
                                        },1000);
                                        </script>
                                    <?php
                                } elseif ($_GET['min']!=0 && $_GET['snack']!=0 && $_GET['makanan']==0) {                                
                                    ?>

                                        <script type="text/javascript">
                                         windowList = new Array('print/print-nota.php','print/print-bar-print.php','print/print-snack-print.php');
                                        i = 0;
                                        windowName = "window";
                                        windowInterval = window.setInterval(function(){
                                          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                          i++;
                                          if(i==windowList.length){
                                            window.clearInterval(windowInterval);
                                          }
                                        },1000);
                                        </script>
                                    <?php
                                } elseif ($_GET['min']!=0 && $_GET['snack']==0 && $_GET['makanan']!=0) {                                
                                    ?>

                                        <script type="text/javascript">
                                         windowList = new Array('print/print-nota.php','print/print-bar-print.php','print/print-makanan-print.php');
                                        i = 0;
                                        windowName = "window";
                                        windowInterval = window.setInterval(function(){
                                          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                          i++;
                                          if(i==windowList.length){
                                            window.clearInterval(windowInterval);
                                          }
                                        },1000);
                                        </script>
                                    <?php
                                } elseif ($_GET['min']==0 && $_GET['snack']!=0 && $_GET['makanan']!=0) {                                
                                    ?>

                                        <script type="text/javascript">
                                         windowList = new Array('print/print-nota.php','print/print-snack-print.php','print/print-makanan-print.php');
                                        i = 0;
                                        windowName = "window";
                                        windowInterval = window.setInterval(function(){
                                          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                          i++;
                                          if(i==windowList.length){
                                            window.clearInterval(windowInterval);
                                          }
                                        },1000);
                                        </script>
                                    <?php
                                } else {
                                    ?>
                                        <script type="text/javascript">
                                         windowList = new Array('print/print-nota.php','print/print-bar-print.php','print/print-snack-print.php','print/print-makanan-print.php');
                                        i = 0;
                                        windowName = "window";
                                        windowInterval = window.setInterval(function(){
                                          window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                          i++;
                                          if(i==windowList.length){
                                            window.clearInterval(windowInterval);
                                          }
                                        },1000);
                                        </script>
                                    <?php
                                }
                            }
                        } elseif ($_GET['menu']=='validasi') {
                        ?>
                            <br><br>
                            <h3 class="text-center" style="font-weight: 300; margin-bottom: 30px;">Masukkan Jumlah Uang Fisik: </h3>
                            <form action="aksi/transaksi.aksi.php" method="post" class="" style="text-align: center;">
                                <div class="row" style="display: inline-block;">
                                    <div class="form-group" style="display: inline-block; float: left;">
                                        <input type="text" id="ip-omset" name="ip-omset" placeholder="" class="form-control">
                                    </div>
                                    <div class="form-group" style="display: inline-block; float: left; margin-left: 10px;">
                                        <button type="submit" class="btn btn-primary btn-sm" name="validasi">
                                                <i class="fa fa-dot-circle-o"></i> Proses
                                            </button>
                                    </div>
                                </div>
                            </form>

                        <?php
                            if ($_SESSION['print_nota']=='ya') {
                             ?>

                                <script type="text/javascript">
                                 windowList = new Array('print/print-omset.php');
                                i = 0;
                                windowName = "window";
                                windowInterval = window.setInterval(function(){
                                  window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                  i++;
                                  if(i==windowList.length){
                                    window.clearInterval(windowInterval);
                                  }
                                },1000);
                                </script>
                            <?php
                            }
                        } elseif ($_GET['menu']=='ceknota') {
                            $_SESSION['print']='tidak';
                            $_SESSION['print_nota']='tidak';
                        ?>

                            <form action="aksi/transaksi.aksi.php" method="post" class="">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label for="ip-jumlah" class=" form-control-label">No Nota<?php if ($_GET['nota']!=0) { echo ": ".$_GET['nota'];}?></label>
                                            <input type="text" id="ip-nota" name="ip-nota" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label style="display: block;">&nbsp;</label>
                                            <button type="submit" class="btn btn-primary btn-sm" name="ceknota">
                                                    <i class="fa fa-dot-circle-o"></i> Proses
                                                </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        <?php
                            if ($_GET['nota']!=0) {
                                $nota = $_GET['nota'];
                                $sqlnot="SELECT * FROM transaksi where transaksi_id='$nota' ";
                                $querynot=mysql_query($sqlnot);
                                $datanot=mysql_fetch_array($querynot);
                                echo mysql_error();
                                ?>
                                    <div class="row form-group">
                                        <div class="col-4">Pelanggan: <?php echo $datanot['transaksi_pelanggan']; ?></div>
                                        <div class="col-4">No Meja: <?php echo $datanot['transaksi_no_meja']; ?></div>
                                        <div class="col-4">Lantai: <?php echo $datanot['transaksi_lantai']; ?></div>
                                    </div>
                                    <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th style="text-align: right;">Harga</th>
                                                <th style="text-align: right;">Jumlah</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                $sql="SELECT * FROM transaksi, transaksi_detail, barang where transaksi_id=transaksi_detail_nota and transaksi_detail_barang_id=barang_id and transaksi_id='$nota' ";
                                $query=mysql_query($sql);
                                while ($data1=mysql_fetch_array($query)) {
                                    $tot = $data1['transaksi_total'];
                                    $dis = $data1['transaksi_diskon'];
                                ?>
                                    <tr>
                                        <td><?php echo $data1['barang_nama']; ?></td>
                                        <td style="text-align: right;">Rp. <?php echo format_rupiah($data1['transaksi_detail_harga']); ?></td>
                                        <td style="text-align: right;"><?php echo $data1['transaksi_detail_jumlah']; ?></td>
                                        <td>Rp. <?php echo format_rupiah($data1['transaksi_detail_total']); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                        </tbody>
                                    </table>
                                    <table class="table table-borderless table-data3">
                                        <tbody>
                                            <tr>
                                                <td colspan="3" style="border-top: 2px solid #000;">Subtotal</td>
                                                <td style="border-top: 2px solid #000;">Rp. <?php echo format_rupiah($dis+$tot); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Diskon</td>
                                                <td>Rp. <?php echo format_rupiah($dis); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Total</td>
                                                <td>Rp. <?php echo format_rupiah($tot); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <a href="?menu=ceknota&nota=<?php echo $_GET['nota']; ?>&print=ya" class="btn btn-primary btn-sm pull-right">Print Ulang</a>
                                </div>
                                <?php
                                if ($_GET['print']=='ya') {
                                ?>

                                    <script type="text/javascript">
                                     windowList = new Array('print/print-nota.php');
                                    i = 0;
                                    windowName = "window";
                                    windowInterval = window.setInterval(function(){
                                      window.open(windowList[i],windowName+i,'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,titlebar=no');
                                      i++;
                                      if(i==windowList.length){
                                        window.clearInterval(windowInterval);
                                      }
                                    },1000);
                                    </script>
                                <?php
                                }
                            }
                        }
                        
                    ?>
                    </div>
                </div>
            </div>
            <div class="col-4">

                <div class="card">
                    <div class="card-header">
                        <h4>List Transaksi</h4>
                    </div>
                    <form action="aksi/transaksi.aksi.php" method="post" class="">
                    <?php
                        if ($_GET['pelanggan']!=0) {
                        ?>

                            <div class="card-body">
                                <table class="table table-top-campaign">
                                    <tbody>
                                    <?php
                                        $tot=0;
                                        $pel = $_GET['pelanggan'];
                                        $sql="SELECT * from transaksi_detail, barang where transaksi_detail_barang_id=barang_id and transaksi_detail_nota='$pel' ORDER BY transaksi_detail_id";
                                        $query=mysql_query($sql);
                                        while ($data1=mysql_fetch_array($query)) {
                                            if ($data1['transaksi_detail_keterangan']!=0) {
                                                $ket = '- '.$data1['transaksi_detail_keterangan'];
                                            } else {
                                                $ket = '';
                                            }
                                            
                                        ?>
                                            <tr>
                                                <td><?php echo $data1['barang_nama']; ?><br><?php echo $ket; ?></td>
                                                <td width="20px"><?php echo $data1['transaksi_detail_jumlah']; ?></td>
                                                <td width="100px">Rp. <?php echo format_rupiah($data1['transaksi_detail_total']); ?></td>
                                                <td>
                                                    <a href="?menu=editjumlahpelanggan&id=<?php echo $data1['transaksi_detail_id']; ?>&ket=&pelanggan=<?php echo $pel; ?>" style="margin-right: 10px;"><i class="zmdi zmdi-edit"></i></a>

                                                    <!--<a href="aksi/hapus.aksi.php?id=<?php echo $data1['transaksi_detail_id']; ?>&ket=transaksi_menu_pelanggan&pelanggan=<?php echo $pel; ?>" >
                                                        <i class="zmdi zmdi-delete"></i>-->
                                                </td>
                                            </tr>

                                        <?php
                                        $tot+=$data1['transaksi_detail_total'];
                                        }


                                        $sqlpel="SELECT * from transaksi where  transaksi_id='$pel' ";
                                        $querypel=mysql_query($sqlpel);
                                        $datapel=mysql_fetch_array($querypel);
                                    ?>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="form-group">
                                    <input type="text" id="ip-nama" name="ip-nama" placeholder="Nama Pelanggan" class="form-control" value="<?php echo $datapel['transaksi_pelanggan']; ?>">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" id="ip-meja" name="ip-meja" placeholder="No Meja" class="form-control" value="<?php echo $datapel['transaksi_no_meja']; ?>">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" id="ip-lantai" name="ip-lantai" placeholder="Lantai" class="form-control"  value="<?php echo $datapel['transaksi_lantai']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    Total + tax: <br>
                                    <h1 class="pb-2 display-4">Rp. <?php echo format_rupiah($tot); ?></h1>
                                    <input type="hidden" name="ip-total" value="<?php echo $tot; ?>">
                                    <input type="hidden" name="ip-nota" value="<?php echo $_GET['pelanggan']; ?>">
                                </div>

                                <div class="form-group">
                                    <input type="text" id="price" name="ip-bayar" placeholder="Jumlah Uang" class="form-control">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="ip-tipe-bayar">
                                        <option value="Cash">Cash</option>
                                        <option value="Debet">Debet</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-5">
                                            <select class="form-control" name="ip-potongan">
                                                <option value="Diskon">Diskon</option>
                                                <option value="Potongan">Potongan</option>
                                            </select>
                                        </div>
                                        <div class="col-7">
                                            <input type="text" name="ip-diskon" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm pull-right" name="updatepelanggan">
                                    <i class="fa fa-dot-circle-o"></i> Proses
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm" name="resettransaksi">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                            </div>


                        <?php
                        } else {
                        ?>
                            <div class="card-body">
                                <table class="table table-top-campaign">
                                    <tbody>
                                    <?php
                                        $tot=0;
                                        $user = $_SESSION['login_user'];
                                        $sql="SELECT * from transaksi_detail_temp, barang where transaksi_detail_temp_barang_id=barang_id and transaksi_detail_temp_user='$user' ORDER BY transaksi_detail_temp_id";
                                        $query=mysql_query($sql);
                                        while ($data1=mysql_fetch_array($query)) {
                                            if ($data1['transaksi_detail_temp_keterangan']!=0) {
                                                $ket = '- '.$data1['transaksi_detail_temp_keterangan'];
                                            } else {
                                                $ket = '';
                                            }
                                            
                                        ?>
                                            <tr>
                                                <td><?php echo $data1['barang_nama']; ?><br><?php echo $ket; ?></td>
                                                <td width="20px"><?php echo $data1['transaksi_detail_temp_jumlah']; ?></td>
                                                <td width="100px">Rp. <?php echo format_rupiah($data1['transaksi_detail_temp_total']); ?></td>
                                                <td>
                                                    <a href="?menu=editjumlah&id=<?php echo $data1['transaksi_detail_temp_id']; ?>&ket="><i class="zmdi zmdi-edit" style="margin-right: 10px;"></i></a>
                                                    <a href="aksi/hapus.aksi.php?id=<?php echo $data1['transaksi_detail_temp_id']; ?>&ket=transaksi_menu" >
                                                        <i class="zmdi zmdi-delete"></i>
                                                </td>
                                            </tr>

                                        <?php
                                            $tot+=$data1['transaksi_detail_temp_total'];
                                            $tax1 = $tot*0.1;
                                            $tax = format_rupiah($tot*0.1);
      
                                            $text_line = explode(".",$tax);
                                            $length=count($text_line);


                                            if($tot==0) {
                                                $tax2 = 0;
                                            }else {
                                                if ($length==1) {
                                                  if ($text_line[0]== 0) {
                                                    # code...
                                                    

                                                    $tax2="000";
                                                    
                                                  } elseif ($text_line[0]<=500) {
                                                    # code...
                                                    $tax2 = 500;
                                                    
                                                  } else {
                                                    # code...
                                                    $tax2 = 1000;
                                                    
                                                  }
                                                  # code...
                                                }elseif ($length==2) {
                                                  if ($text_line[1]== 0) {
                                                    # code...
                                                    

                                                    $tax2=$text_line[0]."000";
                                                    
                                                  } elseif ($text_line[1]<= 500) {
                                                    # code...
                                                    $n = 500;

                                                    $tax2=$text_line[0]."".$n;
                                                    
                                                  } else {
                                                    # code...
                                                    $n = 000;

                                                    $tax2=($text_line[0]+1)."000";
                                                    
                                                  }
                                                  # code...
                                                }elseif ($length==3) {
                                                  if ($text_line[2]== 0) {
                                                    # code...
                                                    

                                                    $tax2=$text_line[0]."".$text_line[1]."000";
                                                    
                                                  } elseif ($text_line[2]<= 500) {
                                                    # code...
                                                    $n = 500;

                                                    $tax2=$text_line[0]."".$text_line[1]."".$n;
                                                    
                                                  } else {
                                                    # code...
                                                    $n = 000;

                                                    $tax2=$text_line[0]."".($text_line[1]+1)."000";
                                                    
                                                  }
                                                  # code...
                                                }

                                            }
                                            $total = format_rupiah($tot + $tax2);
                                            $total1 = $tot + $tax2;
                                            if ($tot=='') {
                                                    $tax = 0;
                                                    $total = 0;
                                                    $tax2 = 0;
                                                    $total1 = 0;
                                            } else {
                                                $tax = format_rupiah($tax2);
                                            }
                                        }

                                    ?>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="form-group">
                                    <input type="text" id="ip-nama" name="ip-nama" placeholder="Nama Pelanggan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" id="ip-meja" name="ip-meja" placeholder="No Meja" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" id="ip-lantai" name="ip-lantai" placeholder="Lantai" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    Total + tax: <br>
                                    <h1 class="pb-2 display-4">Rp. <span id="display_tot"><?php echo $total; ?></span></h1>
                                    <input type="hidden" name="ip-total" id="ip-total" value="<?php echo $tot; ?>">
                                    <input type="hidden" name="ip-tax" id="ip-tax" value="<?php echo $tax2; ?>">
                                </div>
                                <?php
                                if ($_SESSION['role']=='pelanggan') {

                                } else {
                                ?>

                                    <div class="form-group">
                                        <input type="text" id="price" name="ip-bayar" placeholder="Jumlah Uang" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="ip-tipe-bayar"  id="ip-tipe-bayar">
                                            <option value="Cash">Cash</option>
                                            <option value="Debet">Debet</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-5">
                                                <select class="form-control" name="ip-potongan" id="ip-potongan">
                                                    <option value="Diskon">Diskon</option>
                                                    <option value="Potongan">Potongan</option>
                                                </select>
                                            </div>
                                            <div class="col-7">
                                                <input type="text" name="ip-diskon" id="ip-diskon" placeholder="" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                

                                ?>
                            </div>
                            <div class="card-footer">
                                <?php
                                if ($_SESSION['role']=='pelanggan') {
                                ?>
                                    <button type="submit" class="btn btn-primary btn-sm pull-right" name="prosespelanggan">
                                        <i class="fa fa-dot-circle-o"></i> Proses
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button type="submit" class="btn btn-primary btn-sm pull-right" name="prosestransaksi">
                                        <i class="fa fa-dot-circle-o"></i> Proses
                                    </button>
                                <?php
                                }
                                ?>
                                <button type="reset" class="btn btn-danger btn-sm" name="resettransaksi">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                            </div>

                        <?php
                        }
                    ?>
                    
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- END STATISTIC CHART-->

