<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Barang</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-4 col-lg-4">
        <div class="card">
            <?php
                $id = $_GET['id'];
                $sql="SELECT * from barang, kategori where barang_kategori=kategori_id and barang_id='$id'";
                $query=mysql_query($sql);
                $data=mysql_fetch_array($query);
                $select="";
            ?>
            <form action="aksi/barang.aksi.php" method="post" class="">
                <input type="hidden" name="barang_id" value="<?php echo $id; ?>">
                <div class="card-header">
                    Input <strong>Barang</strong>
                </div>
                <div class="card-body card-block">
                        <div class="form-group">
                            <label class=" form-control-label">Nama Barang</label>
                            <input type="text" id="ip-nama" name="ip-nama" placeholder="" class="form-control" value="<?php echo $data['barang_nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Kategori</label>
                            <select name="ip-kategori" id="ip-kategori" class="form-control">
                            <?php
                                $sql="SELECT * from kategori";
                                $query=mysql_query($sql);
                                while ($data1=mysql_fetch_array($query)) {
                                    if ($data['kategori_id']==$data1['kategori_id']) {
                                        $select="selected";
                                    } else {
                                        $select="";
                                    }
                                    echo "<option value='$data1[kategori_id]' $select >$data1[kategori_nama]</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Harga Beli</label>
                            <input type="text" id="ip-beli" name="ip-beli" placeholder="" class="form-control" value="<?php echo $data['barang_harga_beli']; ?>">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Harga Jual</label>
                            <input type="text" id="ip-jual" name="ip-jual" placeholder="" class="form-control" value="<?php echo $data['barang_harga_jual']; ?>">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Set Stok</label>
                            <select name="ip-setstok" id="ip-setstok" class="form-control">
                                <?php
                                $y="";
                                $t="";
                                if ($data['barang_set_stok']==0) {
                                    $t="selected";
                                } else {
                                    $y="selected";
                                }
                                ?>
                                <option value="0" <?php echo $t; ?>>Tidak</option>
                                <option value="1" <?php echo $y; ?>>Ya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Stok</label>
                            <input type="text" id="ip-stok" name="ip-stok" placeholder="" class="form-control" value="<?php echo $data['barang_stok']; ?>">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Batas Stok</label>
                            <input type="text" id="ip-batas" name="ip-batas" placeholder="" class="form-control" value="<?php echo $data['barang_batas_stok']; ?>">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Disable</label>
                            <select name="ip-disable" id="ip-disable" class="form-control">
                                <?php
                                $y="";
                                $t="";
                                if ($data['barang_disable']==0) {
                                    $t="selected";
                                } else {
                                    $y="selected";
                                }
                                ?>
                                <option value="0" <?php echo $t; ?>>Tidak</option>
                                <option value="1" <?php echo $y; ?>>Ya</option>
                            </select>
                        </div>
                </div>
                <div class="card-footer">
                    <?php
                        if ($id!=0) {
                            # code...
                        ?>
                            <button type="submit" class="btn btn-primary btn-sm" name="editbarang">
                                <i class="fa fa-dot-circle-o"></i> Edit
                            </button>
                        <?php
                        } else {
                        ?>
                            <button type="submit" class="btn btn-primary btn-sm" name="inputbarang">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                        <?php
                        }
                    ?>
                </div>
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
                        <th>kategori</th>
                        <th>harga beli</th>
                        <th>harga jual</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql="SELECT * from barang, kategori where barang_kategori=kategori_id";
                        $query=mysql_query($sql);
                        while ($data=mysql_fetch_array($query)) {
                        ?>
                            <tr class="tr-shadow">
                                <td><?php echo $data['barang_nama']; ?></td>
                                <td><?php echo $data['kategori_nama']; ?></td>
                                <td><?php echo $data['barang_harga_beli']; ?></td>
                                <td><?php echo $data['barang_harga_jual']; ?></td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="?menu=barang&id=<?php echo $data['barang_id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Edit" name="editkategori">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="aksi/hapus.aksi.php?ket=barang&id=<?php echo $data['barang_id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Delete" name="deletekategori">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
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