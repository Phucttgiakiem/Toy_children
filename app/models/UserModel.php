<?php 
    require_once str_replace("models","core",__DIR__) ."/Database.php";
    class UserModel extends Database {
        public function handleaccount ($username,$password){
            $sql = "SELECT * FROM TaiKhoan
                WHERE BiXoa = 0
                AND TenDangNhap = '$username'
                AND MatKhau = '$password'";
            $stmt = $this->fetchOne($sql);
            return $stmt;
        }
        public function handleregister ($username,$password,$tenhienthi,$Diachi,$dienthoai,$Email) {
            // kiem tra ten tai khoan da co nguoi xu dung hay chua
            $sql = "SELECT * FROM Taikhoan WHERE BiXoa = 0 AND TenDangNhap = '$username'";
            $stmt = $this->fetchOne($sql);
            if(!$stmt){
                $sql = "INSERT INTO TaiKhoan(TenDangNhap,MatKhau,TenHienThi,DiaChi,DienThoai,Email,MaLoaiTaiKhoan) 
                VALUES (?,?,?,?,?,?,?)";
                $params = [$username,$password,$tenhienthi,$Diachi,$dienthoai,$Email,1];
                $newstmt = $this->execute($sql,$params);
                if($newstmt){
                    return 1; //tạo mới thành công
                }
                else return 2; // tạo mới thất bại
            }
            return 3; // tài khoản đã có tên hoặc pass giống với tài khoản tạo mới
        }
        public function handlegetpass ($email,$newpass){
            $sql = "SELECT * FROM TaiKhoan WHERE BiXoa = 0 AND Email = '$email'";
            $stmt = $this->fetchOne($sql);
            if($stmt){
                $sql = "UPDATE TaiKhoan SET MatKhau = '$newpass' WHERE Email = '$email'";
                $stmt = $this->execute($sql,[]);
                if($stmt){
                    return 0; //Lấy lại mật khẩu thành công
                }
                else{
                    return 1; //Tạo password thất bại
                }
            }
            return 2;//Email ko tồn tại trên hệ thống
        }
    }
?>