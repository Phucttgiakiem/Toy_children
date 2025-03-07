<?php 
    require_once "../app/core/Database.php";
    class BillModel extends Database {
        public function getListbill ($page){
            $offset = ((int)$page - 1)*8;
            $sql = "SELECT * FROM DonDatHang ORDER BY NgayLap DESC LIMIT 8 OFFSET ?";
            $stmt = $this->fetchAll($sql,[$offset]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getDetailbill ($id){
            // lấy chi tiêt đơn hàng
            $sql = "SELECT sp.TenSanPham,sp.HinhURL,ct.SoLuong,ct.GiaBan FROM ChiTietDonDatHang ct,SanPham sp
             WHERE MaDonDatHang = ?";
            $stmt = $this->fetchAll($sql,[$id]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getInfobill ($id){
            // lấy thông tin đơn hàng
            $sql = "SELECT i.MaDonDatHang. i.NgayLap, i.TongThanhTien, u.TenHienThi, u.DiaChi,u.DienThoai,u.Email,
            t.TenTinhTrang
             FROM DonDatHang i, TaiKhoan u, TinhTrang t WHERE u.BiXoa = 0 AND i.MaTaiKhoan = u.MaTaiKhoan AND
                i.MaTinhTrang = t.MaTinhTrang AND i.MaDonDatHang = $id";
            $stmt = $this->fetchOne($sql);
            if (!$stmt) {
                return "error 404"; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt;
        }
        public function updatestatusbill ($id,$idstatus){
            if($idstatus != 4 && $idstatus != 1){
                $sql = "SELECT ct.MaSanPham,ct.SoLuong,sp.SoLuongBan FROM ChiTietDonDatHang ct,SanPham sp 
                WHERE ct.MaSanPham = sp.MaSanPham AND ct.MaDonDatHang = $id";
                $stmt = $this->fetchAll($sql);
                if (!$stmt) {
                    return 3; // lỗi kiểm tra sản phẩm bán ra
                }else if ($stmt[0]['SoLuong'] > $stmt[0]['SoLuongBan']) {
                    return 4; // không đủ sản phẩm để mua hàng
                }
            }
            $sql = "UPDATE DonDatHang SET MaTinhTrang = ? WHERE MaDonDatHang = ?";
            $stmt = $this->execute($sql,[$idstatus,$id]);
            if (!$stmt) {
                return 1; //lỗi cập nhật trạng thái đơn đặt hàng
            }
            return 2; // đặt hàng thành công
        }
    }
?>