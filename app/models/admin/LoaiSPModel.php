<?php 
    require_once "../app/core/Database.php";
    class LoaiSPModel extends Database{
        public function getLoaiSP(){
            $sql = "SELECT * FROM LoaiSanPham";
            $stmt = $this->fetchAll($sql);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getOneLoaiSP($id){
            $sql = "SELECT * FROM LoaiSanPham WHERE MaLoaiSanPham = $id";
            $stmt = $this->fetchOne($sql);
            return $stmt ? $stmt : null;
        }
        public function updateLoaiSP($sql,$params){
            $stmt = $this->execute($sql,$params);
            return $stmt;
        }
        public function findproductmatchwithtype ($sql,$id){
            $stmt = $this->Countitem($sql,$param=[$id]);
            return $stmt;
        }
        public function deletetypeproduct($sql,$params){
            $stmt = $this->execute($sql,$params);
            return $stmt;
        }
    }
?>