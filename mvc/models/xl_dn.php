<?php 
class xl_dn extends db{ 
    public function ktdn($mssv,$matkhau){
        $qr = "SELECT * FROM `sinhvien` WHERE MSSV =$mssv"; // AND MatKhau='$matkhau' 
        $row = mysqli_query($this->conn, $qr);
        $num = $row->num_rows;
        $kq=null;
        if($num > 0){
            $kq_tv = mysqli_fetch_array($row);
            $mk_hash = $kq_tv["MatKhau"];
            if(password_verify($matkhau,$mk_hash) == true){
                $_SESSION["dangnhap"][0]=$kq_tv["IDSV"];
                $_SESSION["dangnhap"][1]=$kq_tv["HoTen"];
                $_SESSION["dangnhap"]["gioitinh"]=$kq_tv["GioiTinh"];
                $select = 'SELECT sum(SoLuong) as SoLuong, sinhvien.IDSV, phieumuon.TrangThai 
                FROM `chitietphieumuon`,phieumuon, sinhvien WHERE sinhvien.IDSV = '.$_SESSION["dangnhap"][0].' 
                and phieumuon.TrangThai = "Đang Đặt" and phieumuon.MaPhieuMuon = chitietphieumuon.MaPhieuMuon';
                $row = mysqli_query($this->conn, $select);
                $mang = array();
                while ($kq = mysqli_fetch_array($row)) {
                    $mang[] = $kq;
                }
                $_SESSION["SoLuongSach"]=$mang[0]["SoLuong"]; 
                $query = 'SELECT COUNT(phieumuon.MaPhieuMuon) as SoLuong 
                FROM phieumuon 
                WHERE IDSV = '.$_SESSION["dangnhap"][0].' and phieumuon.TrangThai = "Đang Mượn";'; 
                $row2 = mysqli_query($this->conn, $query);
                $mang2 = array();
                while ($kq2 = mysqli_fetch_array($row2)) {
                    $mang2[] = $kq2;
                }
                $_SESSION["ThongBao"] = $mang2[0]["SoLuong"];  
                $getCode = 'SELECT
                    sinhvien.IDSV,phieumuon.TrangThai,phieumuon.MaDatSach,sinhvien.HoTen
                FROM
                    sinhvien,
                    phieumuon
                WHERE
                    sinhvien.IDSV = '.$_SESSION["dangnhap"][0].' AND phieumuon.TrangThai = "Đang Mượn" AND sinhvien.IDSV = phieumuon.IDSV';       
                $MaDatSach = mysqli_query($this->conn,$getCode);
                $arr = array();
                while($ListMaDatSach = mysqli_fetch_array($MaDatSach)){
                    $arr[] = $ListMaDatSach;
                }
                $_SESSION["ListMaDatSach"] = $arr;
                $khoacn = $kq_tv["MaKhoa"];
                header('Location: http://localhost/LiveServer/home/chi_tiet_khoacn/'.$khoacn.'');
               // header('Location: http://localhost:8080/LiveServer/');                
                
            }
            else{
                $kq="Sai mật khẩu";
            }
            
        }
        else{
            $kq="Không tìm thấy tài khoản";
        }
        return json_encode($kq);
        
    }
    public function ktdn_gv($mssv,$matkhau){
        $qr = "SELECT * FROM `nhanvien` WHERE Cmnd_gv =$mssv "; // AND MatKhau='$matkhau' 
        $row = mysqli_query($this->conn, $qr);
        $num = $row->num_rows;
        $kq=null;
        if($num > 0){
            $kq_tv = mysqli_fetch_array($row);
            $mk_hash = $kq_tv["Matkhau_gv"];
            if(password_verify($matkhau,$mk_hash) == true){
                $_SESSION["dangnhap"][0]=$kq_tv["MaNV"];
                $_SESSION["dangnhap"][1]=$kq_tv["TenNV"];
                $_SESSION["dangnhap"][2]=$kq_tv["MaQuyen"];            
                $_SESSION["dangnhap"]["gioitinh"]=$kq_tv["GioiTinh"];
                header('Location: http://localhost/LiveServer/');
                
            }
            else{
                $kq="Sai mật khẩu";
            }
            
        }
        else{
            $kq="Không tìm thấy tài khoản";
        }
        return json_encode($kq);
        
    }
}
?>