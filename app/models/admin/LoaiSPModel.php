<?php 
    require_once "../app/core/Database.php";
    class LoaiSPModel extends Database{
        public function getLoaiSP(){
            $sql = "SELECT * FROM LoaiSanPham WHERE BiXoa = 0";
            $stmt = $this->fetchAll($sql);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
    }
?>