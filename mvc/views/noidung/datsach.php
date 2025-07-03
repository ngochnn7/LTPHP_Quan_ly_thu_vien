<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Sách Đang Đặt</h1>
    <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary ">Danh Sách</h6> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Stt</th>                                             
                        <th>Tên Sách</th>                                              
                        <th>Tác Giả</th>                        
                        <th>Xóa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Stt</th>                                             
                        <th>Tên Sách</th>                                              
                        <th>Tác Giả</th>                        
                        <th>Xóa</th>
                        </tr>
                    </tfoot>
                    <tbody id="results">                    
                    <?php 
                        if(isset($data["LayDanhSach"])){
                            $kq = json_decode($data["LayDanhSach"], true);  
                        }
                        $i=1 ; 
                        foreach ($kq as $sach) { ?> 
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $sach["TenSach"] ?></td>
                            <td><?php echo $sach["TenTG"] ?></td>                                       
                            
                            <td><a type="button" class="btn btn-danger SachCanXoa" id="<?php echo $sach["MaSach"] ;?> <?php echo $sach["MaPhieuMuon"]?>">Xóa</a></td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>                
            </div>            
        </div>
    </div>
    <h1 class="h3 mb-2 text-gray-800">Sách Đang Mượn</h1>
    <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary ">Danh Sách</h6> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Stt</th>                                             
                        <th>Tên Sách</th>                                              
                        <th>Tác Giả</th>
                        <th>Trạng Thái</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Stt</th>                                             
                        <th>Tên Sách</th>                                              
                        <th>Tác Giả</th>
                        <th>Trạng Thái</th>
                        </tr>
                    </tfoot>
                    <tbody id="results2">                    
                    <?php 
                        if(isset($data["SachDangMuon"])){
                            $kq = json_decode($data["SachDangMuon"], true);  
                        }
                        $i=1 ; 
                        foreach ($kq as $sach) { ?> 
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $sach["TenSach"] ?></td>
                            <td><?php echo $sach["TenTG"] ?></td> 
                            <td>Đang Mượn</td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>                
            </div>            
        </div>
    </div>
</div>