<?php 
    require_once "../app/models/admin/HangSXModel.php";
    class HangSanXuatController extends Controller {
        private $hangsxModel;
        public function __construct(){
            $this->hangsxModel = new HangSXModel();
        }
        public function index() {
            $hangsx = $this->hangsxModel->getHangSX();
            $content_page = "../app/views/admin/HangSanXuat/index.php";
            $this->render("/views/admin/dashboard",['hangsx'=>$hangsx,'content_page' => $content_page]);
        }
        public function edit($id){
            $hangsx = $this->hangsxModel->getOneHangSX($id);
            $content_page = "../app/views/admin/hangsanxuat/edit.php";
            $this->render("/views/admin/dashboard",['hangsx'=>$hangsx,'content_page' => $content_page]);
        }

        public function update(){
            $id = (int)$_POST['id'];
            $file = isset($_FILES['file']) ? $_FILES['file'] : null;
            $namehangsx = $_POST['namehangsx'];
            $newFileName = "";
            if ($file) {
                $targetDir = "C:/xampp/htdocs/Toy_children/public/assets/img";
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $fileName = pathinfo($file["name"], PATHINFO_FILENAME);
                $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);
                $newFileName = $fileName . "_" . time() . "." . $fileExt;
                $targetFile = $targetDir . "/" . $newFileName;
                // Di chuyển file từ tmp vào thư mục đích
                if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
                    echo json_encode(['status'=>'error','message'=>'Không thể di chuyển file ảnh. Kiểm tra quyền thư mục hoặc dung lượng ổ đĩa.']);
                }
            }
            $sql = "";
            $params = null;
            if($newFileName == ""){
                $sql = "UPDATE HangSanXuat SET TenHangSanXuat = ? WHERE MaHangSanXuat = ?";
                $params = [$namehangsx,$id];
            }else {
                $sql = "UPDATE HangSanXuat SET TenHangSanXuat = ?,LogoURL = ? WHERE MaHangSanXuat = ?";
                $params = [$namehangsx,$newFileName,$id];
            }
            $stmt = $this->hangsxModel->updateHangSX($sql,$params);
            header('Content-Type: application/json');
            if($stmt){
                echo json_encode(['status'=>'success','message'=>'Cập nhật hãng sản xuất thành công']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Cập nhật hãng sản xuất thất bại']);
            }
        }
        public function create(){
            $content_page = "../app/views/admin/HangSanXuat/create.php";
            $this->render("/views/admin/dashboard",['content_page' => $content_page]);
        }
        public function createitem(){
            $namehangsx = $_POST['namecompanyfirm'];
            $file = isset($_FILES['file']) ? $_FILES['file'] : null;
            $newFileName = "";
            if ($file) {
                $targetDir = "C:/xampp/htdocs/Toy_children/public/assets/img";
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $fileName = pathinfo($file["name"], PATHINFO_FILENAME);
                $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);
                $newFileName = $fileName . "_" . time() . "." . $fileExt;
                $targetFile = $targetDir . "/" . $newFileName;
                // Di chuyển file từ tmp vào thư mục đích
                if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
                    echo json_encode(['status'=>'error','message'=>'Không thể di chuyển file ảnh. Kiểm tra quyền thư mục hoặc dung lượng ổ đĩa.']);
                }
            }
            if($newFileName == ""){
                $newFileName = "no_image.jpg";
            }
            $sql = "INSERT INTO HangSanXuat(TenHangSanXuat,LogoURL) VALUES (?,?)";
            $params = [$namehangsx,$newFileName];
            $stmt = $this->hangsxModel->createHangSX($sql,$params);
            header('Content-Type: application/json');
            if($stmt){
                echo json_encode(['status'=>'success','message'=>'Tạo mới hãng sản xuất thành công']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Tạo hãng sản xuất thất bại']);
            }
        }

    }
?>