<?php 
    require_once  str_replace("\app\core","",__DIR__). "/config/config.php";
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
                    

                    // Kiểm tra kiểu dữ liệu của tham số và thêm vào chuỗi $types tương ứng
                    if (is_int($param)) {
                        $types .= 'i';  // 'i' cho integer
                    } elseif (is_double($param)) {
                        $types .= 'd';  // 'd' cho double
                    } elseif (is_string($param)) {
                        // Kiểm tra nếu đó là chuỗi có định dạng ngày tháng hợp lệ (YYYY-MM-DD hoặc YYYY-MM-DD HH:MM:SS)
                        if (strtotime($param) !== false) {
                            $types .= 's';  // 's' cho string (ngày tháng sẽ được xử lý như một chuỗi)
                        } else {
                            // Nếu không phải ngày tháng hợp lệ, xử lý như một chuỗi thông thường
                            $types .= 's';
                        }
                    } else {
                        // Trường hợp các kiểu dữ liệu khác (nếu có)
                        $types .= 's';  // Mặc định xử lý kiểu khác như string
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
        public function Countitem ($sql,$params = []){
            // Chuẩn bị câu lệnh SQL
                $stmt = $this->conn->prepare($sql);
                if ($stmt === false) {
                    die("Lỗi prepare: " . $this->conn->error);
                }

                // Liên kết các tham số với câu truy vấn (nếu có)
                if (!empty($params)) {
                    // Tạo một chuỗi các loại dữ liệu cho các tham số
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

                    // Liên kết các tham số vào câu truy vấn
                    $stmt->bind_param($types, ...$params);
                }

                // Thực thi câu lệnh SQL
                $stmt->execute();

                // Liên kết kết quả với biến
                $stmt->bind_result($count);

                // Lấy dữ liệu
                $stmt->fetch();

                // Đóng câu lệnh
                $stmt->close();

                // Trả về kết quả COUNT
                return $count;
        }
        public function delete ($sql,$params = []){
            $stmt = $this->conn->prepare($sql);
            if ($stmt == false) {
                die("lỗi prepare: " . $this->conn->error);
            }
            
            // Gán tham số (phải truyền kiểu dữ liệu trước, ví dụ "s" cho string, "i" cho int)
            if (!empty($params)) {
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
                exit;
            }
            if ($this->conn->affected_rows > 0) {
                // Xóa thành công
                return true;
            } else {
                // Không có dòng nào bị xóa (xóa không thành công)
                return false;
            }
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
            // Thực thi truy vấn
            $result = $this->query($sql);
            
            // Kiểm tra nếu truy vấn thất bại (result là false)
            if (!$result) {
                // In thông báo lỗi hoặc log để kiểm tra nguyên nhân
                die("Lỗi truy vấn: " . $this->conn->error);  // Nếu sử dụng MySQLi
                exit;
            }

            // Nếu truy vấn thành công, lấy dữ liệu
            return $result->fetch_assoc();
        }
        //Hàm đóng kết nối
        public function close(){
            $this->conn->close();
        }
    }
?>