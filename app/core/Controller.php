<?php
class Controller {
    // Phương thức render để tải view
    public function render($view, $data = []) {
        // Chuyển đổi đường dẫn view thành tuyệt đối
        $file = "C:/xampp/htdocs/Toy_children/app" . $view . ".php"; 
        
        // Kiểm tra xem file view có tồn tại không
        if (file_exists($file)) {
            // Giải nén dữ liệu thành các biến riêng biệt
            extract($data);

            // Chia sẻ dữ liệu cho toàn bộ layout (header, footer, v.v.)
            global $sharedData;
            $sharedData = $data;
            require_once $file;
        } else {
            die(" View không tồn tại: " . $file);
        }
    }
}
?>