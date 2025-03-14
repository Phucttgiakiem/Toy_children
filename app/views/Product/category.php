<?php 
    global $sharedData;
    $products = $sharedData["products"];
    $typeproducts = $sharedData["typeproducts"];
    $companys = $sharedData["Companys"];
    // hàm tính thời gian cách nhau đã hơn một tuần hay chưa
    function isWithinOneWeek($inputDate) {
        // Tạo đối tượng DateTime cho ngày hiện tại
        $now = new DateTime();
        
        // Chuyển đổi $inputDate thành đối tượng DateTime
        // Đảm bảo rằng định dạng ngày của bạn đúng kiểu "Y-m-d H:i:s"
        $inputDateTime = new DateTime($inputDate);
        
        // Lấy ngày hiện tại
        $now = new DateTime();
        // Tính sự khác biệt giữa ngày hiện tại và ngày đầu vào
        $interval = $now->diff($inputDateTime);
        
        // Kiểm tra nếu sự khác biệt không quá 7 ngày
        if ($interval->days <= 7 && $interval->invert == 0) {
            return true;
        } else {
            return false;
        }
    }
?>
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5" style="margin-top:10rem">
            <div class="container py-5">
                <h1 class="mb-4">Các sản phẩm</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4 my-5">
                            <div class="col-xl-3">
                                <div class=" w-100 mx-auto">
                                    <form class="input-group d-flex" method="POST" action="/Toy_children/Product/Categoryproduct">
                                        <input type="search" name="search" class="form-control p-3" placeholder="Từ khóa" aria-describedby="search-icon-1">
                                        <button type="submit" id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Loại sản phẩm</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="/Toy_children/Product/Categoryproduct"><i class="fa-solid fa-box me-2"></i>Tất cả</a>
                                                    </div>
                                                </li>
                                                <?php 
                                                    foreach($typeproducts as $item):
                                                ?>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="/Toy_children/Product/Categoryproduct/<?=$item["MaLoaiSanPham"]?>"><i class="fa-solid fa-box me-2"></i></i><?= $item["TenLoaiSanPham"]?></a>
                                                    </div>
                                                </li>
                                                <?php endforeach?>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Hãng sản xuất</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <?php 
                                                    foreach($companys as $item):
                                                ?>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="/Toy_children/Product/Categoryproduct/<?=$item["MaHangSanXuat"]?>"><i class="fa-solid fa-building me-2"></i><?= $item["TenHangSanXuat"]?></a>
                                                    </div>
                                                </li>
                                                <?php endforeach?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-left" id="product-list">
                                    <?php 
                                            if(count($products)){
                                            foreach($products as $item):
                                    ?>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item d-flex flex-column h-100">
                                            <div class="fruite-img">
                                                <img src="/Toy_children/public/assets/img/<?=$item['HinhURL']?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <?php if(isWithinOneWeek($item["NgayNhap"])) {
                                                    echo '<div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Mới</div>';
                                            }
                                            ?>
                                            <div class="d-flex flex-column justify-content-between p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1">
                                                <h4><?=$item['TenSanPham']?></h4>
                                                <p class="flex-grow-1"><?=$item['MoTa']?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0"><?=number_format($item['GiaSanPham'],0, '.', ',')?> đ</p>
                                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary detail-pd" data-id="<?= $item['MaSanPham']?>">Chi tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; }
                                        else {
                                            echo "<h4>Không có sản phẩm tìm thấy</h4>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->