
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý</h1>
    <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary ">Sách Đang Đặt</h6> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Stt</th>                                             
                        <th>Tên Sinh Viên</th>                                              
                        <th>Ngày Mượn</th>
                        <th>Số Lượng</th>                        
                        <th>Duyệt</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Stt</th>                                             
                        <th>Tên Sinh Viên</th>                                              
                        <th>Ngày Mượn</th>
                        <th>Số Lượng</th>                         
                        <th>Duyệt</th>
                        </tr>
                    </tfoot>
                    <tbody id="results">                    
                    <?php 
                        if(isset($data["sachcanduyet"])){
                            $kq = json_decode($data["sachcanduyet"], true);  
                        }
                        $i=1 ; 
                        foreach ($kq as $sach) { ?> 
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $sach["HoTen"] ?></td>
                            <td><?php echo $sach["NgayMuon"] ?></td>                                       
                            <td><?php echo $sach["TongSoSachMuon"] ?></td> 
                            <td><a type="button" class="btn btn-primary SachCanDuyet" id="<?php echo $sach["MaPhieuMuon"]?> <?php echo $sach["MSSV"] ?>">Duyệt</a></td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>