<?php 
    require_once str_replace("controllers","models/",__DIR__) ."/accountModel.php";
    class accountController extends Controller {
        private $accountModel;
        public function __construct(){
            $this->accountModel = new accountModel();
        }
        public function index(){
            $data = $this->accountModel->getAlluser();
            $content_page = str_replace("controllers","views/",__DIR__) ."/account/index.php";
            $this->render("/views/admin/dashboard", ["account" => $data, "content_page" => $content_page]);
        }
        public function detail($id){
            $data = $this->accountModel->getOneuser((int)$id);
            $content_page = str_replace("controllers","views/",__DIR__) ."/account/detail.php";
            $this->render("/views/admin/dashboard", ["account" => $data, "content_page" => $content_page]);
        }
        public function update($id){
            $sql = "UPDATE TaiKhoan SET BiXoa = 1 - BiXoa WHERE MaTaiKhoan = ?";
            $this->accountModel->updatestatusaccount($sql,$id);
            $this->index();
        }
    }
?>