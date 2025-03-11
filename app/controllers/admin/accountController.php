<?php 
    require_once "../app/models/admin/accountModel.php";
    class accountController extends Controller {
        private $accountModel;
        public function __construct(){
            $this->accountModel = new accountModel();
        }
        public function index(){
            $data = $this->accountModel->getAlluser();
            $content_page = "../app/views/admin/account/index.php";
            $this->render("/views/admin/dashboard", ["account" => $data, "content_page" => $content_page]);
        }
        public function detail($id){
            $data = $this->accountModel->getOneuser((int)$id);
            $content_page = "../app/views/admin/account/detail.php";
            $this->render("/views/admin/dashboard", ["account" => $data, "content_page" => $content_page]);
        }
        public function update($id){
            $sql = "UPDATE TaiKhoan SET BiXoa = 1 - BiXoa WHERE MaTaiKhoan = ?";
            $this->accountModel->updatestatusaccount($sql,$id);
            $this->index();
        }
    }
?>