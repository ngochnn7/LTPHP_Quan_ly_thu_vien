
<script src="public/js/modal/modal.js"></script>
<link rel="stylesheet" href="public/css/hoangphu.css">
<div class="container-fluid">
<?php     
    if(isset($data['result'])){
        $kq = $data['result'];
        if($kq == true){
            echo "Thêm Thành Công";
        }
        else
            echo "Thêm Thất Bại";
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
                            <h1 class="h4 text-gray-900 mb-4">Thêm Sinh Viên</h1>
                        </div>
                        <form class="user" method="POST" enctype="multipart/form-data" action="./admin/addNV">                            
                            <div class="form-group ">
                                <input type="text" class="input-group" id="TenNhanVien"
                                    placeholder="Tên Nhân Viên" name="TenNhanVien">
                            </div>
                            <div class="form-group ">                                
                                <input type="text" class="input-group" id="CMND"
                                    placeholder="CMND" name="CMND">
                            </div>
                            <div class="form-group ">
                                <input type="password" class="input-group" id="pass"
                                    placeholder="Mật Khẩu" name="pass">
                            </div>
                            <div class="form-group ">
                                <select name="GioiTinh" id="GioiTinh">
                                    <option value="Nam">Nam</option>
                                    <option value="Nu">Nữ</option>
                                </select>
                            </div>                            
                            <div class="form-group ">
                                <input type="submit" name="submit" value="Gửi" class="btn btn-success">
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>





