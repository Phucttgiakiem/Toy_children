<?php 
    require_once "../app/core/Database.php";
    class UserModel extends Database {
        public function handleaccount ($username,$password){
            $sql = "SELECT * FROM TaiKhoan
                WHERE BiXoa = 0
                AND TenDangNhap = '$username'
                AND MatKhau = '$password'";
            $stmt = $this->fetchOne($sql);
            return $stmt;
        }
        public function handleregister () {
            $username = $_POST['newusername'];
            $password = $_POST['newpass'];
            $tenhienthi = $_POST['newtenhienthi'];
            $Diachi = $_POST['newdiachi'];
            $dienthoai = $_POST['newdienthoai'];
            $Email = $_POST['newemail'];
            // kiem tra ten tai khoan da co nguoi xu dung hay chua
            $sql = "SELECT * FROM Taikhoan WHERE BiXoa = 0
                    AND ( TenDangNhap = '$username' OR MatKhau = '$password' )";
            $stmt = $this->fetchOne($sql);
            if(!$stmt){
                $sql = "INSERT INTO TaiKhoan (TenDangNhap,MatKhau,TenHienThi,DiaChi,DienThoai,Email,MaLoaiTaiKhoan) VALUES (?,?,?,?,?,?,?)";
                $params = [$username,$password,$tenhienthi,$Diachi,$dienthoai,$Email,1];
                $newstmt = $this->execute($sql,$params);
                if($newstmt){
                    return 1; //tạo mới thành công
                }
                else return 2; // tạo mới thất bại
            }
            return 3; // tài khoản đã có tên hoặc pass giống với tài khoản tạo mới
        }
    }
?>