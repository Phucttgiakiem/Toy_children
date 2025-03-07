<?php 
    require_once "../app/models/admin/BillModel.php";
    class DashboardController extends Controller {
        private $billModel;
        public function __construct(){
            $this->billModel = new BillModel();
        }
        public function index() {
            $bills = $this->billModel->getListbill(1);
            $content_page = "../app/views/admin/bill/index.php";
            $this->render("/views/admin/dashboard",['bills'=>$bills,'content_page' => $content_page]);
        }
    }
?>