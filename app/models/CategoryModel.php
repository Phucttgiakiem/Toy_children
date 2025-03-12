<?php 
    require_once "../app/core/Database.php";
    class CategoryModel extends Database {
        public function getAllCategory () {
            $sql = "SELECT * FROM LoaiSanPham WHERE Bixoa = 0";
            $stmt = $this->fetchAll($sql);
            return $stmt;
        }
    }
?>