<?php
    class App {
        protected $controller = "HomeController";
        protected $method = "index";
        protected $params = [];

        public function __construct() {
            $url = $this->parseUrl();

            if (!empty($url)) {
                if ($url[0] === "admin") {
                    // Nếu URL bắt đầu bằng "admin", sử dụng admin controller
                    array_shift($url); // Xóa "admin" khỏi mảng URL
                    
                    // Kiểm tra controller admin
                    if (!empty($url) && file_exists("../app/controllers/admin/" . $url[0] . "Controller.php")) {
                        $this->controller = "admin\\" . $url[0] . "Controller";
                        unset($url[0]);
                    } else {
                        $this->controller = "admin\\PagenotfoundController"; // Mặc định về AdminController
                    }
                } else {
                    // Kiểm tra controller thường
                    if (file_exists("../app/controllers/" . $url[0] . "Controller.php")) {
                        $this->controller = $url[0] . "Controller";
                        unset($url[0]);
                    }else{
                        $this->controller = "PagenotfoundController";
                    }
                }
            }

            require_once "../app/controllers/" . (strpos($this->controller, "admin\\") === 0 ? "admin/" : "") . str_replace("admin\\", "", $this->controller) . ".php";
            $namecontroller = strpos($this->controller, "admin\\") === 0 ? str_replace("admin\\", "", $this->controller) : $this->controller;
            $this->controller = new $namecontroller;

           // Kiểm tra method hợp lệ
            if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } 
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        private function parseUrl() {
            return isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];
        }
    }
?>

