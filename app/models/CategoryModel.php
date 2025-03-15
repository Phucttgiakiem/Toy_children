<?php 
    require_once str_replace("models","core",__DIR__) ."/Database.php";
    class CategoryModel extends Database {
        public function getAllCategory () {
            $sql = "SELECT * FROM LoaiSanPham WHERE Bixoa = 0";
            $stmt = $this->fetchAll($sql);
            return $stmt;
        }
    }
?>