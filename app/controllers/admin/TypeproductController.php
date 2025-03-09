<?php 
    require_once "../app/models/admin/LoaiSPModel.php";
    class TypeproductController extends Controller {
        private $loaispModel;
        public function __construct(){
            $this->loaispModel = new LoaiSPModel();
        }
        public function index() {
            $loaisp = $this->loaispModel->getLoaiSP();
            $content_page = "../app/views/admin/typeproduct/index.php";
            $this->render("/views/admin/dashboard",['loaisp'=>$loaisp,'content_page' => $content_page]);
        }
        public function edit($id){
            $loaisp = $this->loaispModel->getOneLoaiSP((int)$id);
            $content_page = "../app/views/admin/typeproduct/edit.php";
            $this->render("/views/admin/dashboard",['loaisp'=>$loaisp,'content_page' => $content_page]);
        }
        public function update(){
            $id = (int)$_POST['id'];
            $nametypepd = $_POST['nametypepd'];
            $sql = "UPDATE LoaiSanPham SET TenLoaiSanPham = ? WHERE MaLoaiSanPham = ?";
            $params = [$nametypepd,$id];
            $stmt = $this->loaispModel->updateLoaiSP($sql,$params);
            header('Content-Type: application/json');
            if($stmt){
                echo json_encode(['status'=>'success','message'=>'Cập nhật loại sản phẩm thành công']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Cập nhật loại sản phẩm thất bại']);
            }
        }
        public function create(){
            $content_page = "../app/views/admin/typeproduct/create.php";
            $this->render("/views/admin/dashboard",['content_page' => $content_page]);
        }
        public function createitem(){
            $nametypepd = $_POST['nametypepd'];
            $sql = "INSERT INTO LoaiSanPham(TenLoaiSanPham) VALUES (?)";
            $params = [$nametypepd];
            $stmt = $this->loaispModel->updateLoaiSP($sql,$params);
            header('Content-Type: application/json');
            if($stmt){
                echo json_encode(['status'=>'success','message'=>'Thêm loại sản phẩm thành công']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Thêm loại sản phẩm thất bại']);
            }
        }
    }
?>