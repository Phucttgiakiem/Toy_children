
$(document).ready(function () {
    function showModal(type, message) {
        const modalElement = $('#myModal');  // jQuery đối tượng
        const modalTitle = $('.modal-title');
        const modalBody = $('.modal-body');
        const btn_save = $('#save-changes');
        $(btn_save).hide();
        // Tùy chỉnh nội dung modal theo loại thông báo
        if (type === 'success') {
            modalTitle.text('Thông báo');
            modalBody.html('<p>' + message + '</p>');  // Cập nhật message từ tham số
            modalBody.addClass('text-success');
            modalBody.removeClass('text-danger text-warning');
        } else if (type === 'error') {
            modalTitle.text('lỗi');
            modalBody.html('<p>' + message + '</p>');  // Cập nhật message từ tham số
            modalBody.addClass('text-danger');
            modalBody.removeClass('text-success text-warning');
        } else if (type === 'warning') {
            modalTitle.text('Cảnh báo');
            modalBody.html('<p>' + message + '</p>');  // Cập nhật message từ tham số
            modalBody.addClass('text-warning');
            modalBody.removeClass('text-success text-danger');
        }

        // Hiển thị modal trong Bootstrap 4
        modalElement.modal('show');
      }
      
    // $(document).on('click',".btn-warning",function(e){
    //     let id =  $(this).data("id");
    //     window.location.assign("http://" + window.location.hostname + "/Toy_children/admin/Bill/detail/"+id);
        
    // })
    $("#update-status-bill").click(function(e){
        let id =  $(this).data("id");
        let status = $("#exampleFormControlSelect1").val();
        $.post(
            "http://" + window.location.hostname + "/Toy_children/admin/Bill/updateStatus",
            {
                id: id,
                status: status
            },
            function (res) {
                if (res.status_rs ==1) {
                    showModal('error',"lỗi cập nhật trạng thái đơn hàng, thử lại !!!");
                } else if(res.status_rs == 2){
                    showModal('success',"Cập nhật trạng thái đơn hàng thành công !!!");
                }else if (res.status_rs == 3){
                    showModal('error',"lỗi kiểm tra sản phẩm, thử lại !!!");
                }else if (res.status_rs == 4){
                    showModal('error',"Có sản phẩm trong hóa đơn không đủ số lượng để cấp, thử lại !!!");
                }else{
                    showModal('error',"lỗi cập nhật số sản phẩm, thử lại !!!");
                }
            }
            // function (error) {
            //     showModal('error', 'Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            // }
        );
    })
    //thay đổi hình sản phẩm
    $("#inputGroupFile01").change(function(e){
        let file = e.target.files[0];
        let idimg = $("#imgsp");
        idimg.attr("src",URL.createObjectURL(file));
    })
    //cập nhật sản phẩm
    $("#updateProduct").click(function(e){
        let id =  $(this).data("id");
        let hangsp = $("#hangsx").val();
        let loaisp = $("#loaisp").val();
        let soluongton = $("#soluongton").val();
        let soluongban = $("#soluongban").val();
        let file = $("#inputGroupFile01")[0].files[0];
        let namesp = $("#tensanpham").val().trim();
        let motasp = $("#mota").val().trim();

        //canh bao khi chua nhap du thong tin
        let emptysp = $("#tensp-notice");
        let emptymota = $("#mota-sp");

        let isvalid = true;
        if(namesp == ""){
            $("#tensanpham").addClass("border-danger");
            $(emptysp).addClass("text-danger");
            isvalid = false;
        }else {
            $("#tensanpham").removeClass("border-danger");
            $(emptysp).removeClass("text-danger");
            
        }
        if(motasp == ""){
            $("#mota").addClass("border-danger");
            $(emptymota).addClass("text-danger");
            isvalid = false;
        }
        else {
            $("#mota").removeClass("border-danger");
            $(emptymota).removeClass("text-danger");
        }
        
        // let formData = new FormData();
        // formData.append("id",id);
        // formData.append("name",name);
        // formData.append("price",price);
        // formData.append("description",description);
        // formData.append("category",category);
        // formData.append("file",file);
        // $.ajax({
        //     url: "http://" + window.location.hostname + "/Toy_children/admin/Product/updateProduct",
        //     type: "POST",
        //     data: formData,
        //     contentType: false,
        //     processData: false,
        //     success: function (res) {
        //         if (res.status_rs == 1) {
        //             showModal('error',"lỗi cập nhật sản phẩm, thử lại !!!");
        //         } else {
        //             showModal('success',"Cập nhật sản phẩm thành công !!!");
        //         }
        //     }
        // })
    })
})
    