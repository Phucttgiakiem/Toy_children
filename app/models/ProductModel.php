<?php 
    require_once "../app/core/Database.php";
    class ProductModel extends Database {
        public function getAllProductwithType ($id){
            $sql = "SELECT * FROM SanPham WHERE BiXoa = 0 ORDER BY NgayNhap DESC LIMIT 0,4";
            $stmt = $this->execute($sql,[$id]);
            return $stmt->get_result()->fetch_assoc();
        }
        public function getAllProduct ($offset,$limit = 8){
            $offset = (int)$offset;
            $sql = "SELECT * FROM SanPham WHERE BiXoa = 0 ORDER BY NgayNhap DESC LIMIT $limit OFFSET ?";
            $stmt = $this->fetchAll($sql,[$offset]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getAllProductmanage ($offset,$limit = 8){
            $offset = (int)$offset;
            $sql = "SELECT * FROM SanPham ORDER BY NgayNhap DESC LIMIT $limit OFFSET ?";
            $stmt = $this->fetchAll($sql,[$offset]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getOneProduct ($id){
            $sql = "SELECT s.MaSanPham, s.TenSanPham, s.GiaSanPham,s.SoLuongTon,s.SoLuongBan,s.SoLuocXem,s.HinhURL,s.MoTa,h.TenHangSanXuat,l.TenLoaiSanPham,h.MaHangSanXuat,l.MaLoaiSanPham FROM
            SanPham s,HangSanXuat h, LoaiSanPham l WHERE s.MaHangSanXuat = h.MaHangSanXuat AND s.MaLoaiSanPham = l.MaLoaiSanPham AND s.MaSanPham = $id";
            $stmt = $this->fetchOne($sql);
            
            return $stmt ? $stmt : null;
        }
        public function getCountProduct(){
            $sql = "SELECT COUNT(*) AS total FROM SanPham";
            $stmt = $this->fetchOne($sql);
            return $stmt['total'];
        }
        public function getCountProductlock(){
            $sql = "SELECT COUNT(*) AS total FROM SanPham WHERE BiXoa = 1";
            $stmt = $this->fetchOne($sql);
            return $stmt['total'];
        }
        public function updateProduct($sql,$params){
            $stmt = $this->execute($sql,$params);
            return $stmt;
        }
        public function findproductindetailbill ($sql,$id){
            $stmt = $this->Countitem($sql,$param=[$id]);
            return $stmt;
        }
        public function deleteproduct($sql,$params){
            $stmt = $this->execute($sql,$params);
            return $stmt;
        }
        public function createproduct($sql,$params){
            return $this->execute($sql,$params);
        }
    }
?>