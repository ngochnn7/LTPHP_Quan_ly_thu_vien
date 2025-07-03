<?php
class M_admin extends db
{
    public function xoa_anhct($id)
    {
        $check = false;
        $qr4 = "DELETE FROM `anhchitiet` WHERE id=$id ";
        $qr5 = "SELECT * FROM `anhchitiet` WHERE id=$id";
        if ($row2 = mysqli_query($this->conn, $qr5)) {
            $kq = mysqli_fetch_array($row2);
            if (mysqli_query($this->conn, $qr4)) {
                $check = true;
                unlink($kq['Link']);
            };
        }
        return $check;
    }
    public function sua_anhct($masach)
    {
        $kq = false;
        $nhieu_anh = $this->chon_nhieu_anh();
        $cout_anh = $nhieu_anh["so_hinh_luu"];
        for ($i = 0; $i <  $cout_anh; $i++) {
            $dd_nhieu_anh = $nhieu_anh["duongdan"][$i];
            $qr5 = "INSERT INTO `anhchitiet` (`MaSach`, `id`, `Link`) VALUES ('$masach', NULL, '$dd_nhieu_anh')";
            if (mysqli_query($this->conn, $qr5)) {
                $kq = true;
            }
        }
        return json_encode($kq);
    }
    public function sua_anhdd($masach)
    {
        $duongdan = $this->chon_1_anh();
        $kq = false;
        if ($duongdan['check'] == 0) {
            $anh = $duongdan['duongdan'];
            $qr4 = "UPDATE `sach` SET `AnhDaiDien`= '$anh' WHERE `MaSach`='$masach'";
            if (mysqli_query($this->conn, $qr4)) {
                $kq = true;
            }
        }

        return json_encode($kq);
    }
    public function sua_noidung($masach, $tensach, $noidungngan, $soluong, $ngaynhap, $gia, $matacgia, $makhoacn)
    {
        $kq = false;
        $qr4 = "UPDATE `sach` SET `TenSach`='$tensach',`Noidungngan`='$noidungngan',`SoLuong`='$soluong',`NgayNhap`='$ngaynhap',`Gia`='$gia',`MaTacGia`='$matacgia',`MakhoaCN`=$makhoacn WHERE `MaSach`='$masach'";
        if (mysqli_query($this->conn, $qr4)) {
            $kq = true;
        }
        return json_encode($kq);
    }
    public function suasach($masach, $tensach, $noidungngan, $soluong, $ngaynhap/*,$anh*/, $gia, $matacgia, $makhoacn)
    {
        $duongdan = $this->chon_1_anh();
        $nhieu_anh = $this->chon_nhieu_anh();
        $kq = false;
        if ($duongdan['check'] == 0 && $nhieu_anh['check2'] == 0) {
            $anh =  $duongdan['duongdan'];
            $qr4 = "UPDATE `sach` SET `TenSach`='$tensach',`Noidungngan`='$noidungngan',`SoLuong`='$soluong',`NgayNhap`='$ngaynhap',`AnhDaiDien`='$anh',`Gia`='$gia',`MaTacGia`='$matacgia',`MakhoaCN`='$makhoacn' WHERE `MaSach`='$masach'";
            if (mysqli_query($this->conn, $qr4)) {
                $kq = true;
                $cout_anh = $nhieu_anh["so_hinh_luu"];
                for ($i = 0; $i <  $cout_anh; $i++) {
                    $dd_nhieu_anh = $nhieu_anh["duongdan"][$i];
                    $qr5 = "INSERT INTO `anhchitiet` (`MaSach`, `id`, `Link`) VALUES ('$masach', NULL, '$dd_nhieu_anh')";
                    if (mysqli_query($this->conn, $qr5)) {
                        $kq = true;
                    }
                }
            }
            $mang = array("kq" => $kq, "anh" => $duongdan, "nhieuanh" => $nhieu_anh);
        } else { //không phải ảnh
            $kq = false;
            $mang = array("kq" => $kq, "anh" => $duongdan, "nhieuanh" => $nhieu_anh);

            unlink($duongdan['duongdan']);
        }
        return json_encode($mang);
    }

