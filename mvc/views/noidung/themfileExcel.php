<link rel="stylesheet" href="public/css/hoangphu.css">
<link rel="stylesheet" href="public/css/dangnhap.css">
<link rel="stylesheet" href="public/css/nhatnam.css">
<link rel="stylesheet" href="public/css/table_ex">
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<div class="container-fluid">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <div class="col-lg-7 div_center">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Chọn File</h1>
                        </div>
                        <form method="POST" id="xemfile" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-7 ">
                                    <label for="file">Chọn File Excel</label>
                                    <input type="file" id="fileExecl" accept=".xlsx"  name="fileExecl" required>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="file">Chọn Sheet</label>
                                    <select id="sheet" class="form-control" name="sheet">
                                        <option value="0" selected>Chọn Sheet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <input type="submit" name="submit" value="Xem File Excel" class="btn btn-success">
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
        <!-- <button class="btn btn-primary btn-user btn-block center" id="loadrt">load</button>
        <div id="load">
            <div id="load1">

            </div>
        </div> -->


        <div style="overflow-x: auto;">
            <div id="tb">
            <form id="fomr_ex" method="POST" enctype="multipart/form-data">
                <table class="table table-hover table-responsive table_ex">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">Stt</th>
                            <th scope="col">Tên sách</th>
                            <th scope="col">Nội dung ngắn</th>
                            <th scope="col">Sô lượng</th>
                            <th scope="col">Ngày nhập</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Hình ảnh chi tiết</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Loại sách</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Khoa chuyên ngành</th>
                            <th scope="col">File</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="table-info">
                            <th scope="col">Stt</th>
                            <th scope="col">Tên sách</th>
                            <th scope="col">Nội dung ngắn</th>
                            <th scope="col">Sô lượng</th>
                            <th scope="col">Ngày nhập</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Hình ảnh chi tiết</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Loại sách</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Khoa chuyên ngành</th>
                            <th scope="col">File</th>
                        </tr>
                    </tfoot>

                  

                        <tbody id="tb1">
    
                        </tbody>

                    

                  </table>


            </div>
            <input type="submit" id="luu_ex" class="btn btn-primary btn-user btn-block center" name="gui" value="Lưu" style="width:20% ;" >
                    </form>
        </div>


    </div>
</div>