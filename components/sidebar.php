<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="">
                    <a href="?menu=home">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="home.php?menu=home">
                        <i class="fas fa-user"></i>Transaksi</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-folder"></i>Barang</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <?php if ($_SESSION['role']=="admin") { ?>
                        <li>
                            <a href="?menu=barang&id=0">List Barang</a>
                        </li>
                        <li>
                            <a href="?menu=category&id=0">Category</a>
                        </li>
                    <?php } ?>
                        <li>
                            <a href="?menu=stok&ket=&id=0">Stok</a>
                        </li>
                    </ul>
                </li>
            <?php if ($_SESSION['role']=="admin") { ?>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-hdd-o"></i>Log</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="?menu=log&ket=harga&waktu=">Log Harga</a>
                        </li>
                        <li>
                            <a href="?menu=log&ket=stok&waktu=">Log Stok</a>
                        </li>
                        <li>
                            <a href="?menu=log&ket=login&waktu=">Log Login</a>
                        </li>
                        <li>
                            <a href="?menu=log&ket=validasi&waktu=">Log Validasi</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="?menu=laporan&ket=penjualan&jenis=&waktu=&date=&data=">
                        <i class="fas fa-chart-bar"></i>Laporan</a>
                </li>
                <li>
                    <a href="?menu=user&id=0">
                        <i class="fas fa-user"></i>Users</a>
                </li>
            <?php } ?>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-in-alt"></i>Logout</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->