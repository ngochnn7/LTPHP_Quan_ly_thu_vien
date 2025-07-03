<link rel="stylesheet" href="./public/css/dangnhap.css">
<div class="container-fluid">
<!-- Outer Row -->
<div class="row justify-content-center">
<?php
    // $kq = json_decode($data["dangnhap"], true);
    if (isset($data["dangnhap"])) { 
        $kq = json_decode($data["dangnhap"], true); ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>thông báo: </strong> <?php echo $kq ?> .
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php
      //unset($_SESSION['tc']);
    }
    ?>

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-4">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block text-center">
                        <img src="./public/img/logo_vlute.png" alt="logo trường vlute" class="img-fluid" id="logo_dangnhap">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <?php if(isset($data["phanquyen"])){?>
                                <h1 class="h4 text-gray-900 mb-4">Đăng nhập quản trị</h1>
                                <?php } else {?>
                                    <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                                    <?php } ?>
                            </div>
                            <?php if(isset($data["phanquyen"])){?>
                                <form class="user" action="./quantri/xldn" method="POST">
                            <?php } else {?>
                                <form class="user" action="./dangnhap/xldn" method="POST">
                            <?php } ?>
                                <div class="form-group">
                                <?php if(isset($data["phanquyen"])){?>
                                    <input type="number" class="form-control form-control-user"
                                        id="mssv"
                                        placeholder="Nhập chứng minh nhân dân " name="mssv">
                                        <?php } else {?>
                                        <input type="number" class="form-control form-control-user"
                                        id="mssv"
                                        placeholder="Nhập mã số sinh viên " name="mssv">
                                        <?php } ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Mật khẩu" name="matkhau">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Lưu mật khẩu</label>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Đăng nhập" name="dangnhap">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>