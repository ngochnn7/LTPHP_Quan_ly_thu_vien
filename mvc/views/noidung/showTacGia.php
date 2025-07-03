<?php 
    $kq_tg = json_decode($data["kq_tg"], true);     
    
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý</h1>
    <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary ">Quản Lý Tác Giả</h6>    
             <button  class="btn btn-success " data-toggle="modal" data-target="#themtacgia">Thêm Tác Giả</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Stt</th>                                             
                        <th>Tên Tác Giả</th>                                              
                        <th>Sửa</th>
                        <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Stt</th>                                             
                        <th>Tên Tác Giả</th>                                              
                        <th>Sửa</th>
                        <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody id="tab_tacgia">
                    <?php $i=1 ; 
                        foreach ($kq_tg as $tg) { ?> 
                        <tr>
                            <td><?php echo $i ?></td>                            
                            <td><?php echo $tg["TenTG"] ?></td>                                                                       
                            <td><button type="button" class="btn btn-success suatacgia" data-toggle="modal" value="<?php echo $tg["MaTG"] ?>" data-target="#modalsua_tacgia">Sửa</button></td>
                            <td><button type="button"  class="btn btn-danger xoatacgia" value="<?php echo $tg["MaTG"]?>" >Xóa</button></td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="themtacgia">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm Tác Giả</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="thoatthemtacgia">&times;</span></button>
            </div>
            <form method="post" id="form_themtacgia">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" placeholder="Tên Tác Giả" class="form-control" id="tentacgia" name="tentacgia" required>
                    </div>
                  
                    <!-- footer -->
                    <div class="modal-footer">
                          <input type="submit" name="btn_themtg" id="btn_themtg" class="btn btn-success" value="Thêm">
                        <button type="button" class="btn btn-danger" id="btn_thoatthemtg" data-dismiss="modal">Cancel</button>
                    </div>
                    <!-- end footer -->
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalsua_tacgia">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sửa Tác Giả</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" id="thoat_suatacgia">&times;</span></button>
            </div>
            <form method="post" id="form_suatacgia">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="tentg_cansua" name="TenNhanVien" required>
                    </div>             
                    <!-- footer -->
                    <div class="modal-footer">
                      <button type="button " name="submit" id="btn_suatg" class="btn btn-success" >Sửa</button>
                        <button type="button" class="btn btn-danger" id="cancel_tg" data-dismiss="modal">Cancel</button>
                    </div>
                    <!-- end footer -->
                </div>
            </form>
        </div>
    </div>
</div>