<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Stok Barang</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-4 col-lg-4">
        <div class="card">
            <?php
                $id = $_GET['id'];
                $sql="SELECT * from barang where barang_id='$id'";
                $query=mysql_query($sql);
                $data=mysql_fetch_array($query);
                $select="";
            ?>
            <form action="aksi/barang.aksi.php" method="post" class="">
                <input type="hidden" name="barang_id" value="<?php echo $id; ?>">
                <?php
                if ($_GET['ket']=='tambah') {
                ?>
                    <div class="card-header">
                        Input <strong>Stok Barang</strong>
                    </div>
                    <div class="card-body card-block">
                            <div class="form-group">
                                <label class=" form-control-label">Nama Barang</label>
                                <input type="text" id="ip-nama" name="ip-nama" placeholder="" class="form-control" value="<?php echo $data['barang_nama']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Jumlah</label>
                                <input type="text" id="ip-jumlah" name="ip-jumlah" placeholder="" class="form-control" value="">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm" name="inputstok">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </div>
                <?php
                } elseif ($_GET['ket']=='kurang') {
                ?>
                    <div class="card-header">
                        Input <strong>Stok Barang</strong>
                    </div>
                    <div class="card-body card-block">
                            <div class="form-group">
                                <label class=" form-control-label">Nama Barang</label>
                                <input type="text" id="ip-nama" name="ip-nama" placeholder="" class="form-control" value="<?php echo $data['barang_nama']; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Jumlah</label>
                                <input type="text" id="ip-jumlah" name="ip-jumlah" placeholder="" class="form-control" value="">
                            </div>
                            
                            <div class="form-group">
                                <label class=" form-control-label">Ket Dikurangi</label>
                                <textarea name="ip-ket" class="form-control"></textarea>
                            </div>
                            
                    </div>
                    <div class="card-footer">        
                        <button type="submit" class="btn btn-primary btn-sm" name="editstok">
                            <i class="fa fa-dot-circle-o"></i> Edit
                        </button>
                
                    </div>

                <?php
                }
                ?>
                
            </form>
        </div>
    </div>
    <div class="col-sm-8 col-lg-8">
        
        <!-- DATA TABLE -->
        <div class="table-responsive table-responsive-data2">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>nama</th>
                        <th>stok</th>
                        <th>set stok</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql="SELECT * from barang";
                        $query=mysql_query($sql);
                        while ($data=mysql_fetch_array($query)) {
                            if ($data['barang_set_stok']==0) {
                                # code...
                                $ket="Tidak";
                            } else {
                                $ket="Ya";
                            }
                            ?>
                            <tr class="tr-shadow">
                                <td><?php echo $data['barang_nama']; ?></td>
                                <td><?php echo $data['barang_stok']; ?></td>
                                <td><?php echo $ket; ?></td>
                                <td>
                                    <div class="table-data-feature">
                                    <?php
                                        if ($ket=="Ya") {
                                        ?>
                                            <a href="?menu=stok&ket=tambah&id=<?php echo $data['barang_id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Tambah">
                                                <i class="zmdi zmdi-plus"></i>
                                            </a>
                                            <a href="?menu=stok&ket=kurang&id=<?php echo $data['barang_id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Minus">
                                                <i class="zmdi zmdi-minus"></i>
                                            </a>

                                        <?php
                                        }
                                    ?>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>