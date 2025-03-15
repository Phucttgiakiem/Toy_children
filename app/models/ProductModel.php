<?php 
    require_once str_replace("models","core",__DIR__) ."/Database.php";
    class ProductModel extends Database {
        public function getAllProductwithType ($id){
            $sql = "SELECT * FROM SanPham WHERE BiXoa = 0 ORDER BY NgayNhap DESC LIMIT 0,4";
            $stmt = $this->execute($sql,[$id]);
            return $stmt->get_result()->fetch_assoc();
        }
        public function getAllProduct ($offset,$limit = 8){
            $offset = (int)$offset;
            $sql = "SELECT * FROM SanPham WHERE BiXoa = 0 ORDER BY NgayNhap DESC LIMIT $limit OFFSET ?";
            $stmt = $this->fetchAll($sql,[$offset]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getAllProductwithrequire($company=null,$typeproduct=null,$search=""){
            // Khởi tạo mảng chứa các điều kiện lọc
            $conditions = ["BiXoa = 0"];
            $params = [];

            if($search !== ""){
                $conditions[] = "TenSanPham LIKE ?";
                $params[] = "%$search%";
            }

            // Thêm điều kiện lọc theo công ty nếu có
            if ($company !== null) {
                $conditions[] = "MaHangSanXuat = ?";
                $params[] = $company;
            } 

            // Thêm điều kiện lọc theo loại sản phẩm nếu có
            if ($typeproduct !== null ) {
                $conditions[] = "MaLoaiSanPham = ?";
                $params[] = $typeproduct;
            } 

            

            // Xây dựng câu lệnh SQL với các điều kiện lọc
            $sql = "SELECT * FROM SanPham WHERE " . implode(" AND ", $conditions);

            // Thêm phần sắp xếp và giới hạn kết quả
            $sql .= " ORDER BY NgayNhap DESC";

            // Thực thi câu lệnh SQL
            $stmt = $this->fetchAll($sql, $params);

            // Kiểm tra kết quả
            if (!$stmt) {
                return [];
            }
            return $stmt;
        }
        public function getAllProductmanage ($offset,$limit = 8){
            $offset = (int)$offset;
            $sql = "SELECT * FROM SanPham ORDER BY NgayNhap DESC LIMIT $limit OFFSET ?";
            $stmt = $this->fetchAll($sql,[$offset]);
            if (!$stmt) {
                return []; // Trả về mảng rỗng nếu có lỗi
            }
            return $stmt; 
        }
        public function getOneProduct ($id){
            $sql = "SELECT s.MaSanPham, s.TenSanPham, s.GiaSanPham,s.SoLuongTon,s.SoLuongBan,s.SoLuocXem,s.HinhURL,s.MoTa,h.TenHangSanXuat,l.TenLoaiSanPham,h.MaHangSanXuat,l.MaLoaiSanPham FROM
            SanPham s,HangSanXuat h, LoaiSanPham l WHERE s.MaHangSanXuat = h.MaHangSanXuat AND s.MaLoaiSanPham = l.MaLoaiSanPham AND s.MaSanPham = $id";
            $stmt = $this->fetchOne($sql);
            
            return $stmt ? $stmt : null;
        }
        public function getCountProduct(){
            $sql = "SELECT COUNT(*) AS total FROM SanPham";
            $stmt = $this->fetchOne($sql);
            return $stmt['total'];
        }
        public function getCountProductwithparameters ($search,$company,$typeproduct,$price){
            // Khởi tạo mảng chứa các điều kiện lọc
            $conditions = ["BiXoa = 0"];
            $params = [];

            // Thêm điều kiện lọc theo tìm kiếm tên sản phẩm nếu có
            if ($search !== "") {
                $conditions[] = "TenSanPham LIKE ?";
                $params[] = "%$search%";
            }

            // Thêm điều kiện lọc theo công ty nếu có
            if ($company !== null && is_array($company)) {
                // Xử lý nếu company là một mảng
                $placeholders = implode(',', array_fill(0, count($company), '?'));
                $conditions[] = "MaHangSanXuat IN ($placeholders)";
                $params = array_merge($params, $company);
            } elseif ($company !== null && $company !== "") {
                // Xử lý nếu company chỉ là một giá trị đơn
                $conditions[] = "MaHangSanXuat = ?";
                $params[] = $company;
            }

            // Thêm điều kiện lọc theo loại sản phẩm nếu có
            if ($typeproduct !== null && is_array($typeproduct)) {
                // Xử lý nếu typeproduct là một mảng
                $placeholders = implode(',', array_fill(0, count($typeproduct), '?'));
                $conditions[] = "MaLoaiSanPham IN ($placeholders)";
                $params = array_merge($params, $typeproduct);
            } elseif ($typeproduct !== null && $typeproduct !== "") {
                // Xử lý nếu typeproduct chỉ là một giá trị đơn
                $conditions[] = "MaLoaiSanPham = ?";
                $params[] = $typeproduct;
            }

            // Thêm điều kiện lọc theo giá nếu có
            if ($price !== null && $price > 0) {
                $price = (int)$price;
                $conditions[] = "GiaSanPham BETWEEN 0 AND ?";
                $params[] = $price;
            }
            $sql = "SELECT COUNT(*) AS total FROM SanPham WHERE ". implode(" AND ", $conditions);
            $stmt = $this->fetchOne($sql);
            return $stmt['total'];
        }
        public function getCountProductlock(){
            $sql = "SELECT COUNT(*) AS total FROM SanPham WHERE BiXoa = 1";
            $stmt = $this->fetchOne($sql);
            return $stmt['total'];
        }
        public function gettotalwatcher($id){
            $sql = "UPDATE SanPham SET SoLuocXem = SoLuocXem + 1 WHERE MaSanPham = ?";
            $stmt = $this->execute($sql,[(int)$id]);
            return $stmt;
        }
        public function updateProduct($sql,$params){
            $stmt = $this->execute($sql,$params);
            return $stmt;
        }
        public function findproductindetailbill ($sql,$id){
            $stmt = $this->Countitem($sql,$param=[$id]);
            return $stmt;
        }
        public function deleteproduct($sql,$params){
            $stmt = $this->execute($sql,$params);
            return $stmt;
        }
        public function createproduct($sql,$params){
            return $this->execute($sql,$params);
        }
    }
?>