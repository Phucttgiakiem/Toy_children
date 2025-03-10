<?php 
    require_once "../app/models/ProductModel.php";
    require_once "../app/models/admin/LoaiSPModel.php";
    require_once "../app/models/admin/HangSXModel.php";
    class ProductController extends Controller {
        private $productModel;
        private $loaispModel;
        private $hangsxModel;
        public function __construct(){
            $this->productModel = new ProductModel();
            $this->loaispModel = new LoaiSPModel();
            $this->hangsxModel = new HangSXModel();
        }
        public function index($page = 1) {
            $totalrowtable = $this->productModel->getCountProduct();
            $totalpages = ceil((int)$totalrowtable/5);
            $offset = ((int)$page - 1) * 5;
            $products = $this->productModel->getAllProduct($offset,5);
            $content_page = "../app/views/admin/product/index.php";
            $this->render("/views/admin/dashboard",['products'=>$products,'content_page' => $content_page,
            'totalpages'=>$totalpages,'page'=>$page]);
        }
        public function lockitem($page = 1){
            $totalrowtable = $this->productModel->getCountProductlock();
            $totalpages = ceil((int)$totalrowtable/5);
            $offset = ((int)$page - 1) * 5;
            $products = $this->productModel->getAllProductLock($offset,5);
            $content_page = "../app/views/admin/product/lockproduct.php";
            $this->render("/views/admin/dashboard",['products'=>$products,'content_page' => $content_page,
            'totalpages'=>$totalpages,'page'=>$page]);
        }
        public function detail($id) {
            $product = $this->productModel->getOneProduct($id);
            $content_page = "../app/views/admin/product/detail.php";
            $this->render("/views/admin/dashboard",['product'=>$product,'content_page' => $content_page]);
        }
        public function edit($id) {
            $product = $this->productModel->getOneProduct($id);
            $hangsx =  $this->hangsxModel->getHangSX();
            $loaisp = $this->loaispModel->getLoaiSP();
            $content_page = "../app/views/admin/product/edit.php";
            $this->render("/views/admin/dashboard",['product'=>$product,'content_page' => $content_page,'hangsx'=>$hangsx,'loaisp'=>$loaisp]);
        }
        public function update(){

            try {
                $id = (int)$_POST['id'];
                $name = $_POST['namesp'];
                $motasp = $_POST['motasp'];
                $hangsx = (int)$_POST['hangsx'];
                $soluongton = (int)$_POST['soluongton'];
                $soluongban = (int)$_POST['soluongban'];
                $giaban =(int)$_POST['giaban'];
                $loaisp =(int)$_POST['loaisp'];
                $file = isset($_FILES['file']) ? $_FILES['file'] : null;
                $newFileName = "";
             // Định dạng JSON để AJAX nhận đúng kiểu dữ liệu
                header('Content-Type: application/json');
                // Kiểm tra file có được tải lên không
                if ($file) {
                    // Kiểm tra lỗi upload
                    if ($file['error'] !== UPLOAD_ERR_OK) {
                        throw new Exception(" Lỗi upload file: " . getUploadError($file['error']));
                    }
                
                    $targetDir = "C:/xampp/htdocs/Toy_children/public/assets/img"; // Dùng / thay vì \
                
                    // Kiểm tra thư mục có tồn tại không, nếu không thì tạo
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
                    // Xử lý tên file tránh trùng lặp
                    $fileName = pathinfo($file["name"], PATHINFO_FILENAME);
                    $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);
                    $newFileName = $fileName . "_" . time() . "." . $fileExt;
                    $targetFile = $targetDir . "/" . $newFileName; // Dùng / thay vì \
                
                    // Di chuyển file từ tmp vào thư mục đích
                    if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
                        throw new Exception(" Lỗi: Không thể di chuyển file. Kiểm tra quyền thư mục hoặc dung lượng ổ đĩa.");
                    }
                }
            
                $sql = "";
                $params = null;
                if($newFileName == ""){
                    $sql = "UPDATE SanPham SET TenSanPham = ?, MoTa = ?, SoLuongTon = ?, SoLuongBan = ?, GiaSanPham = ?, MaHangSanXuat = ?, MaLoaiSanPham = ? WHERE MaSanPham = ?";
                    $params = [$name, $motasp, $soluongton, $soluongban, $giaban, $hangsx, $loaisp, $id];
                }else{
                    $sql = "UPDATE SanPham SET TenSanPham = ?, MoTa = ?, SoLuongTon = ?, SoLuongBan = ?, GiaSanPham = ?, HinhURL = ?, MaHangSanXuat = ?, MaLoaiSanPham = ? WHERE MaSanPham = ?";
                    $params = [$name, $motasp, $soluongton, $soluongban, $giaban, $newFileName, $hangsx, $loaisp, $id];
                }
                $rs = $this->productModel->updateProduct($sql,$params);
                if($rs){
                    echo json_encode(["status"=>"success","message"=>"Cập nhật sản phẩm thành công"]);
                }else{
                    echo json_encode(["status"=>"error","message"=>"Cập nhật sản phẩm thất bại"]);
                }
                // Trả về JSON response cho AJAX
               // echo json_encode(["status" => "success", "message" => " File đã được tải lên thành công!", "file" => $newFileName]);
            } catch (Exception $e) {
                header('Content-Type: application/json');

                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }
        // public function delete ($id){
        //     $idsp = (int)$id;
        //     //Kiểm tra có sản phẩm có đang nằm trong hóa đơn hay không?
        //     $sql = "SELECT COUNT(*) FROM ChiTietDonDatHang WHERE MaSanPham = ?";
        //     $stmt = $this->productModel->findproductindetailbill($sql,$idsp);
            
        //     if($stmt[0] == 0){
        //         //thực hiện xử lý xóa sản phẩm khỏi database
        //         $sql = "DELETE FROM SanPham WHERE MaSanPham = $idsp";
        //     }else {
        //         //thực hiện khóa sản phẩm vì có tồn tại trong hóa đơn nào đó
        //         $sql = "UPDATE SanPham SET BiXoa = 1 - BiXoa WHERE MaSanPham = $idsp";
        //     }
        //     $stmt = $this->productModel
        // }
    }
?>