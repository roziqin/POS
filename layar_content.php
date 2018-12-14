<?php  
session_start();
include "include/koneksi.php";  

?>
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
                                        <span>No: <b style="font-size: 80px; color: red;"><?php echo $data['transaksi_id']; ?></b></span>
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

                                $sql1 = "SELECT count(transaksi_detail_status) as jumlah FROM transaksi_detail WHERE transaksi_detail_nota='$data[transaksi_id]' ";
                                $query1=mysql_query($sql1);
                                $data1=mysql_fetch_array($query1);
                                if($data['jumlah']==$data1['jumlah']){
                                ?>
                                    <li class="list-dapur">
                                        <span>No: <b style="font-size: 80px;"><?php echo $data['transaksi_id']; ?></b></span>
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

<!-- end document-->