<?php
class home extends controllers
{
    public $sach;
    private $get_url;

    public function __construct()
    {
        $this->sach = $this->model("danhsach");
    }

    public function sayhi($trang = 1)
    {
        settype($trang, "integer");
        $this->get_url = $this->sach->sotrang();
        try {
            if ($trang == 0) {
                $trang = 1;
            } else if ($trang > $this->get_url) {
                $trang = 1;
            }
            ////    
            $this->view("trangchu", [
                "page" => "sach",
                "phanloai" => $this->sach->loaisach(),
                "khoacn" => $this->sach->Khoacn(),
                "thongtinsach" => $this->sach->phantrang_sach($trang),
                "sotrang" => $this->sach->sotrang(),
                "check" => 0,
                "trang" => $trang,
            ]);
        } catch (\Exception $ex) {
            http_response_code(404);
            $this->view("404", []);
            die();
        }
    }

    public function chi_tiet_loaisach($id = 1, $trang = 1)
    {
        settype($trang, "integer");
        settype($id, "integer");
        $this->get_url = $this->sach->sotrang_theoloai($id);
        try {
            if ($id <= 0 || $trang == 0) {
                $id = 1;
                $trang = 1;
            } else if ($trang > $this->get_url) {
                $id = 1;
                $trang = 1;
            }
            $this->view("trangchu", [
                "page" => "sach",
                "phanloai" => $this->sach->loaisach(),
                "khoacn" => $this->sach->Khoacn(),
                "thongtinsach" => $this->sach->thongtinsach_theoloai($id, $trang),
                "sotrang" => $this->sach->sotrang_theoloai($id),
                "check" => 1,
                "id" => $id,
                "trang" => $trang,
            ]);
        } catch (Exception $ex) {
            http_response_code(404);
            $this->view("404", []);
            die();
        }
    }

    ///////////
    public function chi_tiet_khoacn($id = 1, $trang = 1)
    {
        settype($trang, "integer");
        settype($id, "integer");
        $this->get_url = $this->sach->sotrang_theokhoacn($id);
        try {
            if ($id <= 0 || $trang == 0) {
                $id = 1;
                $trang = 1;
            } else if ($trang > $this->get_url) {
                $id = 1;
                $trang = 1;
            }
            $this->view("trangchu", [
                "page" => "sach",
                "phanloai" => $this->sach->loaisach(),
                "khoacn" => $this->sach->Khoacn(),
                "thongtinsach" => $this->sach->thongtinsach_theokhoacn($id, $trang),
                "sotrang" => $this->sach->sotrang_theokhoacn($id),
                "check" => 3,
                "id" => $id,
                "trang" => $trang,
            ]);
        } catch (Exception $ex) {
            http_response_code(404);
            $this->view("404", []);
            die();
        }
    }
    ///////////

    public function thongtinsach($id)
    {
        try {
            $makhoacn = json_decode($this->sach->chitiet_sach($id), true);
            if (empty($makhoacn)) {
                http_response_code(404);
                $this->view("404", []);
                die();
            }
            $this->view("trangchu", [
                "page" => "chitiet_sach",
                "phanloai" => $this->sach->loaisach(),
                "ctsach" => $this->sach->chitiet_sach($id),
                "khoacn" => $this->sach->Khoacn(),
                "anhlq"  => $this->sach->anhlienquan($makhoacn[0]['MaKhoaCN']),
                "ctanh" => $this->sach->chitiet_anh($id)
            ]);
        } catch (\Exception $ex) {
            http_response_code(404);
            $this->view("404", []);
            die();
        }
    }

