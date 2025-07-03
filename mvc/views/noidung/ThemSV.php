
<script src="public/js/modal/modal.js"></script>
<link rel="stylesheet" href="public/css/dangnhap.css">
<div class="container-fluid">
<?php 
    if(isset($data["ketquaKhoa"]) && isset($data["ketquaCN"])){
        $kq_khoa = json_decode($data["ketquaKhoa"], true);                                    
        $kq_CN = json_decode($data["ketquaCN"],true);
    }    
?>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <div class="col-lg-7 div_center">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Thêm Sinh Viên Mới</h1>
                        </div>
                        <form class="user" action="admin/addsinhvien" method="POST">
                            <div class="form-group ">
                                <input type="text" class="form-control" id="MSSV"
                                    placeholder="Mã Số Sinh Viên" name="MSSV">
                            </div>
                            <div class="form-group ">
                                <input type="text" class="form-control" id="TenSv"
                                    placeholder="Tên Sinh Viên" name="TenSv">
                            </div>
                            <div class="form-group ">
                                <input type="number" class="form-control" id="CMND"
                                    placeholder="CMND" name="CMND">
                            </div>                            
                            <div class="form-group ">
                                <select name="GioiTinh" id="GioiTinh" class="form-control" aria-label="Default select example">
                                    <option value="Nam">Nam</option>
                                    <option value="Nu">Nữ</option>                                                                      
                                </select>                                
                            </div>
                            <div class="form-group ">
                                <select name="KhoaHoc" id="Khoa" class="form-control" aria-label="Default select example">
                                    <?php
                                        foreach($kq_khoa as $khoa){
                                            ?>
                                                <option value="<?php echo $khoa["MaKhoaHoc"] ?>"> <?php echo $khoa["TenKhoaHoc"] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>                                
                            </div>   
                            <div class="form-group ">
                                <select name="KhoaCN" id="Khoa" class="form-control" aria-label="Default select example">
                                <?php
                                    foreach($kq_CN as $CN){
                                        ?>
                                            <option value="<?php echo $CN["MaKhoaCN"] ?>"> <?php echo $CN["TenCN"] ?></option>
                                        <?php
                                    }
                                ?>                                                                  
                                </select>                                
                            </div> 
                            <div class="form-group ">
                                <input type="password" class="form-control" id="MatKhau"
                                    placeholder="Mật Khẩu" name="MatKhau">
                            </div>
                           
                            <div class="form-group ">
                                
                                <input type="submit" id = "submit" name = "submit" class="btn btn-success fas fa-user-plus" value="Thêm Sinh Viên">
                            </div>
                           
                        </form>                     
                        <hr>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