    public function ad_thongtinsach()
    {
        $qr4 = "SELECT * FROM `sach`,tacgia,loaisach,khoachuyennganh WHERE sach.Maloaisach = loaisach.MaLoaiSach and sach.MaTacGia = tacgia.MaTG and sach.MakhoaCN = khoachuyennganh.MaKhoaCN ORDER BY `MaSach` DESC";
        $row2 = mysqli_query($this->conn, $qr4);
        $mang = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function khoacn()
    {
        $qr4 = "SELECT * FROM `khoachuyennganh`";
        $row2 = mysqli_query($this->conn, $qr4);
        $mang = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function themsach($tensach, $noidungngan, $soluong, $ngaynhap/*,$anh*/, $gia, $maloaisach, $matacgia, $makhoacn)
    {
        $duongdan = $this->chon_1_anh();
        $nhieu_anh = $this->chon_nhieu_anh();
        $kq = false;
        if ($duongdan['check'] == 0 && $nhieu_anh['check2'] == 0) {
            $anh =  $duongdan['duongdan'];
            $qr4 = "INSERT INTO `sach` (`MaSach`, `TenSach`, `Noidungngan`, `SoLuong`, `NgayNhap`, `AnhDaiDien`, `Gia`, `MaLoaiSach`, `MaTacGia`,`MakhoaCN`) VALUES (NULL, '$tensach', '$noidungngan', '$soluong', '$ngaynhap', '$anh', '$gia', '$maloaisach', '$matacgia','$makhoacn')";
            if (mysqli_query($this->conn, $qr4)) {
                $kq = true;
                $cout_anh = $nhieu_anh["so_hinh_luu"];
                $masach = $this->conn->insert_id;
                for ($i = 0; $i <  $cout_anh; $i++) {
                    $dd_nhieu_anh = $nhieu_anh["duongdan"][$i];
                    $qr5 = "INSERT INTO `anhchitiet` (`MaSach`, `id`, `Link`) VALUES ('$masach', NULL, '$dd_nhieu_anh')";
                    if (mysqli_query($this->conn, $qr5)) {
                        $kq = true;
                    }
                }
            }
            $mang = array("kq" => $kq, "anh" => $duongdan, "nhieuanh" => $nhieu_anh);
        } else {
            $kq = false;
            $mang = array("kq" => $kq, "anh" => $duongdan, "nhieuanh" => $nhieu_anh);
            unlink($duongdan['duongdan']);
        }

        return json_encode($mang);
    }

    public function themsach_tailieu($tensach, $noidungngan, $soluong, $ngaynhap/*,$anh*/, $gia, $maloaisach, $matacgia, $makhoacn, $file_sach)
    {
        $duongdan = $this->chon_1_anh();
        $nhieu_anh = $this->chon_nhieu_anh();
        $file_tailieu = $this->chon_1_file($file_sach);
        $kq = false;
        if ($duongdan['check'] == 0 && $nhieu_anh['check2'] == 0 &&  $file_tailieu['check3'] == 0) {
            $anh =  $duongdan['duongdan'];
            $dd_file_tailieu = $file_tailieu['duongdan_file'];
            $qr4 = "INSERT INTO `sach` (`MaSach`, `TenSach`, `Noidungngan`, `SoLuong`, `NgayNhap`, `AnhDaiDien`, `Gia`, `MaLoaiSach`, `MaTacGia`,`MakhoaCN`,`file`) VALUES (NULL, '$tensach', '$noidungngan', '$soluong', '$ngaynhap', '$anh', '$gia', '$maloaisach', '$matacgia','$makhoacn','$dd_file_tailieu')";
            if (mysqli_query($this->conn, $qr4)) {
                $kq = true;
                $cout_anh = $nhieu_anh["so_hinh_luu"];
                $masach = $this->conn->insert_id;
                for ($i = 0; $i <  $cout_anh; $i++) {
                    $dd_nhieu_anh = $nhieu_anh["duongdan"][$i];
                    $qr5 = "INSERT INTO `anhchitiet` (`MaSach`, `id`, `Link`) VALUES ('$masach', NULL, '$dd_nhieu_anh')";
                    if (mysqli_query($this->conn, $qr5)) {
                        $kq = true;
                    }
                }
            }
            $mang = array("kq" => $kq, "anh" => $duongdan, "nhieuanh" => $nhieu_anh);
        } else {
            $kq = false;
            $mang = array("kq" => $kq, "anh" => $duongdan, "nhieuanh" => $nhieu_anh);
            for ($i = 0; $i < count($nhieu_anh["duongdan"]); $i++) {
                unlink($nhieu_anh["duongdan"][$i]);
            }
            unlink($duongdan['duongdan']);
            unlink($file_tailieu['duongdan_file']);
        }

        return json_encode($mang);
    }


    public function show_sach_sua($masach)
    {
        $qr4 = "SELECT * FROM `sach`,tacgia,loaisach,khoachuyennganh WHERE sach.Maloaisach = loaisach.MaLoaiSach and sach.MaTacGia = tacgia.MaTG AND sach.MakhoaCN = khoachuyennganh.MaKhoaCN AND sach.MaSach= $masach";
        $row2 = mysqli_query($this->conn, $qr4);
        $mang = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function show_anh_ct_sua($masach)
    {
        $qr4 = "SELECT * FROM anhchitiet WHERE anhchitiet.MaSach = $masach";
        $row2 = mysqli_query($this->conn, $qr4);
        $mang = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }

    public function chon_1_anh()
    {
        $hinhanh = $_FILES['anh']['name'];
        $foder_luu = "public/anhsach/";
        $duongdan = $foder_luu . basename($hinhanh);
        $uploadOk = 0;
        $thongbao = "";
        $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["anh"]["tmp_name"]);
        if ($check === false) {
            $uploadOk++;
        }
        // Check file size
        if ($_FILES["anh"]["size"] > 3 * 1024 * 1024) {
            $uploadOk++;
        }

        // // Allow certain file formats
        if (
            $duoifile != "jpg" && $duoifile != "png" && $duoifile != "jpeg"
            && $duoifile != "gif"
        ) {
            $uploadOk++;
        }


        // Check if file already exists
        if (file_exists($duongdan)) {
            $dem = 0;
            $ten = pathinfo($hinhanh, PATHINFO_FILENAME);
            $tenhinh = $ten . '.' . $duoifile;
            while (file_exists($foder_luu . $tenhinh)) {
                $dem++;
                $hinhanh = $ten . $dem . '.' . $duoifile;
                $tenhinh = $hinhanh;
            }
            $duongdan = $foder_luu . basename($hinhanh);
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            move_uploaded_file($_FILES["anh"]["tmp_name"], $duongdan);
        } else {
            $thongbao = "Vui lòng kiểm tra lại hình ảnh đại diện";
        }
        $kq = array("thongbao" => $thongbao, "duongdan" => $duongdan, "check" => $uploadOk);
        return $kq;
    }
    public function chon_nhieu_anh()
    {
        $anh = $_FILES['n_anh'];
        $dem_anh = count($anh["name"]);
        $foder_luu = "public/anhchitiet_sach/";
        //biến thông báo
        $uploadOk = 0;
        $so_hinh_luu = 0;
        $thongbao2 = "";
        for ($i = 0; $i < $dem_anh; $i++) {
            $duongdan = $foder_luu . basename($anh["name"][$i]);

            $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
            $check = getimagesize($anh["tmp_name"][$i]);
            //kiểm tra có phải là ảnh không
            if ($check === false) {
                $uploadOk++;
            }
            //kiểm tra size ảnh
            if ($anh["size"][$i] > 3 * 1024 * 1024) {
                $uploadOk++;
            }
            //kiểm tra đuôi ảnh
            if ($duoifile != "jpg" && $duoifile != "png" && $duoifile != "jpeg" && $duoifile != "gif") {
                $uploadOk++;
            }
        }
        //tối đa 4 tấm hình
        // if($dem_anh > 5){
        //     $uploadOk ++;
        // } 
        //mang luu duong dan;
        $mangluu = array();
        if ($uploadOk == 0) {
            for ($i = 0; $i < $dem_anh; $i++) {
                $duongdan = $foder_luu . basename($anh["name"][$i]);
                $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
                $check = getimagesize($anh["tmp_name"][$i]);
                //kiểm tra ảnh có tồn tại không
                if (file_exists($duongdan)) {
                    $dem = 0;
                    $ten = pathinfo($anh["name"][$i], PATHINFO_FILENAME);
                    $tenhinh = $ten . '.' . $duoifile;
                    while (file_exists($foder_luu . $tenhinh)) {
                        $dem++;
                        $anh["name"][$i] = $ten . $dem . '.' . $duoifile;
                        $tenhinh = $anh["name"][$i];
                    }
                    $duongdan = $foder_luu . basename($anh["name"][$i]);
                }

                //upload anh    
                if (move_uploaded_file($anh["tmp_name"][$i], $duongdan)) {
                    $mangluu[] = $duongdan;
                    $so_hinh_luu++;
                }
            }
        } else {
            $thongbao2 = "Vui lòng kiểm tra lại những hình ảnh chi tiết";
        }
        $kq = array("check2" => $uploadOk, "thongbao" => $thongbao2, "duongdan" => $mangluu, "so_hinh_luu" => $so_hinh_luu);
        return $kq;
    }
    public function showDSKhoa()
    {
        $sql = "SELECT * FROM `khoahoc`";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function showloaisach()
    {
        $sql = "SELECT * FROM loaisach ORDER BY `MaLoaiSach` DESC";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function showloaisach_cansua($id)
    {
        $result = false;
        $mang = array();
        try {
            $sql = "SELECT * FROM `loaisach` WHERE `MaLoaiSach` =$id ";

            $row = mysqli_query($this->conn, $sql);
            if ($row->num_rows == 0) {
                $result = false;
            } else {
                $result = true;
                while ($kq = mysqli_fetch_array($row)) {
                    $mang[] = $kq;
                }
            }
        } catch (Exception $e) {
            $result = false;
        }
        $mang['check'] = $result;
        return json_encode($mang);
    }
    public function sualoaisach($id, $tenloaisach)
    {
        $result = false;
        try {
            $qr = "UPDATE `loaisach` SET `TenLoaiSach`='$tenloaisach' WHERE `MaLoaiSach`='$id' ";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }
    public function m_xoaloaisach($id)
    {
        $result = false;
        try {
            $qr = "DELETE FROM `loaisach` WHERE `MaLoaiSach`= $id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }
    public function Themloaisach($TenLoaiSach)
    {
        $result = false;
        try {
            $qr = "INSERT INTO `loaisach`(`TenLoaiSach`) VALUES ('$TenLoaiSach')";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }


    public function showNhanVien()
    {
        $result = false;
        $sql = "SELECT * FROM `nhanvien` WHERE `MaQuyen`=1";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function addTacGia($TenTacGia)
    {
        $result = false;
        $qr = "INSERT INTO tacgia(TenTG) VALUE ('$TenTacGia')";
        if (mysqli_query($this->conn, $qr)) {
            $result = true;
        }
        return $result;
    }

    public function showKhoaCN()
    {
        $result = false;
        $sql = "SELECT * FROM khoachuyennganh";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function newSinhVien($MSSV, $TenSV, $CMND, $GioiTinh, $MaKhoa, $MatKhau, $KhoaCN)
    {
        $result = false;
        try {
            $qr = "INSERT INTO sinhvien(`MSSV`, `HoTen`, `CMND`, `GioiTinh`, `MaKhoa`, `MaQuyen`, `MatKhau`, `MaKhoaCN`) 
        VALUE ('$MSSV','$TenSV','$CMND','$GioiTinh','$MaKhoa','3','$MatKhau','$KhoaCN')";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            } else {
                $result = false;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }

    public function showSinhVien()
    {
        $sql = "SELECT * FROM sinhvien,khoahoc,khoachuyennganh 
        WHERE sinhvien.MaKhoa = khoahoc.MaKhoaHoc and sinhvien.MaKhoaCN = khoachuyennganh.MaKhoaCN";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }

    public function showTacGia()
    {
        $sql = "SELECT * FROM tacgia";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }

    public function addKhoaHoc($TenKhoaHoc, $NamBatDau)
    {
        $result = false;
        try {
            $qr = "INSERT INTO khoahoc(TenKhoaHoc,NamBatDau) VALUE ('$TenKhoaHoc','$NamBatDau')";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }
    public function showKhoaHoc()
    {
        $sql = "SELECT * FROM khoahoc";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }

    public function xoasach($id)
    {
        $result = false;
        try {
            $qr = "DELETE FROM `sach` WHERE `MaSach`=$id";
            $qr1 = "SELECT * FROM `sach` WHERE `MaSach`=$id";
            if ($row = mysqli_query($this->conn, $qr1)) {
                $kq = mysqli_fetch_assoc($row);
                $hinh_xoa = $kq['AnhDaiDien'];
                $file_xoa = $kq['file'];

                if (mysqli_query($this->conn, $qr)) {
                    $result = true;
                    unlink($hinh_xoa);
                    if ($file_xoa != null) {
                        unlink($file_xoa);
                    }
                }
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }

    public function ex_loaisach()
    {
        $qr3 = "SELECT * FROM `loaisach`";
        $row = mysqli_query($this->conn, $qr3);
        $mang = array();
        while ($kq = mysqli_fetch_assoc($row)) {
            $mang[] = $kq;
        }
        return $mang;
    }
    public function ex_tacgia()
    {
        $qr3 = "SELECT * FROM `tacgia`";
        $row = mysqli_query($this->conn, $qr3);
        $mang = array();
        while ($kq = mysqli_fetch_assoc($row)) {
            $mang[] = $kq;
        }
        return $mang;
    }
    public function ex_khoacn()
    {
        $qr3 = "SELECT * FROM `khoachuyennganh`";
        $row = mysqli_query($this->conn, $qr3);
        $mang = array();
        while ($kq = mysqli_fetch_assoc($row)) {
            $mang[] = $kq;
        }
        return $mang;
    }
    public function chon_1_anh_ex($file_anh)
    {
        $hinhanh = $file_anh['name'];
        $foder_luu = "public/anhsach/";
        $duongdan = $foder_luu . basename($hinhanh);
        $uploadOk = 0;
        $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($file_anh["tmp_name"]);
        if ($check === false) {
            $uploadOk++;
        }
        // Check file size
        if ($file_anh["size"] > 3 * 1024 * 1024) {
            $uploadOk++;
        }

        // // Allow certain file formats
        if (
            $duoifile != "jpg" && $duoifile != "png" && $duoifile != "jpeg"
            && $duoifile != "gif"
        ) {
            $uploadOk++;
        }
        return $uploadOk;
    }

    public function luu_anh_ex($file_anh)
    {
        $hinhanh = $file_anh['name'];
        $foder_luu = "public/anhsach/";
        $duongdan = $foder_luu . basename($hinhanh);
        $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
        // Check if file already exists
        if (file_exists($duongdan)) {
            $dem = 0;
            $ten = pathinfo($hinhanh, PATHINFO_FILENAME);
            $tenhinh = $ten . '.' . $duoifile;
            while (file_exists($foder_luu . $tenhinh)) {
                $dem++;
                $hinhanh = $ten . $dem . '.' . $duoifile;
                $tenhinh = $hinhanh;
            }
            $duongdan = $foder_luu . basename($hinhanh);
        }

        move_uploaded_file($file_anh["tmp_name"], $duongdan);

        return $duongdan;
    }

    public function luu_nhieu_anh_ex($file_anh)
    {
        $anh = $file_anh;
        $dem_anh = count($anh["name"]);
        $foder_luu = "public/anhchitiet_sach/";
        $mangluu = array();
        for ($i = 0; $i < $dem_anh; $i++) {
            $duongdan = $foder_luu . basename($anh["name"][$i]);
            $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
            //kiểm tra ảnh có tồn tại không
            if (file_exists($duongdan)) {
                $dem = 0;
                $ten = pathinfo($anh["name"][$i], PATHINFO_FILENAME);
                $tenhinh = $ten . '.' . $duoifile;
                while (file_exists($foder_luu . $tenhinh)) {
                    $dem++;
                    $anh["name"][$i] = $ten . $dem . '.' . $duoifile;
                    $tenhinh = $anh["name"][$i];
                }
                $duongdan = $foder_luu . basename($anh["name"][$i]);
            }

            //upload anh    
            if (move_uploaded_file($anh["tmp_name"][$i], $duongdan)) {
                $mangluu[] = $duongdan;
            }
        }
        return $mangluu;
    }



    public function themsach_ex($tensach, $noidungngan, $soluong, $ngaynhap, $anh_mot, $n_anh, $gia, $maloaisach, $matacgia, $makhoacn, $file_sach)
    {
        try {
            $anh = $this->luu_anh_ex($anh_mot);
            $nhieu_anh = $this->luu_nhieu_anh_ex($n_anh);
            if ($maloaisach == 1) {
                $qr4 = "INSERT INTO `sach` (`MaSach`, `TenSach`, `Noidungngan`, `SoLuong`, `NgayNhap`, `AnhDaiDien`, `Gia`, `MaLoaiSach`, `MaTacGia`,`MakhoaCN`) VALUES (NULL, '$tensach', '$noidungngan', '$soluong', '$ngaynhap', '$anh', '$gia', '$maloaisach', '$matacgia','$makhoacn')";
            } else if ($maloaisach == 2) {
                $dd_file_pdf = $this->chon_up_file_pdf($file_sach);
                $qr4 = "INSERT INTO `sach` (`MaSach`, `TenSach`, `Noidungngan`, `SoLuong`, `NgayNhap`, `AnhDaiDien`, `Gia`, `MaLoaiSach`, `MaTacGia`,`MakhoaCN`,`file`) VALUES (NULL, '$tensach', '$noidungngan', '$soluong', '$ngaynhap', '$anh', '$gia', '$maloaisach', '$matacgia','$makhoacn','$dd_file_pdf')";
            }
            $kq = false;
            if (mysqli_query($this->conn, $qr4)) {
                $kq = true;
                $masach = $this->conn->insert_id;
                for ($i = 0; $i <  count($nhieu_anh); $i++) {
                    $dd_nhieu_anh = $nhieu_anh[$i];
                    $qr5 = "INSERT INTO `anhchitiet` (`MaSach`, `id`, `Link`) VALUES ('$masach', NULL, '$dd_nhieu_anh')";
                    if (mysqli_query($this->conn, $qr5)) {
                        $kq = true;
                    }
                }
            }
        } catch (Exception $e) {
            $kq = false;
        }

        return $kq;
    }

    public function suatacgia($id, $tentacgia)
    {
        $result = false;
        try {
            $qr = "UPDATE `tacgia` SET `TenTG`='$tentacgia' WHERE `MaTG`=$id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }

    public function showtacgia_cansua($id)
    {
        $result = false;
        $mang = array();
        try {
            $sql = "SELECT * FROM `tacgia` WHERE `MaTG` =$id ";

            $row = mysqli_query($this->conn, $sql);
            if ($row->num_rows == 0) {
                $result = false;
            } else {
                $result = true;
                while ($kq = mysqli_fetch_array($row)) {
                    $mang[] = $kq;
                }
            }
        } catch (Exception $e) {
            $result = false;
        }
        $mang['check'] = $result;
        return json_encode($mang);
    }

    public function m_xoatacgia($id)
    {
        $result = false;
        try {
            $qr = "DELETE FROM `tacgia` WHERE `MaTG`= $id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }


    public function chon_1_file($file_sach)
    {
        $hinhanh = $file_sach['name'];
        $foder_luu = "public/file_sach/";
        $duongdan = $foder_luu . basename($hinhanh);
        $uploadOk = 0;
        $thongbao = "";
        $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($file_sach["tmp_name"]);

        // Check file size
        if ($file_sach["size"] > 5 * 1024 * 1024) {
            $uploadOk++;
        }

        // // Allow certain file formats
        if ($duoifile != "pdf") {
            $uploadOk++;
        }


        // Check if file already exists
        if (file_exists($duongdan)) {
            $dem = 0;
            $ten = pathinfo($hinhanh, PATHINFO_FILENAME);
            $tenhinh = $ten . '.' . $duoifile;
            while (file_exists($foder_luu . $tenhinh)) {
                $dem++;
                $hinhanh = $ten . $dem . '.' . $duoifile;
                $tenhinh = $hinhanh;
            }
            $duongdan = $foder_luu . basename($hinhanh);
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            move_uploaded_file($file_sach["tmp_name"], $duongdan);
        } else {
            $thongbao = "Vui lòng kiểm tra lại file sách";
        }
        $kq = array("thongbao" => $thongbao, "duongdan_file" => $duongdan, "check3" => $uploadOk);
        return $kq;
    }

    public function kiemtra_pdf($file_sach)
    {
        $hinhanh = $file_sach['name'];
        $foder_luu = "public/file_sach/";
        $duongdan = $foder_luu . basename($hinhanh);
        $uploadOk = 0;
        $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
        // Check file size
        if ($file_sach["size"] > 5 * 1024 * 1024) {
            $uploadOk++;
        }

        // // Allow certain file formats
        if ($duoifile != "pdf") {
            $uploadOk++;
        }
        return $uploadOk;
    }
    public function chon_up_file_pdf($file_sach)
    {
        $hinhanh = $file_sach['name'];
        $foder_luu = "public/file_sach/";
        $duongdan = $foder_luu . basename($hinhanh);
        $duoifile = strtolower(pathinfo($duongdan, PATHINFO_EXTENSION));
        // Check if file already exists
        if (file_exists($duongdan)) {
            $dem = 0;
            $ten = pathinfo($hinhanh, PATHINFO_FILENAME);
            $tenhinh = $ten . '.' . $duoifile;
            while (file_exists($foder_luu . $tenhinh)) {
                $dem++;
                $hinhanh = $ten . $dem . '.' . $duoifile;
                $tenhinh = $hinhanh;
            }
            $duongdan = $foder_luu . basename($hinhanh);
        }
        // Check if $uploadOk is set to 0 by an error
        move_uploaded_file($file_sach["tmp_name"], $duongdan);
        return $duongdan;
    }

    public function check_tenkh($TenKhoa)
    {
        $qr3 = "SELECT * FROM `khoahoc` WHERE `TenKhoaHoc`='$TenKhoa'";
        $row = mysqli_query($this->conn, $qr3);
        $kq = $row->num_rows;
        $rs = false;
        if ($kq == 0) {
            $rs = true;
        } else {
            $rs = false;
        }
        return $rs;
    }

    public function showkhoahoc_cansua($id)
    {
        $result = false;
        $mang = array();
        try {
            $sql = "SELECT * FROM `khoahoc` WHERE `MaKhoaHoc` =$id ";

            $row = mysqli_query($this->conn, $sql);
            if ($row->num_rows == 0) {
                $result = false;
            } else {
                $result = true;
                while ($kq = mysqli_fetch_array($row)) {
                    $mang[] = $kq;
                }
            }
        } catch (Exception $e) {
            $result = false;
        }
        $mang['check'] = $result;
        return json_encode($mang);
    }

    public function suakhoahoc($id, $tenkhoahoc, $nam)
    {
        $result = false;
        try {
            $qr = "UPDATE `khoahoc` SET `TenKhoaHoc`='$tenkhoahoc',`NamBatDau`='$nam' WHERE `MaKhoaHoc`= $id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }
    public function m_xoakhoahoc($id)
    {
        $result = false;
        try {
            $qr = "DELETE FROM `khoahoc` WHERE `MaKhoaHoc`= $id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }

    public function themkhoacn($tenkhoacn)
    {
        $result = false;
        try {
            $qr = "INSERT INTO `khoachuyennganh`(`TenCN`) VALUES ('$tenkhoacn')";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }

    public function showkhoacn_cansua($id)
    {
        $result = false;
        $mang = array();
        try {
            $sql = "SELECT * FROM `khoachuyennganh` WHERE `MaKhoaCN` =$id ";

            $row = mysqli_query($this->conn, $sql);
            if ($row->num_rows == 0) {
                $result = false;
            } else {
                $result = true;
                while ($kq = mysqli_fetch_array($row)) {
                    $mang[] = $kq;
                }
            }
        } catch (Exception $e) {
            $result = false;
        }
        $mang['check'] = $result;
        return json_encode($mang);
    }

    public function suakhoacn($id, $tenkhoacn)
    {
        $result = false;
        try {
            $qr = "UPDATE `khoachuyennganh` SET `TenCN`='$tenkhoacn' WHERE `MaKhoaCN`=$id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }

    public function m_xoakhoacn($id)
    {
        $result = false;
        try {
            $qr = "DELETE FROM `khoachuyennganh` WHERE `MaKhoaCN`= $id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }
    public function check_mssv($id)
    {
        $qr3 = "SELECT * FROM `sinhvien` WHERE `MSSV`='$id'";
        $row = mysqli_query($this->conn, $qr3);
        $kq = $row->num_rows;
        $rs = false;
        if ($kq == 0) {
            $rs = true;
        } else {
            $rs = false;
        }
        return $rs;
    }
    public function showsv_cansua($id)
    {
        $result = false;
        $mang = array();
        try {
            $sql = "SELECT * FROM sinhvien,khoachuyennganh,khoahoc WHERE sinhvien.MaKhoa = khoahoc.MaKhoaHoc AND sinhvien.MaKhoaCN = khoachuyennganh.MaKhoaCN AND IDSV=$id ";
            $row = mysqli_query($this->conn, $sql);
            if ($row->num_rows == 0) {
                $result = false;
            } else {
                $result = true;
                while ($kq = mysqli_fetch_array($row)) {
                    $mang[] = $kq;
                }
            }
        } catch (Exception $e) {
            $result = false;
        }
        $mang['check'] = $result;
        return json_encode($mang);
    }

    public function sua_SinhVien($id, $TenSV, $CMND, $GioiTinh, $MaKhoa, $KhoaCN)
    {
        $result = false;
        try {
            $qr = "UPDATE `sinhvien` SET `HoTen`='$TenSV',`CMND`='$CMND',`GioiTinh`='$GioiTinh',`MaKhoa`='$MaKhoa',`MaKhoaCN`='$KhoaCN' WHERE `IDSV`=$id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            } else {
                $result = false;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }

    public function m_xoasv($id)
    {
        $result = false;
        try {
            $qr = "DELETE FROM `sinhvien` WHERE `IDSV`= $id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }
    public function check_cnmd($id)
    {
        $qr3 = "SELECT * FROM `sinhvien` WHERE `CMND`='$id'";
        $row = mysqli_query($this->conn, $qr3);
        $kq = $row->num_rows;
        $rs = false;
        if ($kq == 0) {
            $rs = true;
        } else {
            $rs = false;
        }
        return $rs;
    }
    public function check_cnmd_gv($id)
    {
        $qr3 = "SELECT * FROM `nhanvien` WHERE `Cmnd_gv`='$id'";
        $row = mysqli_query($this->conn, $qr3);
        $kq = $row->num_rows;
        $rs = false;
        if ($kq == 0) {
            $rs = true;
        } else {
            $rs = false;
        }
        return $rs;
    }
    public function ThemNhanVien($TenNhanVien, $GioiTinh, $CMND, $pass)
    {
        try {
            $result = false;
            $qr = "INSERT INTO nhanvien(TenNV,GioiTinh,MaQuyen,Cmnd_gv,Matkhau_gv) VALUE ('$TenNhanVien','$GioiTinh','1','$CMND','$pass')";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            } else {
                $result = false;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }

    public function shownv_cansua($id)
    {
        $result = false;
        $mang = array();
        try {
            $sql = "SELECT * FROM `nhanvien` WHERE`MaNV`=$id";
            $row = mysqli_query($this->conn, $sql);
            if ($row->num_rows == 0) {
                $result = false;
            } else {
                $result = true;
                while ($kq = mysqli_fetch_array($row)) {
                    $mang[] = $kq;
                }
            }
        } catch (Exception $e) {
            $result = false;
        }
        $mang['check'] = $result;
        return json_encode($mang);
    }

    public function sua_nhanvien($id, $TenNV, $GioiTinh)
    {
        $result = false;
        try {
            $qr = "UPDATE `nhanvien` SET `TenNV`='$TenNV',`GioiTinh`='$GioiTinh' WHERE `MaNV`='$id'";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            } else {
                $result = false;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }

    public function m_xoanv($id)
    {
        $result = false;
        try {
            $qr = "DELETE FROM `nhanvien` WHERE `MaNV`=$id";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return json_encode($result);
    }

    public function kiemtra_taikhoan($id)
    {
        $qr = "SELECT * FROM `nhanvien` WHERE`MaNV`=$id";
        $row = mysqli_query($this->conn, $qr);
        $kq = mysqli_fetch_array($row);
        return json_encode($kq);
    }

    public function kiemtra_taikhoan_sv($id)
    {
        $qr = "SELECT * FROM `sinhvien` WHERE `IDSV`=$id";
        $row = mysqli_query($this->conn, $qr);
        $kq = mysqli_fetch_array($row);
        return json_encode($kq);
    }

    public function quenmatkhau($id,$matkhau)
    {
        $result = false;
        try {
            $qr = "UPDATE `sinhvien` SET `MatKhau`='$matkhau' WHERE `IDSV`='$id'";
            if (mysqli_query($this->conn, $qr)) {
                $result = true;
            } else {
                $result = false;
            }
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }
    public function duyetsach()
    {
        $query = "SELECT  phieumuon.MaPhieuMuon, sinhvien.HoTen, phieumuon.TongSoSachMuon, phieumuon.NgayMuon ,sinhvien.MSSV
        FROM `phieumuon`, sinhvien 
        WHERE sinhvien.IDSV = phieumuon.IDSV and TrangThai = 'Đang Đặt' and phieumuon.TongSoSachMuon > 0";
        $row = mysqli_query($this->conn,$query);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function duyetsachdangmuon()
    {
        $query = "SELECT
        phieumuon.MaPhieuMuon,
        sinhvien.HoTen,
        phieumuon.TongSoSachMuon,
        phieumuon.NgayMuon,
        phieutrasach.NgayTra,
        phieumuon.MaDatSach
    FROM
        phieumuon,
        sinhvien,
        phieutrasach
    WHERE
        sinhvien.IDSV = phieumuon.IDSV AND phieumuon.TrangThai = 'Đang Mượn' and phieutrasach.MaPhieuMuon = phieumuon.MaPhieuMuon";
        $row = mysqli_query($this->conn,$query);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function ThemVaoPhieuTra($MaPhieu){
        try {
            $select = "SELECT * FROM `phieumuon` WHERE phieumuon.MaPhieuMuon = '$MaPhieu'";
            $row = mysqli_query($this->conn,$select);
            $mang = array();
            while ($kq = mysqli_fetch_array($row)) {
                $mang[] = $kq;
            }
            $SoLuong = $mang[0]["TongSoSachMuon"];
            $NgayTra = $mang[0]['NgayMuon'];
            $qr = "SELECT
                    chitietphieumuon.MaPhieuMuon,
                    chitietphieumuon.MaSach,
                    sach.SoLuong
                FROM
                    phieumuon,
                    chitietphieumuon, 
                    sach
                WHERE
                    chitietphieumuon.MaPhieuMuon = phieumuon.MaPhieuMuon
                    and sach.MaSach = chitietphieumuon.MaSach
                    and chitietphieumuon.MaPhieuMuon = '$MaPhieu'";
            $dulieu = mysqli_query($this->conn,$qr);
            $list = array();
            while ($rs = mysqli_fetch_array($dulieu)) {
                $list[] = $rs;
            }
            foreach($list as $arr){
                $sl = $arr["SoLuong"];
                if($sl == 0){
                    $result = false;
                    return ($result);
                    exit();
                }
            }
            $getDay = "SELECT DATE_ADD(CURDATE(), INTERVAL 30 DAY) as NgayTra";
            $row2 = mysqli_query($this->conn,$getDay);
            $mang2 = array();
            while ($kq2 = mysqli_fetch_array($row2)) {
                $mang2[] = $kq2;
            }
            $NgayTra = $mang2[0]['NgayTra'];
            
            $MaPhieuDat = crc32("$MaPhieu-$NgayTra");
            $query = "INSERT INTO `phieutrasach`(
                `MaPhieuMuon`,
                `NgayTra`,
                `TongSoLuong`,
                `TrangThai`,
                `MaDatSach`
            )
            VALUES(
                '$MaPhieu',
                '$NgayTra',
                '$SoLuong',
                'Đang Mượn',
                '$MaPhieuDat'
            )";
            
            if (mysqli_query($this->conn, $query)) {
                foreach($list as $arr){
                    $ms = $arr["MaSach"];
                    $up = "UPDATE sach set sach.SoLuong = sach.SoLuong - 1 WHERE sach.MaSach = '$ms';"; 
                    if(mysqli_query($this->conn, $up)){
                        
                    }               
                }
                return (true) ;            
            }            
        } catch (\Throwable $th) {
            return (false) ;
        }
        
    }
    public function DuyetTraSach($MaPhieu)
    {
        try {
            $update = "UPDATE `phieutrasach` SET `TrangThai`='Hoàn Tất' WHERE MaPhieuMuon = $MaPhieu";
            if(mysqli_query($this->conn,$update)){
                $qr = "SELECT
                    chitietphieumuon.MaPhieuMuon,
                    chitietphieumuon.MaSach,
                    sach.SoLuong
                FROM
                    phieumuon,
                    chitietphieumuon, 
                    sach
                WHERE
                    chitietphieumuon.MaPhieuMuon = phieumuon.MaPhieuMuon
                    and sach.MaSach = chitietphieumuon.MaSach
                    and chitietphieumuon.MaPhieuMuon = '$MaPhieu'";
                $dulieu = mysqli_query($this->conn,$qr);
                $list = array();
                while ($rs = mysqli_fetch_array($dulieu)) {
                    $list[] = $rs;
                }                
                foreach($list as $arr){
                    $ms = $arr["MaSach"];
                    $up = "UPDATE sach set sach.SoLuong = sach.SoLuong + 1 WHERE sach.MaSach = '$ms';"; 
                    if(mysqli_query($this->conn, $up)){
                        
                    }               
                }
                return (true) ; 
            }
        } catch (\Throwable $th) {
            return (false) ;
        }
        
    }

    public function ThongKeSachMuon()
    {
        $query = 'SELECT
            sinhvien.IDSV,
            sinhvien.MSSV,
            sinhvien.HoTen,    
            GROUP_CONCAT(DISTINCT sach.TenSach SEPARATOR ", ") AS TenSach,    
            phieutrasach.NgayTra    
        FROM
            sinhvien,
            sach,
            phieumuon,
            chitietphieumuon, 
            phieutrasach
        WHERE
            sinhvien.IDSV = phieumuon.IDSV and
            sach.MaSach = chitietphieumuon.MaSach AND
            phieumuon.TrangThai = "Đang Mượn" AND
            phieumuon.MaPhieuMuon = chitietphieumuon.MaPhieuMuon and
            phieumuon.MaPhieuMuon = phieutrasach.MaPhieuMuon
        GROUP BY sinhvien.IDSV';
        $row = mysqli_query($this->conn,$query);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function SachChuaTra()
    {
        $query = 'SELECT
            sinhvien.IDSV, sinhvien.MSSV, phieutrasach.NgayTra, sinhvien.HoTen,  GROUP_CONCAT(DISTINCT sach.TenSach SEPARATOR ", ") AS TenSach, phieutrasach.MaDatSach,
            phieumuon.NgayMuon, phieumuon.TongSoSachMuon
        FROM
            phieutrasach, sach, sinhvien,chitietphieumuon, phieumuon
        WHERE
            phieutrasach.MaPhieuMuon = chitietphieumuon.MaPhieuMuon AND
            sach.MaSach = chitietphieumuon.MaSach AND
            sinhvien.IDSV = phieumuon.IDSV AND
            chitietphieumuon.MaPhieuMuon = phieumuon.MaPhieuMuon AND
            CURDATE() > phieutrasach.NgayTra 
        GROUP BY sinhvien.HoTen';
        $row = mysqli_query($this->conn,$query);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function laymadatsach($MaPhieu)
    {
        $query="SELECT MaDatSach FROM `phieumuon` WHERE phieumuon.MaPhieuMuon = '$MaPhieu'";
        $row = mysqli_query($this->conn,$query);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return ($mang[0]);
    }
    public function sachbithieu($MaPhieu)
    {
        $query='SELECT
            sach.TenSach,
            sach.SoLuong
        FROM
            chitietphieumuon,
            sach
        WHERE
            chitietphieumuon.MaPhieuMuon = '.$MaPhieu.' AND
            sach.MaSach = chitietphieumuon.MaSach';
        $row = mysqli_query($this->conn,$query);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        $str = array();
        foreach($mang as $arr){
            $sl = $arr["SoLuong"];
            if($sl == 0){
                $str[] = $arr["TenSach"];                
            }
        }
        return $str;
    }

    public function laysoluongsach()
    {
        $query='SELECT 
            khoachuyennganh.TenCN,          
            count(sach.MakhoaCN) as SoLuong
        FROM
            sach, khoachuyennganh
        WHERE
            sach.MakhoaCN = khoachuyennganh.MaKhoaCN 
        GROUP by sach.MakhoaCN';
        $row = mysqli_query($this->conn,$query);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        // $sl = array();
        // foreach($mang as $arr){
        //     $sl[] = $arr["SoLuong"];            
        // }
        return ($mang);
    }
}
