<?php class sinhvien extends db{
    public function dangnhap(){
        
    }
    public function themsachvaophieu()
    {
        $IDSV = $_SESSION["dangnhap"][0];
        $select = 'SELECT IDSV,  SUM(TongSoSachMuon) as Tong FROM `phieumuon` WHERE IDSV = '.$IDSV.' and TrangThai = "Đang Đặt" OR IDSV = '.$IDSV.' AND TrangThai = "Đang Mượn"';
        $row = mysqli_query($this->conn, $select);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        $ID = $mang[0]["IDSV"];
        $Tong = $mang[0]['Tong']; 
        $SoDong = mysqli_num_rows($row);
        $query = "SELECT phieumuon.MaPhieuMuon, IDSV, TrangThai,SUM(chitietphieumuon.SoLuong) as TongSachDangDat 
        FROM `phieumuon`,chitietphieumuon WHERE IDSV = '$IDSV' and TrangThai = 'Đang Đặt'
        and chitietphieumuon.MaPhieuMuon = phieumuon.MaPhieuMuon";
        $row2 = mysqli_query($this->conn, $query);
        $mang2 = array();
        while ($kq = mysqli_fetch_array($row2)) {
            $mang2[] = $kq;
        }
        $CheckMaPhieu = $mang2[0]['MaPhieuMuon'];
        $trangthai = $mang2[0]["TrangThai"];             
        $day = date("Y-m-d");
        $result = false;        
        $MaSach = $_SESSION["MaSach"];
        if($CheckMaPhieu == NULL || $ID == NULL){
            $qr = "INSERT INTO `phieumuon`( `IDSV`, `NgayMuon`, `TrangThai`, `TongSoSachMuon`) 
            VALUES ('$IDSV','$day','Đang Đặt','0')";
            if(mysqli_query($this->conn, $qr)){
                $result = true;
            }
            $getMa = "SELECT MaPhieuMuon, IDSV, TrangThai 
            FROM `phieumuon` WHERE IDSV = '$IDSV' and TrangThai = 'Đang Đặt'";
            $row = mysqli_query($this->conn, $getMa);
            $mang = array();
            while ($kq = mysqli_fetch_array($row)) {
                $mang[] = $kq;
            }
            $CheckMaPhieu = $mang[0]["MaPhieuMuon"];
            $ThemSach =  "INSERT INTO `chitietphieumuon`(`MaPhieuMuon`, `MaSach`, `SoLuong`) VALUES ('$CheckMaPhieu','$MaSach','1')" ;     
            if(mysqli_query($this->conn,$ThemSach)){
                $_SESSION["ThanhCong"] = 1;
                return true;
            }
            else{
                $_SESSION["ThanhCong"] = 0;
                return false;
            }
            return $result;
        }
        else{
            if($Tong < 5){
                $kq1 = false;
                $ThemSach =  "INSERT INTO `chitietphieumuon`(`MaPhieuMuon`, `MaSach`, `SoLuong`) VALUES ('$CheckMaPhieu','$MaSach','1')" ;     
                try {
                    if(mysqli_query($this->conn,$ThemSach)){
                        $kq1 = true;
                        $_SESSION["SoLuongSach"]++;
                        $_SESSION["ThanhCong"] = 1;                                  
                    }
                    
                } catch (\Throwable $th) {
                    $_SESSION["ThanhCong"] = 0;
                    $kq1 =  false;                    
                }                
                return $kq1;
            }
            return false;
        }
        
    }
    public function LayDanhSach($IDSV){ 
        $IDSV = $_SESSION["dangnhap"][0];       
        $sql = "SELECT sach.TenSach, tacgia.TenTG, chitietphieumuon.MaSach, chitietphieumuon.MaPhieuMuon 
        FROM `chitietphieumuon`, phieumuon, sach, tacgia 
        WHERE chitietphieumuon.MaPhieuMuon = phieumuon.MaPhieuMuon and phieumuon.IDSV = '$IDSV' and phieumuon.TrangThai = 'Đang Đặt' 
        and sach.MaSach = chitietphieumuon.MaSach and tacgia.MaTG = sach.MaTacGia";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }

    public function XoaSach()
    {
        $result = false;
        if(isset($_POST["MaSach"]) && isset($_POST['MaPhieuMuon'])){
            $MaSach = $_POST["MaSach"];
            $MaPhieuMuon = $_POST['MaPhieuMuon'];
            $sql = "DELETE FROM `chitietphieumuon` WHERE MaPhieuMuon = '".$MaPhieuMuon."' and MaSach = '".$MaSach."'";
            if(mysqli_query($this->conn,$sql)){
                $result = true;
                $_SESSION["SoLuongSach"]--;
            }
            else{
                $result = false;
            }
            
            return $result;
        }
        return $result;
    }
    public function tableDatSach(){
        $IDSV = $_SESSION["dangnhap"][0];
        $data = json_decode($this->LayDanhSach($IDSV),true);
        $i=1;
        foreach($data as $sach){
            echo 
            "<tr>
                <td>"; echo $i ."</td>
                <td>"; echo $sach["TenSach"] ."</td>
                <td>"; echo $sach["TenTG"] ."</td>                
            </tr>";
            $i++;
        }
    }
    public function SachDangMuon($IDSV)
    {
        $IDSV = $_SESSION["dangnhap"][0];       
        $sql = "SELECT sach.TenSach, tacgia.TenTG, chitietphieumuon.MaSach, chitietphieumuon.MaPhieuMuon 
        FROM `chitietphieumuon`, phieumuon, sach, tacgia 
        WHERE chitietphieumuon.MaPhieuMuon = phieumuon.MaPhieuMuon and phieumuon.IDSV = '$IDSV' and phieumuon.TrangThai = 'Đang Mượn' 
        and sach.MaSach = chitietphieumuon.MaSach and tacgia.MaTG = sach.MaTacGia";
        $row = mysqli_query($this->conn, $sql);
        $mang = array();
        while ($kq = mysqli_fetch_array($row)) {
            $mang[] = $kq;
        }
        return json_encode($mang);
    }
}
?>