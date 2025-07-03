  <?php
    $thongtin_tk = json_decode($data["sinhvien"], true);
    ?>
  <div class="container">
      <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                  <div class="col-lg-5">
                      <img src="./public/img/logo_vlute.png" alt="logo trường vlute" class="img-fluid" id="logo_dangnhap">
                  </div>
                  <div class="col-lg-7">
                      <div class="p-5">
                          <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">Thay Đổi Mật Khẩu</h1>
                          </div>
                          <form class="user" id="form_doimatkhau">
                              <div class="form-group ">
                                  <input type="text" class="form-control form-control-user" id="taikhoan" placeholder="Tài khoản" name="taikhoan" value="<?php echo $thongtin_tk['MSSV'] ?>" readonly required>
                              </div>
                              <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                      <input type="password" class="form-control form-control-user" id="matkhaucu" placeholder="Mật Khẩu Cũ" name="matkhaucu" required>
                                  </div>
                                  <div class="col-sm-6">
                                      <input type="password" class="form-control form-control-user" id="matkhaumoi" placeholder="Mật Khẩu Mới" name="matkhaumoi" required>
                                  </div>
                              </div>
                              <input type="submit" class="btn btn-primary btn-user btn-block" value="Thay Đổi Mật Khẩu">


                          </form>
                          <hr>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>