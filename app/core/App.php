<?php
    class App {
        protected $controller = "HomeController";
        protected $method = "index";
        protected $params = [];

        public function __construct() {
            $url = $this->parseUrl();
            if (!empty($url) && file_exists("../app/controllers/" . $url[0] . "Controller.php")) {
                $this->controller = $url[0] . "Controller";
                unset($url[0]);
            }

            require_once "../app/controllers/" .$this->controller. ".php";
            $this->controller = new $this->controller;

            if(isset($url[1]) && method_exists($this->controller,$url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller,$this->method],$this->params);
        }
        private function parseUrl(){
            // kiểm tra url có tồn tại không, nếu tồn tại thì hàm explode chia chuỗi url thành mảng
            // filter_var là hàm kiểm tra một biến thỏa mãn với bộ lọc chỉ định
            // FILTER_SANITIZE_URL là bộ lọc xóa tất cả các ký tự không hợp lệ khỏi chuỗi url
            //rtrim xóa các ký tự khoảng trắng trong chuỗi
            return isset($_GET['url']) ? explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL)) : [];
        }
    }
?>