<?php 
    require_once str_replace("controllers","models/",__DIR__) ."/HangSXModel.php";
    class HangSanXuatController extends Controller {
        private $hangsxModel;
        public function __construct(){
            $this->hangsxModel = new HangSXModel();
        }
        public function index() {
            $hangsx = $this->hangsxModel->getHangSX();
            $content_page = str_replace("controllers","views/",__DIR__) ."/HangSanXuat/index.php";
            $this->render("/views/admin/dashboard",['hangsx'=>$hangsx,'content_page' => $content_page]);
        }
        public function edit($id){
            $hangsx = $this->hangsxModel->getOneHangSX($id);
            $content_page = str_replace("controllers","views/",__DIR__) ."/hangsanxuat/edit.php";
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
            $content_page = str_replace("controllers","views/",__DIR__) ."/HangSanXuat/create.php";
            $this->render("/views/admin/dashboard",['content_page' => $content_page]);
        }
        public function createitem(){
            $namehangsx = $_POST['namecompanyfirm'];
            $file = isset($_FILES['file']) ? $_FILES['file'] : null;
            $newFileName = "";
            header('Content-Type: application/json');
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
            
            if($stmt){
                echo json_encode(['status'=>'success','message'=>'Tạo mới hãng sản xuất thành công']);
            }else{
                echo json_encode(['status'=>'error','message'=>'Tạo hãng sản xuất thất bại']);
            }
        }
        public function delete ($id){
            $idh = (int)$id;
            //Kiểm tra có sản phẩm có đang nằm trong hãng hay không?
            $sql = "SELECT COUNT(*) FROM SanPham WHERE MaHangSanXuat =  ?";
            $stmt = $this->hangsxModel->findproductmatchwithfirm($sql,$idh);
            
            if($stmt == 0){
                //thực hiện xử lý xóa thể loại sản phẩm khỏi database
                $sql = "DELETE FROM HangSanXuat WHERE MaHangSanXuat = ?";
            }else {
                //thực hiện khóa sản phẩm vì có tồn tại trong hóa đơn nào đó
                $sql = "UPDATE HangSanXuat SET BiXoa = 1 - BiXoa WHERE MaHangSanXuat = ?";
            }
            $params = [$idh];
            $stmt = $this->hangsxModel->deletecompany($sql,$params);
            $this->index();
        }
    }
?>