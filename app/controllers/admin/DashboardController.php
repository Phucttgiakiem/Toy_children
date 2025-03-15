<?php 
    require_once str_replace("controllers","models/",__DIR__) ."/BillModel.php";
    class DashboardController extends Controller {
        private $billModel;
        public function __construct(){
            $this->billModel = new BillModel();
        }
        public function index() {
            $bills = $this->billModel->getListbill(1);
            $content_page = str_replace("controllers","views/",__DIR__) ."/bill/index.php";
            $this->render("/views/admin/dashboard",['bills'=>$bills,'content_page' => $content_page]);
        }
        public function PageEmpty(){
            
            $content_page = str_replace("controllers","views/",__DIR__) ."/admin/PageEmpty/404.php";
       
            $this->render("/views/layouts/main",['content_page' => $content_page]);
        }
    }
?>