<?php
require_once 'public/phpspreadsheet/autoload.php';

use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Size;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ajax extends controllers
{

    public function xoa_hinhct()
    {

        $id_hinh = $_POST['hinh'];
        $admin = $this->model('M_admin');
        echo $admin->xoa_anhct($id_hinh);
    }
    public function xoasach()
    {
        $thongtinsach =  $this->model("M_admin");
        if (isset($_POST['id_sach_xoa']) && !empty($_POST['id_sach_xoa'])) {
            $idsach = $_POST['id_sach_xoa'];
            echo $thongtinsach->xoasach($idsach);
        }
    }
    public function them_ls()
    {
        $admin = $this->model('M_admin');
        if (!empty($_POST["tensach"])) {
            $tenloaisach = $_POST['tensach'];
            echo $admin->Themloaisach($tenloaisach);
        } else {
            echo json_encode(false);
        }
    }

    public function showsachsua()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['maloaisach']) && !empty($_POST['maloaisach'])) {
            $idsach = $_POST['maloaisach'];
            echo $admin->showloaisach_cansua($idsach);
        } else {
            echo json_encode(false);
        }
    }

    public function suasach()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['maloaisach']) && !empty($_POST['maloaisach']) && isset($_POST['tensach']) && !empty($_POST['tensach'])) {
            $idsach = $_POST['maloaisach'];
            $tensach = $_POST['tensach'];
            echo $admin->sualoaisach($idsach, $tensach);
        } else {
            echo json_encode(false);
        }
    }
    public function xoaloaisach()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['maloaisach']) && !empty($_POST['maloaisach'])) {
            $maloaisach = $_POST['maloaisach'];
            echo $admin->m_xoaloaisach($maloaisach);
        } else {
            echo json_encode(false);
        }
    }

    public function xemfile()
    {
        $check = false;
        $mang = array();
        if (isset($_FILES['fileExecl']) && !empty($_FILES['fileExecl']['tmp_name'])) {
            $tenfile = $_FILES['fileExecl']['tmp_name'];
            $dt = IOFactory::createReaderForFile($tenfile);
            $loadsheet = $dt->load($tenfile);
            $allsheet =  $loadsheet->getSheetNames();
            $check = true;
            $mang['file_ex'] = $tenfile;
            $mang['check'] = $check;
            $mang['kq'] = $allsheet;
            echo json_encode($mang);
        } else {
            $check = false;
            $mang['check'] = $check;
            $mang['kq'] = "không có file , vui lòng chọn file";
            echo json_encode($mang);
        }
    }
    public function dulieu_trongfile()
    {
        $check = false;
        $mang = array();
        if (isset($_FILES['fileExecl']) && !empty($_FILES['fileExecl']['tmp_name']) && isset($_POST['sheet']) && !empty($_POST['sheet'])) {
            $tenfile = $_FILES['fileExecl']['tmp_name'];
            $sheet = $_POST['sheet'];
            $dt = IOFactory::createReaderForFile($tenfile);
            $dt->setLoadSheetsOnly($sheet);
            $dt_ex = $dt->load($tenfile);
            $dl_ex = $dt_ex->getActiveSheet()->toArray('null', true, true, true);
            //*********/
            $dongcaonhat = $dt_ex->setActiveSheetIndex(0)->getHighestRow();
            $dem = 0;
            for ($i = 2; $i <= $dongcaonhat; $i++) {
                $mang[$dem]['tensach'] = $dl_ex[$i]['A'];
                $mang[$dem]['ndn_ex'] = $dl_ex[$i]['B'];
                $mang[$dem]['sl_ex'] = $dl_ex[$i]['C'];
                $mang[$dem]['ngaynhap_ex'] = $dl_ex[$i]['D'];
                $mang[$dem]['ha_ex'] = $dl_ex[$i]['E'];
                $mang[$dem]['ha_ct_ex'] = $dl_ex[$i]['F'];
                $mang[$dem]['gia_ex'] = $dl_ex[$i]['G'];
                $mang[$dem]['loaisach_ex'] = $dl_ex[$i]['H'];
                $mang[$dem]['tacgia_ex'] = $dl_ex[$i]['I'];
                $mang[$dem]['khoacn_ex'] = $dl_ex[$i]['J'];
                $mang[$dem]['file_ex'] = $dl_ex[$i]['K'];
                $mang[$dem]['stt'] =  $dem + 1;
                $dem++;
            }
            $loadsach =  $this->model("M_admin");
            $ex_load = $loadsach->ex_loaisach();
            $ex_load_tg = $loadsach->ex_tacgia();
            $ex_load_khoacn = $loadsach->ex_khoacn();
            $mang2 = array("loaisach" => $ex_load, "noidung" => $mang, "tacgia" => $ex_load_tg, "khoacn" => $ex_load_khoacn);
            echo json_encode($mang2);
            // echo $ex_load;
            //echo json_encode($mang);


        } else {
        }
    }

    public function load_ls()
    {
        $loadsach =  $this->model("M_admin");
        $ex_load = $loadsach->ex_loaisach();
        echo json_encode($ex_load);
    }
    public function load_tacgia()
    {
        $loadsach =  $this->model("M_admin");
        $ex_load_tg = $loadsach->ex_tacgia();
        echo json_encode($ex_load_tg);
    }
    public function load_khoacn()
    {
        $loadsach =  $this->model("M_admin");
        $ex_load_khoacn = $loadsach->ex_khoacn();
        echo json_encode($ex_load_khoacn);
    }

    public function luu_ex()
    {
        if (count($_POST) == 0) {
            echo json_encode("Không có file");
            exit();
        }
        $admin =  $this->model("M_admin");
        $hinhanh = array();
        $mang_kt = array();
        $mang_pdf = array();
        $dem = 0;
        $check = 0;
        $check_post = 0;
        for ($i = 0; $i < count($_FILES["file_sach"]["name"]); $i++) {
            $mang_pdf[$i]['name'] = $_FILES["file_sach"]["name"][$i];
            $mang_pdf[$i]['tmp_name'] = $_FILES["file_sach"]["tmp_name"][$i];
            $mang_pdf[$i]['size'] = $_FILES["file_sach"]["size"][$i];
        }
        unset($_FILES["file_sach"]);
        //kiểm tra file 
        foreach ($_FILES as $kq1) {
            $cout_name = count($kq1["name"]);
            for ($i = 0; $i <  $cout_name; $i++) {
                if ($kq1["name"][$i] == "") {
                    echo json_encode("File không được bỏ trống");
                    $check++;
                    exit();
                }
            }
        }
        $dem1 = 0;
        foreach ($_FILES as $kq1) {
            $cout_name = count($kq1["name"]);
            for ($i = 0; $i <  $cout_name; $i++) {
                $mang_kt[$dem1]['name'] =  $kq1["name"][$i];
                $mang_kt[$dem1]['tmp_name'] = $kq1["tmp_name"][$i];
                $mang_kt[$dem1]['size'] = $kq1["size"][$i];
                $dem1++;
            }
        }
        foreach ($mang_kt as $kq1) {
            $check +=  $admin->chon_1_anh_ex($kq1);
        }
        if ($check == 0) {
            foreach ($_FILES as $kq1) {
                $hinhanh[$dem] = $kq1;
                $hinhanh[$dem] = $kq1;
                $hinhanh[$dem] = $kq1;
                $dem++;
            }
        } else {
            echo json_encode("vui lòng kiểm tra lại file");
            exit();
        }

        // kiểm tra tất cả post
        foreach ($_POST["tensach"] as $kq1) {
            if (empty($kq1) || $kq1 == "null") {
                $check_post++;
            }
        }
        foreach ($_POST["MaLoaiSach"] as $kq1) {
            if (empty($kq1)) {
                $check_post++;
            }
        }
        foreach ($_POST["MaTacGia"] as $kq1) {
            if (empty($kq1)) {
                $check_post++;
            }
        }
        foreach ($_POST["Gia"] as $kq1) {
            if (empty($kq1)) {
                $check_post++;
            }
        }
        foreach ($_POST["SoLuong"] as $kq1) {
            if (empty($kq1)) {
                $check_post++;
            }
        }
        foreach ($_POST["time"] as $kq1) {
            if (empty($kq1)) {
                $check_post++;
            }
        }
        foreach ($_POST["noidungngan"] as $kq1) {
            if (empty($kq1) || $kq1 == "null") {
                $check_post++;
            }
        }
        foreach ($_POST["MaCN"] as $kq1) {
            if (empty($kq1)) {
                $check_post++;
            }
        }

        //thêm dữ liệu
        if ($check_post == 0 && $check == 0) {
            $mangex_them = array();
            $cout_post_tensach = count($_POST['tensach']);
            $cout_post_MaLoaiSach = count($_POST['MaLoaiSach']);
            $cout_post_MaTacGia = count($_POST['MaTacGia']);
            $cout_post_Gia = count($_POST['Gia']);
            $cout_post_SoLuong = count($_POST['SoLuong']);
            $cout_post_time = count($_POST['time']);
            $cout_post_noidungngan = count($_POST['noidungngan']);
            $cout_post_MaCN = count($_POST['MaCN']);
            $cout_post_anh = count($_FILES['anh']['name']);

            if (
                $cout_post_tensach ==  $cout_post_MaLoaiSach && $cout_post_tensach ==  $cout_post_MaTacGia && $cout_post_tensach ==  $cout_post_Gia
                && $cout_post_tensach ==  $cout_post_SoLuong && $cout_post_tensach ==  $cout_post_time && $cout_post_tensach ==  $cout_post_noidungngan
                && $cout_post_tensach ==  $cout_post_MaCN && $cout_post_tensach == $cout_post_anh
            ) {
                //kiem tra file
                for ($i = 0; $i < $cout_post_tensach; $i++) {
                    $mangex_them[$i]['tensach'] = $_POST["tensach"][$i];
                    $mangex_them[$i]['MaLoaiSach'] = $_POST["MaLoaiSach"][$i];
                    $mangex_them[$i]['MaTacGia'] = $_POST["MaTacGia"][$i];
                    $mangex_them[$i]['Gia'] = $_POST["Gia"][$i];
                    $mangex_them[$i]['SoLuong'] = $_POST["SoLuong"][$i];
                    $mangex_them[$i]['time'] = $_POST["time"][$i];
                    $mangex_them[$i]['noidungngan'] = $_POST["noidungngan"][$i];
                    $mangex_them[$i]['MaCN'] = $_POST["MaCN"][$i];
                    $mangex_them[$i]["hinhanh"]["name"] = $hinhanh[0]["name"][$i];
                    $mangex_them[$i]["hinhanh"]["tmp_name"] = $hinhanh[0]["tmp_name"][$i];
                    $mangex_them[$i]["nhieu_hinh"] = $hinhanh[$i + 1];
                    $mangex_them[$i]["file"] = $mang_pdf[$i];
                }
                $kiemtra_query_thanhcong = 0;
                $kiemtra_query_thatbai = 0;
                $check_pfd = 0;
                for ($i = 0; $i < count($mangex_them); $i++) {
                    if ($mangex_them[$i]['MaLoaiSach'] == 2 && empty($mangex_them[$i]["file"]["name"])) {
                        echo json_encode("Không có file khi loại sách là: Tài liệu");
                        exit();
                    } else if ($mangex_them[$i]['MaLoaiSach'] == 2 && !empty($mangex_them[$i]["file"]["name"])) {
                        $check_pfd +=  $admin->kiemtra_pdf($mangex_them[$i]["file"]);
                    }
                }
                //$kq = false;
                if ($check_pfd == 0) {
                    for ($i = 0; $i < count($mangex_them); $i++) {
                        $kq = $admin->themsach_ex($mangex_them[$i]['tensach'], $mangex_them[$i]['noidungngan'], $mangex_them[$i]['SoLuong'], $mangex_them[$i]['time'], $mangex_them[$i]["hinhanh"], $mangex_them[$i]["nhieu_hinh"], $mangex_them[$i]['Gia'], $mangex_them[$i]['MaLoaiSach'], $mangex_them[$i]['MaTacGia'], $mangex_them[$i]['MaCN'], $mangex_them[$i]['file']);

                        if ($kq == false) {
                            $kiemtra_query_thatbai++;
                        } else {
                            $kiemtra_query_thanhcong++;
                        }
                    }
                    $kq_khithem = "Số lần đã thêm thành công : " . $kiemtra_query_thanhcong . " || Số lần thêm thất bại là: " . $kiemtra_query_thatbai . "";
                    echo json_encode($kq_khithem);
                } else {
                    echo json_encode("File PDF không hợp lệ");
                }
            } else {
                echo json_encode("Kiểm tra dữ liệu nhập");
                exit();
            }
        } else {
            echo json_encode("Không bỏ trống dữ liệu");
            exit();
        }
    }
    public function layid_tacgiacansua()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['matacgia']) && !empty($_POST['matacgia'])) {
            $idtacgia = $_POST['matacgia'];
            echo $admin->showtacgia_cansua($idtacgia);
        } else {
            echo json_encode(false);
        }
    }
    public function suatacgia()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['matacgia']) && !empty($_POST['matacgia']) && isset($_POST['tentacgia']) && !empty($_POST['tentacgia'])) {
            $idtacgia = $_POST['matacgia'];
            $tentacgia = $_POST['tentacgia'];
            echo $admin->suatacgia($idtacgia, $tentacgia);
        } else {
            echo json_encode(false);
        }
    }
    public function xoatacgia()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['matacgia']) && !empty($_POST['matacgia'])) {
            $matacgia = $_POST['matacgia'];
            echo $admin->m_xoatacgia($matacgia);
        } else {
            echo json_encode(false);
        }
    }


    public function load_realtime()
    {
        $admin = $this->model('M_admin');
        $test = $admin->showloaisach();
        $cn = json_decode($test, true);
        $contents = "";
        $contents .= '<table class="table table-hover">';
        $contents .= '<thead>';
        $contents .= '<tr>';
        $contents .= '<th>mã loại sách</th>';
        $contents .= '</tr>';
        $contents .= '</thead>';
        $contents .= '<tbody>';
        foreach ($cn as $value3) {
            $contents .= '<tr>';
            $contents .= '<td>' . $value3['TenLoaiSach'] . '</td>';
            $contents .= '</tr>';
        }
        $contents .= '</tbody>';
        $contents .= '</table>';

        print_r($contents);
    }

    public function layid_khoahoccansua()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['makhoahoc']) && !empty($_POST['makhoahoc'])) {
            $idmakhoahoc = $_POST['makhoahoc'];
            echo $admin->showkhoahoc_cansua($idmakhoahoc);
        } else {
            echo json_encode(false);
        }
    }
    public function suakhoahoc()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['tenkhoahoc']) && !empty($_POST['tenkhoahoc']) && isset($_POST['nam']) && !empty($_POST['nam']) && isset($_POST['makhoahoc']) && !empty($_POST['makhoahoc'])) {
            $idkhoahoc = $_POST['makhoahoc'];
            $tenkhoahoc = $_POST['tenkhoahoc'];
            $nam = $_POST['nam'];
            echo $admin->suakhoahoc($idkhoahoc, $tenkhoahoc, $nam);
        } else {
            echo json_encode(false);
        }
    }
    public function xoakhoahoc()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['makhoahoc']) && !empty($_POST['makhoahoc'])) {
            $makhoahoc = $_POST['makhoahoc'];
            echo $admin->m_xoakhoahoc($makhoahoc);
        } else {
            echo json_encode(false);
        }
    }

    public function layid_khoacncansua()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['makhoacn']) && !empty($_POST['makhoacn'])) {
            $idmakhoacn = $_POST['makhoacn'];
            echo $admin->showkhoacn_cansua($idmakhoacn);
        } else {
            echo json_encode(false);
        }
    }

    public function suakhoacn()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['tenkcn_cs']) && !empty($_POST['tenkcn_cs']) && isset($_POST['makcn']) && !empty($_POST['makcn'])) {
            $idkhoacn = $_POST['makcn'];
            $tenkhoacn = $_POST['tenkcn_cs'];
            echo $admin->suakhoacn($idkhoacn, $tenkhoacn);
        } else {
            echo json_encode(false);
        }
    }

    public function xoakhoacn()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['macn']) && !empty($_POST['macn'])) {
            $makhoacn = $_POST['macn'];
            echo $admin->m_xoakhoacn($makhoacn);
        } else {
            echo json_encode(false);
        }
    }

    public function layid_svcansua()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['masv']) && !empty($_POST['masv'])) {
            $idsv = $_POST['masv'];
            echo $admin->showsv_cansua($idsv);
        } else {
            echo json_encode(false);
        }
    }
    public function suasinhvien()
    {
        $kq =  $this->model("M_admin");
        if (
            !empty($_POST['TenSv']) && !empty($_POST['CMND']) && !empty($_POST['GioiTinh'])
            && !empty($_POST['KhoaHoc']) && !empty($_POST['KhoaCN'] && !empty($_POST['idsv']))
        ) {
            $id = $_POST['idsv'];
            $TenSv = $_POST['TenSv'];
            $CMND = $_POST['CMND'];
            $GioiTinh = $_POST['GioiTinh'];
            $KhoaHoc = $_POST['KhoaHoc'];
            $KhoaCN = $_POST['KhoaCN'];

            $suasv = $kq->sua_SinhVien($id, $TenSv, $CMND, $GioiTinh, $KhoaHoc, $KhoaCN);
            echo json_encode($suasv);
        } else {
            echo json_encode(4);
        }
    }

    public function xoasv()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['masv']) && !empty($_POST['masv'])) {
            $masv = $_POST['masv'];
            echo $admin->m_xoasv($masv);
        } else {
            echo json_encode(false);
        }
    }

    public function layid_nvcansua()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['manv']) && !empty($_POST['manv'])) {
            $idsv = $_POST['manv'];
            echo $admin->shownv_cansua($idsv);
        } else {
            echo json_encode(false);
        }
    }

    public function suanhanvien()
    {
        $kq =  $this->model("M_admin");
        if (
            !empty($_POST['TenNhanVien']) && !empty($_POST['GioiTinh']) && !empty($_POST['idnv'])
        ) {
            $id = $_POST['idnv'];
            $Tennv = $_POST['TenNhanVien'];
            $GioiTinh = $_POST['GioiTinh'];
            $suanv = $kq->sua_nhanvien($id, $Tennv, $GioiTinh);
            echo json_encode($suanv);
        } else {
            echo json_encode(4);
        }
    }

    public function xoanv()
    {
        $admin =  $this->model("M_admin");
        if (isset($_POST['manv']) && !empty($_POST['manv'])) {
            $manv = $_POST['manv'];
            echo $admin->m_xoanv($manv);
        } else {
            echo json_encode(false);
        }
    }
    public function doimatkhau()
    {
        if (
            !empty($_POST['matkhaucu']) && !empty($_POST['matkhaumoi'])
        ) {
        $admin =  $this->model("M_admin");
        $matkhaucu = $_POST["matkhaucu"];
        $matkhaumoi = $_POST["matkhaumoi"];
        $matk = $_SESSION["dangnhap"][0];
        $kq = $admin->kiemtra_taikhoan_sv($matk);
        $thongtin_tk = json_decode($kq, true); 
        if(password_verify($matkhaucu,$thongtin_tk["MatKhau"]) == true){
            $MatKhau = password_hash($matkhaumoi, PASSWORD_DEFAULT);
            $thongbao = $admin->quenmatkhau($matk,$MatKhau);
            echo json_encode($thongbao);
        }
        else {
            echo json_encode(2);
        }

       
    }
    else {
        echo json_encode(3);
    }
    
    }
    public function datsach()
    {        
        $themsach = $this->model("sinhvien");
        $kq = $themsach->themsachvaophieu();
        if($kq == true){
            echo json_encode($kq);
        }else{
            echo json_encode($kq);
        }
       
    }

    public function xoasachkhoiphieu()
    {        
        $kq = $this->model("sinhvien")->XoaSach();                
        echo json_encode($kq);        
    }
    public function duyetphieumuon(){
        if(isset($_POST["MaPhieu"])){
            $MaPhieu = $_POST["MaPhieu"];
            $kq = $this->model("M_admin")->ThemVaoPhieuTra($MaPhieu);
            echo json_encode($kq);
        }
        else{
            echo json_encode(false);
        }
    }
    public function laymadatsach(){
        if(isset($_POST["MaPhieu"])){
            $MaPhieu = $_POST["MaPhieu"];
            $kq = $this->model("M_admin")->laymadatsach($MaPhieu);
            echo ($kq[0]);
        }
        else{
            echo json_encode(false);
        }
    }
    public function sachbithieu()
    {
        if(isset($_POST["MaPhieu"])){
            $MaPhieu = $_POST["MaPhieu"];
            $kq = $this->model("M_admin")->sachbithieu($MaPhieu);
            echo  json_encode($kq);
        }
        else{
            echo json_encode(false);
        }
    }
    public function duyettrasach()
    {
        if(isset($_POST["MaPhieu"])){
            $MaPhieu = $_POST["MaPhieu"];
            $kq = $this->model("M_admin")->DuyetTraSach($MaPhieu);
            echo json_encode($kq);
        }
        else{
            echo json_encode(false);
        }
    }

    public function laysoluongsach()
    {
        $kq = $this->model("M_admin")->laysoluongsach();
        echo json_encode ($kq);
    }

    
    public function test()
    {
        $kq = $this->model("M_admin")->showKhoaCN();
        echo $kq;
    }
    
}

