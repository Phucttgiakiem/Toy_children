<div class="container">
    <div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Tạo thông tin hãng mới</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="card-title">Thông tin hãng sản xuất</div>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="email2">Tên hãng sản xuất</label>
                        <input
                            type="text"
                            class="form-control"
                            id="tenhangsanxuat"
                            value=""
                        />
                        <small id="tenhsx-notice" class="form-text text-muted">Tên hãng sản xuất không được để trống</small>
                    </div>
                    
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="text-start">
                        <img id="imghsx" src="/Toy_children/public/assets/img/no_image.jpg" class="rounded img-thumbnail w-50 h-50" alt="...">
                    </div>
                    <div class="input-group mb-2 mt-4">
                        <input type="file" class="form-control" id="inputGroupFile02" accept="image/*">
                    </div>
                </div>
            </div>
            </div>
                <div class="card-action">
                    <a href="/Toy_children/admin/Hangsanxuat" class="btn btn-danger">Quay lại</a>
                    <button type="button" class="btn btn-primary" id="createcompanyfirm">Tạo</button>
                </div>
            </div>
        </div>
    </div>
</div>