<?php
$kq_khoaCN = json_decode($data["kq_khoaCN"], true);

?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary ">Quản lý Chuyên Ngành</h6>
            <button class="btn btn-success " data-toggle="modal" data-target="#themkhoacn">Thêm Khoa Chuyên Ngành</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên Chuyên Ngành</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Stt</th>
                            <th>Tên Chuyên Ngành</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1;
                        foreach ($kq_khoaCN as $CN) { ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $CN["TenCN"] ?></td>
                                <td><button type="button" class="btn btn-success suakhoacn" data-toggle="modal" value="<?php echo $CN["MaKhoaCN"] ?>" data-target="#suakhoacn">Sửa</button></td>
                                <td><button type="button" class="btn btn-danger xoakhoacn" value="<?php echo $CN["MaKhoaCN"] ?>">Xóa</button></td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="themkhoacn">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Khóa Chuyên Ngành</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="thoatthemkhoacn">&times;</span></button>
            </div>
            <form method="post" id="form_themkhoacn">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" placeholder="Tên Khoa Chuyên ngành" class="form-control" id="tenkhoacn" name="tenkhoacn" required>
                    </div>
                  
                    <!-- footer -->
                    <div class="modal-footer">
                          <input type="submit" name="btn_themtg" id="btn_themkcn" class="btn btn-success" value="Thêm">
                    </div>
                    <!-- end footer -->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="suakhoacn">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sửa Khoa Chuyên Ngành</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="thoat_suakhoacn">&times;</span></button>
            </div>
            <form method="post" id="form_suakhoacn">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tenkhoacn_cansua" name="TenNhanVien" required>
                    </div>             
                    <!-- footer -->
                    <div class="modal-footer">
                      <button type="button " name="submit" id="btn_suakhoacn" class="btn btn-success" >Sửa</button>
                        <button type="button" class="btn btn-danger" id="cancel_cn" data-dismiss="modal">Cancel</button>
                    </div>
                    <!-- end footer -->
                </div>
            </form>
        </div>
    </div>
</div>