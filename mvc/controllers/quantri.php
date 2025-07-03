<?php
class quantri extends controllers
{
    // public $Location = "Location: http://localhost:8080/LiveServer/";
    public $Location = "Location: http://localhost/LiveServer";
    public $Location2 = "Location: http://localhost/LiveServer/quantri";
    public function __construct()
    {
        $this->sach = $this->model("danhsach");
        $this->mk =  $this->model("xl_dn");
     
    }
    public function sayhi()
    {
        if (isset($_SESSION["dangnhap"])) {
            header($this->Location);
        } 
        $this->view("trangchu", [
            "page" => "v_dangnhap",
            "phanloai" => $this->sach->loaisach(),
            "khoacn" => $this->sach->Khoacn(),
            "hiden" => 1,
            "phanquyen" => 1
        ]);
    }
    public function xldn()
    {
        if (isset($_SESSION["dangnhap"])) {
            header($this->Location);
        } else {
            if (isset($_POST["dangnhap"]) && isset($_POST["mssv"]) && isset($_POST["matkhau"])) {
                if (!empty($_POST["mssv"]) && !empty($_POST["matkhau"])) {
                    $mssv = $_POST["mssv"];
                    $matkhau = $_POST["matkhau"];
                    $this->view("trangchu", [
                        "page" => "v_dangnhap",
                        "phanloai" => $this->sach->loaisach(),
                        "khoacn" => $this->sach->Khoacn(),
                        "hiden" => 1,
                        "dangnhap" => $this->mk->ktdn_gv($mssv, $matkhau),
                        "phanquyen" => 1
                    ]);

                    //  if(isset($_SESSION["dangnhap"]))
                    // $mahoa_matkhau=password_hash($matkhau,PASSWORD_DEFAULT);
                    // $a=password_hash($mssv,PASSWORD_DEFAULT);
                    //pass:123 sv

                } else {
                    $this->view("trangchu", [
                        "page" => "v_dangnhap",
                        "phanloai" => $this->sach->loaisach(),
                        "khoacn" => $this->sach->Khoacn(),
                        "hiden" => 1,
                        "dangnhap" => json_encode("Không bỏ tróng dữ liệu"),
                        "phanquyen" => 1

                    ]);
                }
            } else {
                $this->view("trangchu", [
                    "page" => "v_dangnhap",
                    "phanloai" => $this->sach->loaisach(),
                    "khoacn" => $this->sach->Khoacn(),
                    "hiden" => 1,
                    "dangnhap" => json_encode("Vui lòng đăng nhập"),
                    "phanquyen" => 1
                ]);
            }
        }
    }
    public function dangxuat()
    {
        if (isset($_SESSION["dangnhap"])) {
            unset($_SESSION["dangnhap"]);
            header($this->Location2);
        } else {
            header($this->Location2);
        }
    }
}
