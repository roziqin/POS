<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">User</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-sm-4 col-lg-4">
        <div class="card">
            <?php
                $id = $_GET['id'];
                $sql="SELECT * from users, roles where role=roles_id and id='$id'";
                $query=mysql_query($sql);
                $data=mysql_fetch_array($query);
                $select="";
            ?>
            <form action="aksi/user.aksi.php" method="post" class="">
                <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                <div class="card-header">
                    Input <strong>User</strong>
                </div>
                <div class="card-body card-block">
                        <div class="form-group">
                            <label class=" form-control-label">Nama Display</label>
                            <input type="text" id="ip-nama" name="ip-nama" placeholder="" class="form-control" value="<?php echo $data['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Username</label>
                            <input type="text" id="ip-user" name="ip-user" placeholder="" class="form-control" value="<?php echo $data['username']; ?>">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Password</label>
                            <input type="password" id="ip-password" name="ip-password" placeholder="" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Roles</label>
                            <select name="ip-roles" id="ip-roles" class="form-control">
                            <?php
                                $sql="SELECT * from roles";
                                $query=mysql_query($sql);
                                while ($data1=mysql_fetch_array($query)) {
                                    if ($data['roles_id']==$data1['roles_id']) {
                                        $select="selected";
                                    } else {
                                        $select="";
                                    }
                                    echo "<option value='$data1[roles_id]' $select >$data1[display_name]</option>";
                                }
                            ?>
                            </select>
                        </div>
                </div>
                <div class="card-footer">
                    <?php
                        if ($id!=0) {
                            # code...
                        ?>
                            <button type="submit" class="btn btn-primary btn-sm" name="edituser">
                                <i class="fa fa-dot-circle-o"></i> Edit
                            </button>
                        <?php
                        } else {
                        ?>
                            <button type="submit" class="btn btn-primary btn-sm" name="inputuser">
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
                        <th>roles</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql="SELECT * from users, roles where role=roles_id";
                        $query=mysql_query($sql);
                        while ($data=mysql_fetch_array($query)) {
                        ?>
                            <tr class="tr-shadow">
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['display_name']; ?></td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="?menu=user&id=<?php echo $data['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Edit" name="editkategori">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="aksi/hapus.aksi.php?ket=user&id=<?php echo $data['id']; ?>" class="item" data-toggle="tooltip" data-placement="top" title="Delete" name="deletekategori">
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