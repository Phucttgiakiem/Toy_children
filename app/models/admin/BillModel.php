<?php 
    require_once  str_replace("models\admin","core",__DIR__) ."/Database.php";
    class BillModel extends Database {
        public function getListbill ($page){
            $sql = "SELECT * FROM DonDatHang ORDER BY NgayLap DESC";
            $stmt = $this->fetchAll($sql,[]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getDetailbill ($id){
            // lấy chi tiêt đơn hàng
            $sql = "SELECT sp.TenSanPham,sp.HinhURL,ct.SoLuong,ct.GiaBan FROM ChiTietDonDatHang ct,SanPham sp
             WHERE ct.MaSanPham = sp.MaSanPham AND MaDonDatHang = ?";
            $stmt = $this->fetchAll($sql,[$id]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getInfobill ($id){
            // lấy thông tin đơn hàng
            $sql = "SELECT i.MaDonDatHang, i.NgayLap, i.TongThanhTien,i.DiaChiGiaoHang, i.GhiChu, u.TenHienThi,u.TenDangNhap, u.DienThoai,u.Email,
            t.TenTinhTrang, t.MaTinhTrang
             FROM DonDatHang i, TaiKhoan u, TinhTrang t WHERE u.BiXoa = 0 AND i.MaTaiKhoan = u.MaTaiKhoan AND
                i.MaTinhTrang = t.MaTinhTrang AND i.MaDonDatHang = $id";
            $stmt = $this->fetchOne($sql);
            if (!$stmt) {
                return "error 404"; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt;
        }
        public function updatestatusbill ($id,$idstatus){
            $sql1 = "SELECT ct.MaSanPham,ct.SoLuong,sp.SoLuongTon FROM ChiTietDonDatHang ct,SanPham sp 
            WHERE ct.MaSanPham = sp.MaSanPham AND ct.MaDonDatHang = $id";

            $stmt1 = $this->fetchAll($sql1);
            if($idstatus != 4 && $idstatus != 1){
                if (!$stmt1) {
                    return 3; // lỗi kiểm tra sản phẩm bán ra
                }else if ($stmt1[0]['SoLuong'] > $stmt1[0]['SoLuongTon']) {
                    return 4; // không đủ sản phẩm để mua hàng
                }else if ($idstatus == 3) {
                    //trừ số sản phẩm đã mua
                    foreach($stmt1 as $key => $value){
                        $sql3 = "UPDATE SanPham SET SoLuongTon = SoLuongTon - ? WHERE MaSanPham = ?";
                        $stmt3 = $this->execute($sql3,[$value['SoLuong'],$value['MaSanPham']]); 
                        if (!$stmt3) {
                            return 5; // lỗi cập nhật số lượng sản phẩm bán ra
                        }
                    }
                }
            }
            if($idstatus == 4){
                // trả lại số sản phẩm đã mua
                foreach($stmt1 as $key => $value){
                    $sql4 = "UPDATE SanPham SET SoLuongTon = SoLuongTon + ? WHERE MaSanPham = ?";
                    $stmt4 = $this->execute($sql4,[$value['SoLuong'],$value['MaSanPham']]);
                    if (!$stmt4) {
                        return 5; // lỗi cập nhật số lượng sản phẩm bán ra
                    }
                }   
            }
            // cập nhật trạng thai đơn hàng
            $sql2 = "UPDATE DonDatHang SET MaTinhTrang = ? WHERE MaDonDatHang = ?";
            $stmt2 = $this->execute($sql2,[$idstatus,$id]);
            if (!$stmt2) {
                return 1; //lỗi cập nhật trạng thái đơn đặt hàng
            }
            return 2; // đặt hàng thành công
        }
        public function getStatus(){
            $sql = "SELECT * FROM TinhTrang";
            $stmt = $this->fetchAll($sql);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt;
        }
    }
?>