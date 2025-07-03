<?php
class admin extends controllers
{
    // public $Location = "Location: http://localhost:8080/LiveServer/";
     public $Location = "Location: http://localhost/LiveServer";
    public function __construct()
    {
        $this->sach = $this->model("danhsach");

        if (isset($_SESSION["dangnhap"][2]) == false) {
            $_SESSION['thongbao'] = "vui lòng nhập đúng với mã quyền của bạn";
            header($this->Location);
        }
    }
    public function sayhi()
    {
        $thongtinsach =  $this->model("M_admin");
        $this->view("trangchu", [
            "page" => "qlsach",
            "phanloai" => $this->sach->loaisach(),
            "thongtinsach" => $thongtinsach->ad_thongtinsach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }
    public function themsach()
    {
        //&& isset($_POST['tensach']) && isset($_POST['MaLoaiSach']) && isset($_POST['MaTacGia']) && isset($_POST['Gia']) && isset($_POST['SoLuong']) &&  isset($_FILES['anh'])  && isset($_FILES['n_anh']) && isset($_POST['time']) && isset($_POST['noidungngan']) 
        $nam = $this->model('M_admin');
        if (isset($_POST['gui'])) {
            if (
                !empty($_POST["tensach"]) && !empty($_POST["MaLoaiSach"]) && !empty($_POST["MaTacGia"]) && !empty($_POST["Gia"])
                && !empty($_POST["SoLuong"]) && !empty($_FILES["anh"]) && !empty($_FILES["n_anh"]) && !empty($_POST["time"]) && !empty($_POST["noidungngan"]) && !empty($_POST["MaCN"])
            ) {
                $tensach = $_POST["tensach"];
                $maloaisach = $_POST["MaLoaiSach"];
                $matacgia = $_POST["MaTacGia"];
                $gia = $_POST["Gia"];
                $soluong = $_POST["SoLuong"];
                $makhoacn = $_POST["MaCN"];
                //
                /*
            $anh = $_FILES["anh"];
            $n_anh = $_FILES["n_anh"];
            */
                //
                $thoigian = $_POST["time"];
                $noidungngan = $_POST["noidungngan"];
                if (isset($_FILES["file_sach"]) && !empty($_FILES["file_sach"]['name'])) {
                    $file_tailieu = $_FILES["file_sach"];
                    $this->view("trangchu", [
                        "page" => "ThemSach",
                        "phanloai" => $this->sach->loaisach(),
                        "thongbao_themsach" => $nam->themsach_tailieu($tensach, $noidungngan, $soluong, $thoigian/*,$anh*/, $gia, $maloaisach, $matacgia, $makhoacn, $file_tailieu),
                        "tacgia" => $this->sach->tacgia(),
                        "khoacn" => $nam->khoacn()
                    ]);
                } else {
                    $this->view("trangchu", [
                        "page" => "ThemSach",
                        "phanloai" => $this->sach->loaisach(),
                        "thongbao_themsach" => $nam->themsach($tensach, $noidungngan, $soluong, $thoigian/*,$anh*/, $gia, $maloaisach, $matacgia, $makhoacn),
                        "tacgia" => $this->sach->tacgia(),
                        "khoacn" => $nam->khoacn()
                    ]);
                }
            } else {
                echo "nhập đủ thông tin";
            }
        } else {
            $this->view("trangchu", [
                "page" => "ThemSach",
                "phanloai" => $this->sach->loaisach(),
                "tacgia" => $this->sach->tacgia(),
                "khoacn" => $nam->khoacn()
            ]);
        }
    }
    public function suasach($masach)
    {
        $admin = $this->model('M_admin');
        if (isset($_POST['gui'])) {
            if (
                !empty($_POST["tensach"]) && !empty($_POST["MaTacGia"]) && !empty($_POST["Gia"])
                && !empty($_POST["SoLuong"]) && !empty($_POST["time"]) && !empty($_POST["noidungngan"]) && !empty($_POST["MaCN"])
            ) {
                $tensach = $_POST["tensach"];
                $matacgia = $_POST["MaTacGia"];
                $gia = $_POST["Gia"];
                $soluong = $_POST["SoLuong"];
                $ngaynhap = $_POST["time"];
                $noidungngan = $_POST["noidungngan"];
                $makhoacn = $_POST["MaCN"];
                if (empty($_FILES['anh']['name'])  && !empty($_FILES['n_anh']['name'][0]) && empty($_FILES['file_sach']['name'])) {
                    //update ảnh chi tiết
                    $this->view("trangchu", [
                        "page" => "ThemSach",
                        "kq_suasach" => $admin->sua_anhct($masach),
                        "show_suasach" => $admin->show_sach_sua($masach),
                        "ha_ct" => $admin->show_anh_ct_sua($masach),
                        "phanloai" => $this->sach->loaisach(),
                        "tacgia" => $this->sach->tacgia(),
                        "khoacn" => $admin->khoacn(),
                        "suasach" => 1,
                    ]);
                } else if (empty($_FILES['n_anh']['name'][0]) && !empty($_FILES['anh']['name']) && empty($_FILES['file_sach']['name'])) {
                    //update ảnh đại diện
                    $anhdaidien = $admin->show_sach_sua($masach);
                    $this->view("trangchu", [
                        "page" => "ThemSach",
                        "kq_suasach" => $admin->sua_anhdd($masach),
                        "show_suasach" => $admin->show_sach_sua($masach),
                        "ha_ct" => $admin->show_anh_ct_sua($masach),
                        "phanloai" => $this->sach->loaisach(),
                        "tacgia" => $this->sach->tacgia(),
                        "khoacn" => $admin->khoacn(),
                        "suasach" => 1,
                        "xoahinh_old" => $anhdaidien
                    ]);
                } else if (empty($_FILES['anh']['name']) && empty($_FILES['n_anh']['name'][0]) && empty($_FILES['file_sach']['name'])) {
                    //update nội dung
                    $this->view("trangchu", [
                        "page" => "ThemSach",
                        "kq_suasach" => $admin->sua_noidung($masach, $tensach, $noidungngan, $soluong, $ngaynhap, $gia, $matacgia, $makhoacn),
                        "show_suasach" => $admin->show_sach_sua($masach),
                        "ha_ct" => $admin->show_anh_ct_sua($masach),
                        "phanloai" => $this->sach->loaisach(),
                        "tacgia" => $this->sach->tacgia(),
                        "khoacn" => $admin->khoacn(),
                        "suasach" => 1,
                    ]);
                } else {
                    $anhdaidien = $admin->show_sach_sua($masach);
                    $this->view("trangchu", [
                        "page" => "ThemSach",
                        "kq_suasach" => $admin->suasach($masach, $tensach, $noidungngan, $soluong, $ngaynhap, $gia, $matacgia, $makhoacn),
                        "show_suasach" => $admin->show_sach_sua($masach),
                        "ha_ct" => $admin->show_anh_ct_sua($masach),
                        "phanloai" => $this->sach->loaisach(),
                        "tacgia" => $this->sach->tacgia(),
                        "khoacn" => $admin->khoacn(),
                        "suasach" => 1,
                        "xoahinh_old" => $anhdaidien
                    ]);
                }
            }
        } else {
            $this->view("trangchu", [
                "page" => "ThemSach",
                "show_suasach" => $admin->show_sach_sua($masach),
                "ha_ct" => $admin->show_anh_ct_sua($masach),
                "phanloai" => $this->sach->loaisach(),
                "tacgia" => $this->sach->tacgia(),
                "khoacn" => $admin->khoacn(),
                "suasach" => 1,
            ]);
        }
    }
    public function ql_ls()
    {
        $admin = $this->model('M_admin');
        $this->view("trangchu", [
            "page" => "loaisach",
            "phanloai" => $this->sach->loaisach(),
            "thongtinloaisach" => $admin->showloaisach(),
            "khoacn" => $admin->khoacn(),
        ]);
    }

    public function giaovien()
    {
        echo "day la quan ly giao vien";
    }
    //sinh viên
    public function showSinhVien()
    {
        $kq = $this->model("M_admin");
        $this->view("trangchu", [
            "page" => "showSV",
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
            "ketquaKhoa" =>  $kq->showDSKhoa(),
            "ketquaCN" => $kq->showKhoaCN(),
            "kq_sv" => $kq->showSinhVien()
        ]);
    }

    public function addkhoacn()
    {
        if (isset($_POST['submit']) && isset($_POST['TenKhoa'])) {
            if (!empty($_POST['TenKhoa'])) {
                $TenKhoa = $_POST['TenKhoa'];

                $kq = $this->model("M_admin")->addKhoa($TenKhoa);

                $this->view("trangchu", [
                    "page" => "Khoa",
                    "result" => $kq
                ]);
            }
        }
    }
    public function showKhoaCN()
    {
        $kq_khoaCN = $this->model("M_admin")->showKhoaCN();
        $this->view("trangchu", [
            "page" => "showKhoaCN",
            "kq_khoaCN" => $kq_khoaCN,
            "khoacn" => $this->sach->Khoacn(),
            "phanloai" => $this->sach->loaisach(),
        ]);
    }
    public function addTacGia()
    {
        if (isset($_POST['btn_themtg']) && isset($_POST['tentacgia'])) {
            if (!empty($_POST['tentacgia'])) {
                $admin = $this->model("M_admin");
                $TenTacGia = $_POST['tentacgia'];
                $kq = $admin->addTacGia($TenTacGia);
                echo json_encode($kq);
            } else {
                echo json_encode(false);
            }
        }
    }
    public function showTacGia()
    {
        $admin = $this->model('M_admin');
        $this->view("trangchu", [
            "page" => "showTacGia",
            "kq_tg" =>  $admin->showTacGia(),
            "phanloai" => $this->sach->loaisach(),
            "thongtinsach" => $admin->ad_thongtinsach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }
    //nhân viên
    public function ShowNV()
    {
        if($_SESSION["dangnhap"][2] != 2){
            header('Location: http://localhost/LiveServer/');
        }
        $kq = $this->model("M_admin")->showNhanVien();
        $this->view("trangchu", [
            "page" => "showNV",
            "result" => $kq,
            "khoacn" => $this->sach->Khoacn(),
            "phanloai" => $this->sach->loaisach(),
        ]);
    }

    public function KhoaHoc()
    {
        $admin = $this->model('M_admin');
        $this->view("trangchu", [
            "page" => "showKhoaHoc",
            "kq_KhoaHoc" =>  $admin->showKhoaHoc(),
            "phanloai" => $this->sach->loaisach(),
            "thongtinsach" => $admin->ad_thongtinsach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }
    public function addKhoaHoc()
    {
        try{
            if (!empty($_POST['TenKhoaHoc']) && !empty($_POST['NamBatDau'])) {
                $admin = $this->model("M_admin");
                $TenKhoaHoc = $_POST['TenKhoaHoc'];
                $NamBatDau = $_POST['NamBatDau'];
                $kq = $admin->addKhoaHoc($TenKhoaHoc, $NamBatDau);
                echo json_encode($kq);
            }
            else{
                echo json_encode(false);
            }
        }  catch (Exception $e) {
            echo json_encode(false);
        }


    }
    

    public function showKhoaHoc()
    {
        $kq = $this->model("M_admin")->showKhoaHoc();
        $this->view("trangchu", [
            "page" => "showKhoaHoc",
            "kq_KhoaHoc" => $kq
        ]);
    }
    public function thongke()
    {
        echo "day la thong ke";
    }
    public function muontra()
    {
        echo "day la muon tra";
    }
    public function themfile_excel()
    {
        $thongtinsach =  $this->model("M_admin");
        $this->view("trangchu", [
            "page" => 'themfileExcel',
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }
    public function check_tenkhoahoc()
    {
        $admin =  $this->model("M_admin");
        if(!empty($_POST['tenkhoahoc'])){
            $tenkhoahoc = $_POST['tenkhoahoc'];
            $kq = $admin->check_tenkh($tenkhoahoc);
            echo  json_encode($kq);
        }
        else{
            echo  json_encode(false);
        }
    }
    public function themkhoacn()
    {
        try{
            if (!empty($_POST['tenkhoacn'])) {
                $admin = $this->model("M_admin");
                $tenkhoacn = $_POST['tenkhoacn'];
                $kq = $admin->themkhoacn($tenkhoacn);
                echo json_encode($kq);
            }
            else{
                echo json_encode(false);
            }
        }  catch (Exception $e) {
            echo json_encode(false);
        }


    }

    public function check_mssv()
    {
        $admin = $this->model("M_admin");
        if(!empty($_POST['mssv'])){
            $mssv = $_POST['mssv'];
            $kq = $admin->check_mssv($mssv);
            echo json_encode($kq);
        }
        else{
            echo json_encode(3);
        }
       
    }
    public function check_cmnd()
    {
        $admin = $this->model("M_admin");
        if(!empty($_POST['cmnd'])){
            $cmnd = $_POST['cmnd'];
            $kq = $admin->check_cnmd($cmnd);
            echo json_encode($kq);
        }
        else{
            echo json_encode(3);
        }
       
    }
    public function check_cmnd_gv()
    {
        $admin = $this->model("M_admin");
        if(!empty($_POST['CMND'])){
            $cmnd = $_POST['CMND'];
            $kq = $admin->check_cnmd_gv($cmnd);
            echo json_encode($kq);
        }
        else{
            echo json_encode(3);
        }
       
    }
       public function addsinhvien()
       {
           $kq = $this->model("M_admin");
           if (
               !empty($_POST['MSSV']) && !empty($_POST['TenSv']) && !empty($_POST['CMND']) && !empty($_POST['GioiTinh'])
               && !empty($_POST['KhoaHoc']) && !empty($_POST['KhoaCN']) && !empty($_POST['MatKhau'])
           ) {
               $MSSV = $_POST['MSSV'];
               $TenSv = $_POST['TenSv'];
               $CMND = $_POST['CMND'];
               $GioiTinh = $_POST['GioiTinh'];
               $KhoaHoc = $_POST['KhoaHoc'];
               $KhoaCN = $_POST['KhoaCN'];
               $MatKhau = password_hash($_POST['MatKhau'], PASSWORD_DEFAULT);
                $check_mssv = $kq->check_mssv($MSSV);
                $check_cnnd = $kq->check_cnmd($CMND);
                if($check_mssv == true && $check_cnnd == true){
                    $themsv = $kq->newSinhVien($MSSV, $TenSv, $CMND, $GioiTinh, $KhoaHoc, $MatKhau, $KhoaCN);
                    echo json_encode($themsv);
                }else{
                    echo json_encode(3);
                }
           } else {
            echo json_encode(4);
           }
       }
       public function addNV()
    {
        $admin = $this->model("M_admin");
            if (!empty($_POST['TenNhanVien']) && !empty($_POST['GioiTinh']) && !empty($_POST['CMND']) && !empty($_POST['pass'])) {
                $TenNhanVien = $_POST['TenNhanVien'];
                $GioiTinh = $_POST['GioiTinh'];
                $CMND = $_POST['CMND'];
                $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $check_cmnd = $admin->check_cnmd_gv($CMND);
                if($check_cmnd == true){
                    $kq= $admin->ThemNhanVien($TenNhanVien, $GioiTinh, $CMND, $pass);
                    echo json_encode($kq);
                }else {
                    echo json_encode(3);
                }
                
               
            }else{
                echo json_encode(4);
            }
        
    }
    public function DuyetDanhSachMuon()
    {
        $this->view("trangchu",[
            "page"=>"duyetdanhsach",
            "sachcanduyet" => $this->model("M_admin")->duyetsach(),
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }
    public function DuyetDanhSachTra(){
        $this->view("trangchu",[
            "page"=>"trasach",
            "sachcanduyet" => $this->model("M_admin")->duyetsachdangmuon(),
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }
    public function ThongKeMuonSach()
    {
        $this->view("trangchu",[
            "page"=>"thongkemuonsach",
            "sachcanduyet" => $this->model("M_admin")->ThongKeSachMuon(),
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }

    public function SachChuaTra()
    {
        $this->view("trangchu",[
            "page"=>"trasachtre",
            "sachchuatra" => $this->model("M_admin")->SachChuaTra(),
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }
    public function char()
    {
        $this->view("trangchu",[
            "page"=> "char",
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
        ]);
    }
    

    
 

}
