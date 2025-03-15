<?php
    global $sharedData;
    $product = $sharedData['product'];
?>
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Các sản phẩm</h1>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4 ls-sp">
                                <?php foreach($product as $item):?>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item d-flex flex-column h-100 " >
                                        <div class="fruite-img border border-secondary rounded-top border-bottom-0" >
                                            <img src="/Toy_children/public/assets/img/<?=$item['HinhURL']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <!-- <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div> -->
                                        <div class="d-flex flex-column justify-content-between p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1">
                                            <h4><?=$item['TenSanPham'] ?></h4>
                                            <p class="flex-grow-1"><?=$item['MoTa']?></p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0"><?=number_format($item['GiaSanPham'],0, '.', ',') ?> đ</p>

                                                <a href="/Toy_children/Product/Detailproduct/<?= $item['MaSanPham']?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fas fa-info-circle me-2 text-primary"></i> Chi tiết</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="next-step-data" class="container-fluid mt-4">
                <span class="btn border border-secondary rounded-pill px-3 text-primary me-2 px-4" data-id="1">
                    <i class="fa-solid fa-arrow-left"></i>
                </span>
                <span class="btn border border-secondary rounded-pill px-3 text-primary ms-2 px-4" data-id="2">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </div>
        </div>      
    </div>
</div>
<!-- Fruits Shop End-->
