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
        public function getOneHangSX($id){
            $sql = "SELECT * FROM HangSanXuat WHERE MaHangSanXuat = $id";
            $stmt = $this->fetchOne($sql);
            return $stmt ? $stmt : null;
        }
        public function createHangSX($sql,$params){
            return $this->execute($sql,$params);
        }
        public function updateHangSX($sql,$params){
            return $this->execute($sql,$params);
        }
    }
?>