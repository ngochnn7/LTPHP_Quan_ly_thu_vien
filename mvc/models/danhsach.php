<?php
class danhsach extends db
{
    private $sotin1trang = 8;

    public function loaisach()
    {   
        $qr3 = "SELECT * FROM `loaisach`";
        $row = mysqli_query($this->conn, $qr3);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function tacgia(){
        $qr3 = "SELECT * FROM `tacgia`";
        $row = mysqli_query($this->conn, $qr3);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    // WHERE `MaLoaiSach`=$id
    public function thongtinsach_theoloai($id,$trang)
    {
        $tranghientai = ($trang - 1) * $this->sotin1trang;
        $qr4 = "SELECT * FROM `sach`  WHERE `MaLoaiSach`=$id ORDER BY `MaSach` DESC LIMIT  $tranghientai,$this->sotin1trang";
        $row2 = mysqli_query($this->conn, $qr4);

        $mang = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang[] = $kq;
        }
        return  json_encode($mang);
    }

    public function chitiet_sach($id)
    {
        $qr3 = "SELECT * FROM `sach`,loaisach,tacgia,khoachuyennganh WHERE sach.MaLoaiSach = loaisach.MaLoaiSach and sach.MaTacGia =tacgia.MaTG and sach.MaKhoaCN =khoachuyennganh.MaKhoaCN AND `MaSach`=$id ";
        $row = mysqli_query($this->conn, $qr3);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function chitiet_anh($id)
    {
        $qr3 = "SELECT * FROM `anhchitiet` WHERE MaSach = $id ";
        $row = mysqli_query($this->conn, $qr3);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
    public function sotrang(){
        $qr3 = "SELECT MaSach FROM `sach`";
        $row = mysqli_query($this->conn, $qr3);
        $tong_so_sp = $row->num_rows;
        return ceil($tong_so_sp / $this->sotin1trang);
        
    }
    public function sotrang_theoloai($id){
        $qr3 = "SELECT MaSach FROM `sach` WHERE MaLoaiSach=$id";
        $row = mysqli_query($this->conn, $qr3);
        $tong_so_sp = $row->num_rows;
        return ceil($tong_so_sp / $this->sotin1trang);
        
    }

    public function phantrang_sach($trang)
    {
        $tranghientai = ($trang - 1) * $this->sotin1trang;
        $qr4 = "SELECT * FROM `sach` ORDER BY `MaSach` DESC  LIMIT  $tranghientai,$this->sotin1trang ";
        $row2 = mysqli_query($this->conn, $qr4);
        $mang = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }

    public function sotrang_theotimkiem($tensach){
        $qr3 = "SELECT MaSach FROM `sach` WHERE `TenSach` LIKE '%$tensach%' ORDER BY `MaSach` DESC";
        $row = mysqli_query($this->conn, $qr3);
        $tong_so_sp = $row->num_rows;
        return ceil($tong_so_sp / $this->sotin1trang);
        
    }
    //SELECT * FROM sach,loaisach,tacgia,khoachuyennganh WHERE sach.MaLoaiSach = loaisach.MaLoaiSach and sach.MaTacGia = tacgia.MaTG and sach.MakhoaCN = khoachuyennganh.MaKhoaCN AND sach.TenSach LIKE '%Giao trinh%'OR loaisach.TenLoaiSach LIKE '%Giao trinh%' OR tacgia.TenTG LIKE '%Giao trinh%' OR khoachuyennganh.TenCN LIKE '%Giao trinh%';
    public function timkiemtensach($trang,$tensach){
        $tranghientai = ($trang - 1) * $this->sotin1trang;
        $qr4 = "SELECT sach.MaSach , sach.TenSach,sach.Noidungngan,sach.SoLuong,sach.NgayNhap,sach.AnhDaiDien,sach.Gia,sach.MaLoaiSach,sach.MaTacGia,sach.MakhoaCN,sach.file FROM sach,loaisach,tacgia,khoachuyennganh WHERE sach.MaLoaiSach = loaisach.MaLoaiSach AND loaisach.TenLoaiSach LIKE N'%$tensach%' OR sach.MaTacGia = tacgia.MaTG AND tacgia.TenTG LIKE N'%$tensach%' OR sach.MakhoaCN = khoachuyennganh.MaKhoaCN AND khoachuyennganh.TenCN LIKE N'%$tensach%'  OR sach.TenSach LIKE N'%$tensach%' GROUP BY sach.MaSach , sach.TenSach,sach.Noidungngan,sach.SoLuong,sach.NgayNhap,sach.AnhDaiDien,sach.Gia,sach.MaLoaiSach,sach.MaTacGia,sach.MakhoaCN,sach.file ORDER BY `MaSach` DESC LIMIT $tranghientai,$this->sotin1trang";
        $row2 = mysqli_query($this->conn, $qr4);
        if($row2->num_rows > 0){
            $mang = array();
            while ($kq = mysqli_fetch_array($row2)) {
                $mang[] = $kq;
            }
            return json_encode($mang);
        }
        else{
            $mang = 0;
            return json_encode($mang);
        }
     
    }

    public function Khoacn()
    {
        $qr4 = "SELECT * FROM `khoachuyennganh` ";
        $row2 = mysqli_query($this->conn, $qr4);
        $mang = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }

    public function sotrang_theokhoacn($id){
        $qr3 = "SELECT MaSach FROM `sach` WHERE MakhoaCN=$id";
        $row = mysqli_query($this->conn, $qr3);
        $tong_so_sp = $row->num_rows;
        return ceil($tong_so_sp / $this->sotin1trang);
        
    }
    public function thongtinsach_theokhoacn($id,$trang)
    {
        $tranghientai = ($trang - 1) * $this->sotin1trang;
        $qr4 = "SELECT * FROM `sach`  WHERE `MaKhoaCN`=$id ORDER BY `MaSach` DESC LIMIT  $tranghientai,$this->sotin1trang";
        $row2 = mysqli_query($this->conn, $qr4);

        $mang = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang[] = $kq;
        }
        return  json_encode($mang);
    }

    public function anhlienquan($id)
    {
        $qr4 = "SELECT * FROM sach WHERE MakhoaCN = $id ORDER BY RAND() LIMIT 4 ";
        $row2 = mysqli_query($this->conn, $qr4);
        $mang = array();
        while ($kq = mysqli_fetch_assoc($row2)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }

}
