<?php
class Controller {
    // Phương thức render để tải view
    public function render($view, $data = []) {
        $file = explode("\\core",__DIR__)[0] . $view . ".php";
        
        if (file_exists($file)) {
            extract($data);
            // Nếu có page, thêm nó vào URL trình duyệt bằng cách tạo query string
            // if ($param !== null) {
            //     $_GET['page'] = $param;
            // }
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