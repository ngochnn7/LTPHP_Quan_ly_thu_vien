<?php
$kq_KhoaHoc = json_decode($data["kq_KhoaHoc"], true);
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary ">Quản lý Khóa Học</h6>
            <button class="btn btn-success " data-toggle="modal" data-target="#themkhoahoc">Thêm Khóa Học</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên Kháo Học</th>
                            <th>Năm Bắt Đầu</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Stt</th>
                            <th>Tên Kháo Học</th>
                            <th>Năm Bắt Đầu</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1;
                        foreach ($kq_KhoaHoc as $KH) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $KH["TenKhoaHoc"] ?></td>
                                <td><?php echo $KH["NamBatDau"] ?></td>
                                <td><button type="button" class="btn btn-success suakhoahoc" data-toggle="modal" value="<?php echo $KH["MaKhoaHoc"] ?>" data-target="#suakhoahoc">Sửa</button></td>
                                <td><button type="button" class="btn btn-danger xoakhoahoc"  value="<?php echo $KH["MaKhoaHoc"]?>">Xóa</button></td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="themkhoahoc">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Khóa Học</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" class="thoatthemkhoahoc">&times;</span></button>
            </div>
            <form method="post" id="form_themkhoahoc">
                <div class="modal-body">
                    <div class="form-group ">
                        <span class="check_tenkhoahoc" style="color:#8B0000;"></span>
                        <input type="text" class="form-control TenKhoaHoc" id="TenKH" placeholder="Tên Khóa Học" name="TenKhoaHoc" required>

                    </div>


                    <div class="form-group ">
                        <input type="number" class="form-control NamBatDau" maxlength="4" id="NamBatDau" min="1990" max="<?php echo date("Y"); ?>" placeholder="Năm Bắt Đầu" maxlength="4" name="NamBatDau" required>
                    </div>

                    <div class="form-group ">
                        <button type="submit" class="btn btn-success" id="btnthem_khoahoc" hidden> Thêm </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="suakhoahoc">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sửa Khóa Học</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="thoat_suakhoahoc">&times;</span></button>
            </div>
            <form method="post" id="form_suakhoahoc">
                <div class="modal-body">
                    <div class="form-group ">
                    <span class="check_tenkhoahoc" style="color:#8B0000;"></span>
                        <input type="text" class="form-control TenKhoaHoc" id="TenKH_SUA" placeholder="Tên Khóa Học" name="TenKhoaHoc" required>
                    </div>

                    <div class="form-group ">
                        <input type="number" maxlength="4" class="form-control NamBatDau" id="ipnam" min="1990" max="<?php echo date("Y"); ?>" placeholder="Năm Bắt Đầu" name="NamBatDau" required>
                    </div>
                    <!-- footer -->
                    <div class="modal-footer">
                        <button type="button " name="submit" id="btnsua_khoahoc" class="btn btn-success " hidden>Sửa</button>
                        <button type="button" class="btn btn-danger" id="cancel_kh" data-dismiss="modal">Cancel</button>
                    </div>
                    <!-- end footer -->
                </div>
            </form>
        </div>
    </div>
</div>