<?php
        global $sharedData;
        $products = $sharedData['products'];
?>
<div class="container">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Danh sách đơn đặt hàng</h4>
                    </div>
                    </div>
                    <div class="card-body">
                    <!-- Modal -->
                        <div
                            class="modal fade"
                            id="addRowModal"
                            tabindex="-1"
                            role="dialog"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog" role="document">
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
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                id="add-row"
                                class="display table table-striped table-hover"
                                >
                                
                                <thead>
                                    <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Tổng tiền đơn hàng</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center" style="width: 20%">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(count($bills) > 0){
                                    $stt = 1;
                                    foreach($bills as $item):
                                ?>
                                    <tr>
                                        <td class="text-center"><?=$stt ?></td>
                                        <td class="text-center"><?=$item['TongThanhTien']?> đ</td>
                                        <td class="text-center"><?=$item['NgayLap']?></td>
                                        <td class="text-center">
                                            <div class="form-button-action">
                                            <a
                                                href="/Toy_children/admin/bill/detail/<?=$item['MaDonDatHang'] ?>"
                                                class="btn btn-link btn-warning btn-lg"
                                                data-id="<?=$item['MaDonDatHang'] ?>"
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
</div>
<!-- <script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,
        });

        var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function () {
          $("#add-row")
            .dataTable()
            .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
            ]);
          $("#addRowModal").modal("hide");
        });
      });
    </script> -->
    