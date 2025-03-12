<?php 
    global $sharedData;
    $hangsxs = $sharedData['hangsx'];
?>
<div class="container">
        <div class="page-inner">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex justify-content-between align-items-center px-4 py-2">
                    <h4 class="card-title">Danh sách hãng sản xuất</h4>
                    <div>
                        <a
                        href="/Toy_children/admin/Hangsanxuat/create"
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
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên hãng sản xuất</th>
                        <th class="text-center">Hình ảnh</th>
                        <th class="text-center">Tình trạng</th>
                        <th class="text-center"  style="width: 20%">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(count($hangsxs) > 0){
                        $stt = 1;
                        foreach($hangsxs as $item):
                    ?>
                        <tr>
                            <td class="text-center"><?=$stt ?></td>
                            <td class="text-center"><?=$item['TenHangSanXuat']?></td>
                            <td class="text-center"><img src='/Toy_children/public/assets/img/<?php echo $item['LogoURL']; ?>' width='50px' height='50px'></td>
                            <td class="text-center">
                                <?php 
                                    if($item['BiXoa'] == 1){
                                        echo '<i class="fa-solid fa-lock text-warning"></i>';
                                    }else {
                                        echo '<i class="fa-solid fa-lock-open"></i>';
                                    }
                                ?>
                            </td>
                            <td class="text-center">
                                <div class="form-button-action">
                                <a
                                    href="/Toy_children/admin/Hangsanxuat/delete/<?=$item['MaHangSanXuat'] ?>"
                                    class="btn btn-link btn-danger btn-lg"
                                    id="Detail"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                <a
                                    href="/Toy_children/admin/Hangsanxuat/edit/<?=$item['MaHangSanXuat'] ?>"
                                    class="btn btn-link btn-warning btn-lg"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                </div>
                            </td>
                        </tr>
                        <?php $stt++; endforeach; } ?>
                    </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
