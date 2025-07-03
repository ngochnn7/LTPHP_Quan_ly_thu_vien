<?php
                if(isset($_SESSION["thongbao"])){ ?>
                     <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>thông báo!</strong> <?php echo $_SESSION["thongbao"] ?> .
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                  unset($_SESSION["thongbao"]);
                }
 ?>

<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thông tin sách</h1>
</div>
<?php //require_once "thongtinsach.php" ?>

<div class="row">
    <?php
    $kq_sach = json_decode($data["thongtinsach"], true);
    $sotrang = $data["sotrang"];
    $tranght = $data["trang"];
    if ($data['check'] == 1) {
        $id = $data['id'];
    }
    if ($data['check'] == 2) {
        $tensach = $data['tensach'];
    }
    if ($data['check'] == 3) {
        $id = $data['id'];
    }

    if($kq_sach == 0) { ?>
<div class="container-fluid">
<div class="text-center">
    <img src="public/img/thongbao.png" alt="không tìm thấy sản phẩm" id="thongbaotimkiem">
    <h2 class="text-gray-500 mb-0">Không có thông tin sách mà bạn tìm </h2>
    <a href="index.php">&larr; Quay về trang chủ </a>
</div>
</div>
    <?php } else {
    foreach ($kq_sach as $sach) { ?>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="card shadow mb-4">
                <!-- Product image-->
                <img class=" hinhanh card-img-top img-thumbnail " src="<?php echo $sach["AnhDaiDien"] ?>" alt="<?php echo $sach["TenSach"] ?>" id="" />
                <!-- Product details-->
                <div class="card-body p-4 ">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder"><?php echo $sach["TenSach"] ?></h5>
                        <!-- Product price-->
                        <?php if(strlen($sach["Noidungngan"]) > 100 ){
                            ?>
                            <div><?php echo substr($sach["Noidungngan"], 0, 100)."...."; ?></div> <p style="color:blue;">xem them</p>
                            <?php
                        }else {  ?>
                            <div><?php echo substr($sach["Noidungngan"], 0, 100) ; ?></div>
                        <?php } ?>
                      
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center "><a class="btn btn-outline-dark mt-auto" href="./home/thongtinsach/<?php echo $sach["MaSach"] ?>">Xem thông tin</a></div>
                </div>
            </div>
        </div>
    <?php
    }}
    ?>
   
     <?php require_once "phantrang.php" ?>
</div>
</div>