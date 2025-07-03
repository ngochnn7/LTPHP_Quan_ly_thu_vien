<?php $kq_loaisach = json_decode($data["thongtinloaisach"], true); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary ">Quản lý loại sách</h6>    
             <div class="col-md-2">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd" href="">Thêm Loại Sách</button>
                <!-- modal -->
                <div class="modal fade" id="modalAdd">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm Loại Sách</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="AddNV">&times;</span></button>
                            </div>
                            <form  method="post" id="themloaisach">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tenls" placeholder="Tên Loại Sách" name="TenNhanVien" required>
                                </div>
                                <div class="form-group ">
                                    <button type="button " name="submit" value="Gửi" id=""  class="btn btn-success">Thêm</button>

                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                                <!-- footer -->
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> -->
                                </div>
                                <!-- end footer -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end modal -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                              <th>Số thứ tự</th>
                            <th>Tên sách</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                             <th>Số thứ tự</th>
                            <th>Tên sách</th>   
                            <th>Sửa</th>
                            <th>Xóa</th>                     
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php $i=1 ;
                     foreach ($kq_loaisach as $loaisach) { ?> 
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $loaisach['TenLoaiSach'] ?></td>
                            <td><button  type="button"  class="btn btn-success sualoaisach" data-toggle="modal" value="<?php echo $loaisach['MaLoaiSach'] ?>" data-target="#modalsua" >Sửa</button></td>
                            <td><button type="button"  class="btn btn-danger xoaloaisach" value="<?php echo $loaisach['MaLoaiSach'] ?>" >Xóa</button></td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalsua">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Sửa Loại Sách</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="AddNV">&times;</span></button>
                            </div>
                            <form  method="post" id="sualoaisach">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tenls_cansua" name="TenNhanVien" required>
                                </div>
                                <div class="form-group ">
                                    <button type="button " name="submit" id="xong_suasach" class="btn btn-success">Xong</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                                <!-- footer -->
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> -->
                                </div>
                                <!-- end footer -->
                                </form>
                            </div>
                        </div>
                    </div>
</div>



