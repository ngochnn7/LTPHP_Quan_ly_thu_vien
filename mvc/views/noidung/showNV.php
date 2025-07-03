<?php $kq_nv = json_decode($data["result"], true);
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary ">Quản lý Nhân Viên</h6>
            <div class="col-md-2">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd" >Thêm Nhân Viên</button>
                <!-- modal -->
                <div class="modal fade" id="modalAdd">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm Nhân Viên</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="AddNV">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form id="themnv">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="TenNhanVien" placeholder="Tên Nhân Viên" name="TenNhanVien" required>
                                </div>
                                <div class="form-group ">
                                   <span id="check_cmnd_nv" style="color:#8B0000;"></span>
                                    <input type="number" class="form-control" id="CMND" placeholder="CMND" name="CMND" required>
                                </div>
                                <div class="form-group ">
                                    <input type="password" class="form-control" id="pass" placeholder="Mật Khẩu" name="pass" required>
                                </div>
                                <div class="form-group ">
                                    <select name="GioiTinh" id="GioiTinh" class="form-control" id="gt" required>
                                        <option value="Nam">Nam</option>
                                        <option value="Nu">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <button type="button " name="submit" value="Gửi" id="button_insert" class="btn btn-success">Thêm</button>

                                    <button type="button" class="btn btn-danger" id="huynv" data-dismiss="modal">Cancel</button>
                                </div>
                                </form>
                             
                            

                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên Nhân Viên</th>
                            <th>Giới Tính</th>
                            <th>CMND</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Stt</th>
                            <th>Tên Nhân Viên</th>
                            <th>Giới Tính</th>
                            <th>CMND</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1;
                        foreach ($kq_nv as $nv) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $nv["TenNV"] ?></td>
                                <td><?php echo $nv["GioiTinh"] ?></td>
                                <td><?php echo $nv["Cmnd_gv"] ?></td>    
                                <td><button type="button" class="btn btn-success suanv" data-toggle="modal" value="<?php echo $nv["MaNV"] ?>" data-target="#modalsua">Sửa</button></td>
                                <td><button type="button" class="btn btn-danger xoanv" value="<?php echo $nv["MaNV"] ?>">Xóa</button></td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalsua">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Sửa Nhân Viên</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="suaNV">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form id="suanv">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="TenNhanVien_sua" placeholder="Tên Nhân Viên" name="TenNhanVien" required>
                                </div>
                                <div class="form-group ">
                                   <span id="check_cmnd_nv_sua" style="color:#8B0000;"></span>
                                    <input type="number" class="form-control" id="CMND_sua" placeholder="CMND" name="CMND" required readonly disabled>
                                </div>
                                <div class="form-group ">
                                    <select name="GioiTinh" id="GioiTinh_sua" class="form-control " id="gt_sua" required>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <button type="button " name="submit" value="Gửi" id="button_sua" class="btn btn-success">Sửa</button>

                                    <button type="button" class="btn btn-danger" id="huynv_sua" data-dismiss="modal">Cancel</button>
                                </div>
                                </form>
                             
                            

                            </div>
                        </div>
                    </div>
                </div>
