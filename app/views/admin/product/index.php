<?php 
    global $sharedData;
    $products = $sharedData['products'];
    $totalpages = $sharedData['totalpages'];
    $page = $sharedData['page'];
?>
<div class="container">
        <div class="page-inner">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex justify-content-between align-items-center px-4 py-2">
                    <h4 class="card-title">Danh sách sản phẩm</h4>
                    <!-- <div class="flex-grow-1">
                        <a
                            href="/Toy_children/admin/Product/lockitem"
                            class="btn"
                            >
                            <i class="fa-solid fa-house-lock fs-3 text-success"></i>
                        </a>
                        
                    </div> -->
                    <div>
                        <a
                        href="/Toy_children/admin/Product/create"
                        class="btn btn-success"
                        >
                            Tạo mới
                        </a>
                    </div>
                </div>
                </div>
                <div class="card-body">
                
                <div
                    class="modal fade"
                    id="addRowModal"
                    tabindex="-1"
                    role="dialog"
                    aria-hidden="true"
                >
                  <!--  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                        <h5 class="modal-title">
                            <span class="fw-mediumbold"> New</span>
                            <span class="fw-light"> Row </span>
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <p class="small">
                            Create a new row using this form, make sure you
                            fill them all
                        </p>
                        <form>
                            <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                <label>Name</label>
                                <input
                                    id="addName"
                                    type="text"
                                    class="form-control"
                                    placeholder="fill name"
                                />
                                </div>
                            </div>
                            <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                <label>Position</label>
                                <input
                                    id="addPosition"
                                    type="text"
                                    class="form-control"
                                    placeholder="fill position"
                                />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                <label>Office</label>
                                <input
                                    id="addOffice"
                                    type="text"
                                    class="form-control"
                                    placeholder="fill office"
                                />
                                </div>
                            </div>
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer border-0">
                        <button
                            type="button"
                            id="addRowButton"
                            class="btn btn-primary"
                        >
                            Add
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        </div>
                    </div>
                    </div>-->
                </div> 

                <div class="table-responsive">
                    <table
                    id="add-row"
                    class="display table table-striped table-hover"
                    >
                    <thead>
                        <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Ngày nhập</th>
                        <th>Tình trang</th>
                        <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(count($products) > 0){
                        $stt = 1;
                        foreach($products as $item):
                    ?>
                        <tr>
                            <td><?=$stt ?></td>
                            <td><?=$item['TenSanPham']?></td>
                            <td><img src='/Toy_children/public/assets/img/<?php echo $item['HinhURL']; ?>' width='50px' height='50px'></td>
                            <td><?=$item['NgayNhap']?></td>
                            <td>
                                <?php 
                                    if($item['BiXoa'] == 1){
                                        echo '<i class="fa-solid fa-lock text-warning"></i>';
                                    }else {
                                        echo '<i class="fa-solid fa-lock-open"></i>';
                                    }
                                ?>
                            </td>
                            <td>
                                <div class="form-button-action">
                                <a
                                    href="/Toy_children/admin/Product/detail/<?=$item['MaSanPham'] ?>"
                                    class="btn btn-link btn-info btn-lg"
                            
                                >
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                                <a
                                    href="/Toy_children/admin/Product/edit/<?=$item['MaSanPham'] ?>"
                                    class="btn btn-link btn-warning btn-lg"
                                    
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a
                                    href="/Toy_children/admin/Product/delete/<?=$item['MaSanPham'] ?>"
                                    class="btn btn-link btn-danger btn-lg"
                                    
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                </div>
                            </td>
                        </tr>
                        <?php $stt++; endforeach; } ?>
                    </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                        
                            <li class="page-item">
                                <a class="page-link" href="/Toy_children/admin/Product/index/<?php echo 1 ?>" tabindex="-1">Previous</a>
                            </li>
                        
                            <?php 
                                foreach(range(1, $totalpages) as $index){
                                    if($index == $page){
                                        echo "<li class='page-item active'>
                                                <a class='page-link' href='/Toy_children/admin/Product/index/$index'>$index</a>
                                            </li>";
                                    } else {
                                        echo "<li class='page-item'>
                                                <a class='page-link' href='/Toy_children/admin/Product/index/$index'>$index</a>
                                            </li>";
                                    }
                                }
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="/Toy_children/admin/Product/index/<?php echo $totalpages ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
