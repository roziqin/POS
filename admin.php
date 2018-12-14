<?php include "components/header.php"; ?>

<?php include "components/sidebar.php"; ?>
        
<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- MAIN CONTENT-->
    <div class="main-content" style="padding-top: 40px;">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <?php
                    $_SESSION['print']='tidak';
                    $_SESSION['print_nota']='tidak';
                    date_default_timezone_set('Asia/jakarta');
                    if ($_GET['menu']=='home') {

                        include "components/module/dashboard.page.php";

                    } elseif ($_GET['menu']=='barang') {

                        include "components/module/barang.page.php";

                    } elseif ($_GET['menu']=='category') {

                        include "components/module/kategori.page.php";

                    } elseif ($_GET['menu']=='stok') {

                        include "components/module/stok.page.php";

                    } elseif ($_GET['menu']=='log') {

                        include "components/module/log.page.php";

                    } elseif ($_GET['menu']=='laporan') {

                        include "components/module/laporan.page.php";

                    } elseif ($_GET['menu']=='user') {

                        include "components/module/user.page.php";

                    }



                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <!--<p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
</div>
<?php include "components/footer.php"; ?>