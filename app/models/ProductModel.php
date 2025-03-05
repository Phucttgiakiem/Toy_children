<?php 
    require_once "../app/core/Database.php";
    class ProductModel extends Database {
        public function getAllProductwithType ($id){
            $sql = "SELECT * FROM SanPham WHERE BiXoa = 0 ORDER BY NgayNhap DESC LIMIT 0,4";
            $stmt = $this->execute($sql,[$id]);
            return $stmt->get_result()->fetch_assoc();
        }
        public function getAllProduct ($offset){
            $offset = (int)$offset;
            $sql = "SELECT * FROM SanPham WHERE BiXoa = 0 ORDER BY NgayNhap DESC LIMIT 8 OFFSET ?";
            $stmt = $this->fetchAll($sql,[$offset]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getOneProduct ($id){
            $sql = "SELECT s.MaSanPham, s.TenSanPham, s.GiaSanPham,s.SoLuongTon,s.SoLuocXem,s.HinhURL,s.MoTa,h.TenHangSanXuat,l.TenLoaiSanPham FROM
            SanPham s,HangSanXuat h, LoaiSanPham l WHERE s.BiXoa = 0 AND s.MaHangSanXuat = h.MaHangSanXuat AND s.MaLoaiSanPham = l.MaLoaiSanPham AND s.MaSanPham = $id";
            $stmt = $this->fetchOne($sql);
            if (!$stmt){
                return "error 404";
            }
            return $stmt;
        }
    }
?>