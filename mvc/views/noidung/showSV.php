<?php
$kq_sv = json_decode($data["kq_sv"], true);

?>
<?php
if (isset($data["ketquaKhoa"]) && isset($data["ketquaCN"])) {
    $kq_khoa = json_decode($data["ketquaKhoa"], true);
    $kq_CN = json_decode($data["ketquaCN"], true);
}
?>
<link rel="stylesheet" href="public/css/dangnhap.css">
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary ">Quản lý Sinh Viên</h6>
            <button class="btn btn-success " data-toggle="modal" data-target="#themsinhvien">Thêm Sinh Viên</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>MSSV</th>
                            <th>Họ Tên</th>
                            <th>CMND</th>
                            <th>Giới Tính</th>
                            <th>Khoa</th>
                            <th>Khoa Chuyên Ngành</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Stt</th>
                            <th>MSSV</th>
                            <th>Họ Tên</th>
                            <th>CMND</th>
                            <th>Giới Tính</th>
                            <th>Khoa</th>
                            <th>Khoa Chuyên Ngành</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1;
                        foreach ($kq_sv as $sv) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $sv["MSSV"] ?></td>
                                <td><?php echo $sv["HoTen"] ?></td>
                                <td><?php echo $sv["CMND"] ?></td>
                                <td><?php echo $sv["GioiTinh"] ?></td>
                                <td><?php echo $sv["TenKhoaHoc"] ?></td>
                                <td><?php echo $sv["TenCN"] ?></td>                       
                                <td><button type="button" class="btn btn-success suasv" data-toggle="modal" value="<?php echo $sv["IDSV"] ?>" data-target="#modalsua_sv">Sửa</button></td>
                                <td><button type="button" class="btn btn-danger xoasv" value="<?php echo $sv["IDSV"] ?>">Xóa</button></td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="themsinhvien">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;">Thêm Sinh Viên</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="thoatthemsv">&times;</span></button>
            </div>

            <form id="form_themsv" method="POST">
                <div class="form-group ">
                    <span id="check_mssv_them" style="color:#8B0000;"></span>
                    <input type="text" class="form-control" id="MSSV" placeholder="Mã Số Sinh Viên" name="MSSV" required>
                </div>
                <div class="form-group ">
                    <input type="text" class="form-control" id="TenSv" placeholder="Tên Sinh Viên" name="TenSv" required>
                </div>
                <div class="form-group ">
                    <input type="number" class="form-control" id="CMND" placeholder="CMND" name="CMND" required>
                </div>
                <div class="form-group ">
                    <select name="GioiTinh" id="GioiTinh" class="form-control" aria-label="Default select example" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="form-group ">
                    <select name="KhoaHoc" id="Khoahoc" class="form-control" aria-label="Default select example" required>
                        <?php
                        foreach ($kq_khoa as $khoa) {
                        ?>
                            <option value="<?php echo $khoa["MaKhoaHoc"] ?>"> <?php echo $khoa["TenKhoaHoc"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group ">
                    <select name="KhoaCN" id="KhoaCN" class="form-control" aria-label="Default select example" required>
                        <?php
                        foreach ($kq_CN as $CN) {
                        ?>
                            <option value="<?php echo $CN["MaKhoaCN"] ?>"> <?php echo $CN["TenCN"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group ">
                    <input type="password" class="form-control" id="MatKhau" placeholder="Mật Khẩu" name="MatKhau" required>
                </div>

                <div class="form-group ">
                    <button type="submit" id="btn_themsv" name="submit" class="btn btn-success fas fa-user-plus">Thêm Sinh Viên</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalsua_sv">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;">Sửa Sinh Viên</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="thoatsuasv">&times;</span></button>
            </div>

            <form id="form_suasv" method="POST">
                <div class="form-group ">                 
                    <input type="text" class="form-control" id="MSSV_sua" placeholder="Mã Số Sinh Viên" name="MSSV" required readonly disabled>
                </div>
                <div class="form-group ">
                    <input type="text" class="form-control" id="TenSv_sua" placeholder="Tên Sinh Viên" name="TenSv" required>
                </div>
                <div class="form-group ">
                <span id="check_suasv" style="color:#8B0000;"></span>
                    <input type="number" class="form-control" id="CMND_sua" placeholder="CMND" name="CMND"  required>
                </div>
                <div class="form-group ">
                    <select name="GioiTinh" id="GioiTinh_sua" class="form-control" aria-label="Default select example" required>
                        <option  value="Nam">Nam</option>
                        <option  value="Nữ" >Nữ</option>
                    </select>
                </div>
                <div class="form-group ">
                    <select name="KhoaHoc" id="Khoahoc_sua" class="form-control" aria-label="Default select example" required>
                        <?php
                        foreach ($kq_khoa as $khoa) {
                        ?>
                            <option value="<?php echo $khoa["MaKhoaHoc"] ?>"> <?php echo $khoa["TenKhoaHoc"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group ">
                    <select name="KhoaCN" id="KhoaCN_sua" class="form-control" aria-label="Default select example" required>
                        <?php
                        foreach ($kq_CN as $CN) {
                        ?>
                            <option value="<?php echo $CN["MaKhoaCN"] ?>"> <?php echo $CN["TenCN"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group ">
                    <button type="submit" id="btn_suasv_sua" name="submit" class="btn btn-success fas fa-user-plus">Sửa Sinh Viên</button>
                </div>
            </form>
        </div>
    </div>
</div>