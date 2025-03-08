<?php 
    require_once "../app/core/Database.php";
    class HangSXModel extends Database{
        public function getHangSX(){
            $sql = "SELECT * FROM HangSanXuat WHERE BiXoa = 0";
            $stmt = $this->fetchAll($sql);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
    }
?>