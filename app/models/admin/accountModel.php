<?php 
    require_once "../app/core/Database.php";
    class accountModel extends Database {
        public function getAlluser () {
            $sql = "SELECT * FROM TaiKhoan WHERE BiXoa = 0";
            $stmt = $this->fetchAll($sql);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getOneuser ($id){
            $sql = "SELECT u.MaTaiKhoan, u.TenDangNhap,u.TenHienThi,u.DiaChi, u.DienThoai,u.Email,l.TenLoaiTaiKhoan 
            FROM TaiKhoan u INNER JOIN LoaiTaiKhoan l ON u.MaLoaiTaiKhoan = l.MaLoaiTaiKhoan WHERE u.MaTaiKhoan = $id";
            $stmt  = $this->fetchOne($sql);
            return $stmt ? $stmt : null;
        }
    }
?>