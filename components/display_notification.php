<div class="noti__item">
    <a href="?menu=list_pelanggan">
        <i class="zmdi zmdi-notifications"></i>
        <?php
            include "../include/koneksi.php";

            $sql="SELECT count(*) as jumlah from transaksi WHERE transaksi_bayar='0' ";
            $query=mysql_query($sql);
            $data=mysql_fetch_array($query);
        ?>
        <span class="quantity"><?php echo $data['jumlah']; ?></span>
    </a>
</div>