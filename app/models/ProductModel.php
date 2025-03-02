<?php 
    require_once "../app/core/Database.php";
    class ProductModel extends Database {
        public function getAllProductwithType ($id){
            $sql = "SELECT * FROM SanPham WHERE BiXoa = 0 ORDER BY NgayNhap DESC LIMIT 0,4";
            $stmt = $this->execute($sql,[$id]);
            return $stmt->get_result()->fetch_assoc();
        }
        public function getAllProduct (){
            $sql = "SELECT * FROM SanPham WHERE BiXoa = 0 ORDER BY NgayNhap DESC LIMIT 8";
            $stmt = $this->fetchAll($sql);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
        
            return $stmt;
        }
    }
?>