    public function timkiem($trang = 1)
    {
        try {
            settype($trang, "integer");
            if (isset($_GET["q"]) && !empty($_GET["q"])) {
                $tensach = $_GET["q"];
                $this->get_url = $this->sach->sotrang_theotimkiem($tensach);
                if ($trang == 0) {
                    $trang = 1;
                } else if ($trang > $this->get_url) {
                    $trang = 1;
                }

                $this->view("trangchu", [
                    "page" => "sach",
                    "phanloai" => $this->sach->loaisach(),
                    "khoacn" => $this->sach->Khoacn(),
                    "thongtinsach" => $this->sach->timkiemtensach($trang, $tensach),
                    "sotrang" => $this->sach->sotrang_theotimkiem($tensach),
                    "check" => 2,
                    "trang" => $trang,
                    "tensach" => $tensach
                ]);
            } else {
                $this->view("trangchu", [
                    "page" => "sach",
                    "phanloai" => $this->sach->loaisach(),
                    "khoacn" => $this->sach->Khoacn(),
                    "thongtinsach" => $this->sach->phantrang_sach($trang),
                    "khoacn" => $this->sach->Khoacn(),
                    "sotrang" => $this->sach->sotrang(),
                    "check" => 0,
                    "trang" => $trang,
                    "thongbao" => 1,
                ]);
            }
        } catch (\Exception $ex) {
            http_response_code(404);
            $this->view("404", []);
            die();
        }
    }

    public function doimatkhau()
    {
        if (isset($_SESSION["dangnhap"]) == false) {
            header('Location: http://localhost/LiveServer/');
        } else if (isset($_SESSION["dangnhap"][2])) {
            header('Location: http://localhost/LiveServer/');
            exit();
        }
        $admin = $this->model("M_admin");
        $matk = $_SESSION["dangnhap"][0];
        if (isset($_SESSION["dangnhap"][2]) == false) {
            $this->view("trangchu", [
                "page" => "doimatkhau",
                "khoacn" => $this->sach->Khoacn(),
                "phanloai" => $this->sach->loaisach(),
                "sinhvien" => $admin->kiemtra_taikhoan_sv($matk),
            ]);
        }
    }
    public function dowload()
    {
        if (isset($_SESSION['dangnhap'])) {
            $filename = $_POST['file'];
            if (!empty($filename)) {
                $file = basename($filename);
                $foder_luu = "public/file_sach/";
                $duongdan = $foder_luu . basename($file);
                if (file_exists($duongdan)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header("Content-Disposition:File Transfer; filename=$file");
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: '.filesize($duongdan));
                    ob_clean();
                    flush();
                    readfile($duongdan);
                    exit;
                } else {

                    echo json_encode(0);
                }
            } else {

                echo json_encode(1);
            }
        } else {
            echo json_encode(2);
        }
    }



    public function datsach()
    {

        if (!isset($_SESSION["dangnhap"])) {
            // header("Location: http://localhost/LiveServer/dangnhap");
            header("Location: http://localhost:8080/LiveServer/dangnhap");
        }
        // if(isset($_SESSION["DuLieuDatSach"]) && $_SESSION["DuLieuDatSach"] == "1"){
        //     $this->view("trangchu",[
        //         "page" => "datsach",
        //         "phanloai" => $this->sach->loaisach(),
        //         "khoacn" => $this->sach->Khoacn(),  
        //         "result" =>$this->model("sinhvien")->themsachvaophieu()         
        //     ]);
        //     $_SESSION["DuLieuDatSach"] = "0";            
        // }
        $IDSV = $_SESSION["dangnhap"][0];
        $this->view("trangchu", [
            "page" => "datsach",
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
            "LayDanhSach" => $this->model("sinhvien")->LayDanhSach($IDSV),
            "SachDangMuon" => $this->model("sinhvien")->SachDangMuon($IDSV)
        ]);
    }

    public function dowload2()
    {      
            $filename = $_POST['file'];
            if (!empty($filename)) {
                $file = basename($filename);
                $foder_luu = "public/file_sach/";
                $duongdan = $foder_luu . basename($file);
                if (file_exists($duongdan)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/pdf');
                    header("Content-Disposition:attachment; filename=$file");
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: '.filesize($duongdan));
                    ob_clean();
                    flush();
                    readfile($duongdan);

                    exit;
                } else {

                    echo json_encode(0);
                }
            } else {

                echo json_encode(1);
            }
       
    }

}
