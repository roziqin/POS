<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Kategori</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-4 col-lg-4">
        <div class="card">
            <?php
                $id = $_GET['id'];
                $sql="SELECT * from kategori where kategori_id='$id'";
                $query=mysql_query($sql);
                $data=mysql_fetch_array($query);
                $makanan="";
                $minuman="";
                $snack="";
                if ($data['kategori_jenis']=='Makanan') {
                    $makanan="selected";
                } elseif ($data['kategori_jenis']=='Minuman') {
                    $minuman="selected";
                } elseif ($data['kategori_jenis']=='Snack') {
                    $snack="selected";
                }
            ?>
            <form action="aksi/barang.aksi.php" method="post" class="">
                <input type="hidden" name="kategori_id" value="<?php echo $id; ?>">
                <div class="card-header">
                    Input <strong>Kategory</strong>
                </div>
                <div class="card-body card-block">
                        <div class="form-group">
                            <label class=" form-control-label">Nama Kategory</label>
                            <input type="text" id="ip-nama" name="ip-nama" placeholder="" class="form-control" value="<?php echo $data['kategori_nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Jenis Kategori</label>
                            <select name="ip-jenis" id="ip-jenis" class="form-control">
                                <option value="Makanan" <?php echo $makanan; ?>>Makanan</option>
                                <option value="Minuman" <?php echo $minuman; ?>>Minuman</option>
                                <option value="Snack" <?php echo $snack; ?>>Snack</option>
                            </select>
                        </div>
                </div>
                <div class="card-footer">
                    <?php
                        if ($id!=0) {
                            # code...
                        ?>
                            <button type="submit" class="btn btn-primary btn-sm" name="editkategori">
                                <i class="fa fa-dot-circle-o"></i> Edit
                            </button>
                        <?php
                        } else {
                        ?>
                            <button type="submit" class="btn btn-primary btn-sm" name="inputkategori">
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
                        <th>jenis</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql="SELECT * from kategori";
                        $query=mysql_query($sql);
                        while ($data=mysql_fetch_array($query)) {
                        ?>
                            <tr class="tr-shadow">
                                <td><?php echo $data['kategori_nama']; ?></td>
                                <td><?php echo $data['kategori_jenis']; ?></td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="?menu=category&id=<?php echo $data['kategori_id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Edit" name="editkategori">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="aksi/hapus.aksi.php?ket=kategori&id=<?php echo $data['kategori_id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Delete" name="deletekategori">
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