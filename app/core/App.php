<?php
    class App {
        protected $controller = "HomeController";
        protected $method = "index";
        protected $params = [];

        public function __construct() {
            $url = $this->parseUrl();
            $path = str_replace("app\core", "",__DIR__);
            if (empty($url)) {
                // Nếu URL rỗng, sử dụng controller mặc định
                $this->controller = "HomeController";
            } else {
                if ($url[0] === "admin") {
                    // Nếu URL bắt đầu bằng "admin", sử dụng admin controller
                    array_shift($url); // Xóa "admin" khỏi mảng URL
                    
                    // Kiểm tra controller admin
                    if (!empty($url) && file_exists($path."\\app\\controllers\\admin\\" . $url[0] . "Controller.php")) {
                        $this->controller = "admin\\" . $url[0] . "Controller";
                        unset($url[0]);
                    } else {
                        $this->controller = "admin\\PagenotfoundController"; // Mặc định về AdminController
                    }
                } else {
                    
                    // Kiểm tra controller thường
                    if ($url[0] != "") {
                        if (file_exists($path."\\app\\controllers\\" . $url[0] . "Controller.php")) {
                           
                            $this->controller = $url[0] . "Controller";
                            unset($url[0]);
                        } else {
                            $this->controller = "PagenotfoundController";
                        }
                    }
                }
            }
            require_once str_replace("core","controllers/",__DIR__) . (strpos($this->controller, "admin\\") === 0 ? "admin/" : "") . str_replace("admin\\", "", $this->controller) . ".php";
            $namecontroller = strpos($this->controller, "admin\\") === 0 ? str_replace("admin\\", "", $this->controller) : $this->controller;
            $this->controller = new $namecontroller;
        
            // Kiểm tra method hợp lệ
            if (isset($url[1]) && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }else {
                $this->method = "index";
            }
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        private function parseUrl() {
            return isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];
        }
    }
?>

