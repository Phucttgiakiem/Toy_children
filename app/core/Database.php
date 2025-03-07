<?php 
    require_once "../config/config.php";
    class Database {
        private $conn;
        public function __construct(){
            $this->conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

            //kiểm tra kết nối
            if($this->conn->connect_error){
                die("kết nối thất bại:".$this->conn->connect_error);
            }
            //Thiết lập charset là UTF-8
            $this->conn->set_charset("utf-8");
        }
        // Hàm thực thi truy vấn SELECT
        public function query($sql) {
            $result = $this->conn->query($sql);
            return $result;
        }
        // Hàm thực thi truy vấn với tham số (dùng prepared statement)
        public function execute($sql,$params){
            $stmt = $this->conn->prepare($sql);
            if($stmt == false){
                die("lỗi prepare: ".$this->conn->error);
            }
            // Gán tham số (phải truyền kiểu dữ liệu trước, ví dụ "s" cho string, "i" cho int)
            if(!empty($params)){
                // Giả sử bạn biết rõ kiểu dữ liệu của mỗi tham số, ví dụ:
                $types = '';
                foreach ($params as $param) {
                    if (is_int($param)) {
                        $types .= 'i';  // 'i' cho integer
                    } elseif (is_double($param)) {
                        $types .= 'd';  // 'd' cho double
                    } else {
                        $types .= 's';  // 's' cho string
                    }
                }

                $stmt->bind_param($types, ...$params);

            }
            if ($stmt->execute() === false) {
                die("lỗi execute: " . $this->conn->error);
            }
            $stmt->close();
            return $stmt;
        }
        // Hàm lấy dữ liệu dạng mảng kết hợp
        public function fetchAll($sql,$params = []){
            $stmt = $this->conn->prepare($sql);
        
            if (!empty($params)) {
                // Xây dựng chuỗi kiểu dữ liệu bind_param
                $types = '';
                foreach ($params as $param) {
                    if (is_int($param)) {
                        $types .= 'i'; // Kiểu integer
                    } elseif (is_double($param)) {
                        $types .= 'd'; // Kiểu double
                    } elseif (is_string($param)) {
                        $types .= 's'; // Kiểu string
                    } elseif ($param instanceof \DateTime) {
                        $types .= 's'; // Kiểu string cho datetime
                        $param = $param->format('Y-m-d H:i:s'); // Định dạng datetime thành chuỗi
                    } else {
                        $types .= 's'; // Mặc định là string nếu không phải kiểu dữ liệu trên
                    }
                }
                // Bind các tham số
                 $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data ?: [];
        }
        // Hàm lấy một dòng dữ liệu
        public function fetchOne($sql){
            $result = $this->query($sql);
            return $result->fetch_assoc();
        }
        //Hàm đóng kết nối
        public function close(){
            $this->conn->close();
        }
    }
?>