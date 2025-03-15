<?php 
    require_once str_replace("controllers","models/",__DIR__) ."/BillModel.php";
    class BillController extends Controller {
        private $billModel;
        public function __construct(){
            $this->billModel = new BillModel();
        }
        public function index($page = 1) {
            $bills = $this->billModel->getListbill($page);
            $content_page = str_replace("controllers","views/",__DIR__) ."/bill/index.php";
            $this->render("/views/admin/dashboard",['bills'=>$bills,'content_page' => $content_page]);
        }
        public function detail($idhd){
            $id =(int)$idhd;
            $infobill = $this->billModel->getInfobill($id);
            $detailbill = $this->billModel->getDetailbill($id);
            $Tinhtrang = $this->billModel->getStatus();
            $content_page = str_replace("controllers","views/",__DIR__) ."/bill/detail.php";
            $this->render("/views/admin/dashboard",[
                'content_page' => $content_page,'infobill'=>$infobill,'detailbill'=>$detailbill,
                'Tinhtrang'=>$Tinhtrang]);
        }
        public function updateStatus(){
            $id = $_POST['id'];
            $status = (int) $_POST['status'];
            $status_result = $this->billModel->updatestatusbill($id,$status);
            header('Content-Type: application/json');
            echo json_encode(array("status_rs"=>$status_result));
        }
    }
?>