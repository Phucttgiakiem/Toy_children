
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
        let hangsx = $("#hangsx").val();
        let loaisp = $("#loaisp").val();
        let soluongton = $("#soluongton").val();
        let soluongban = $("#soluongban").val();
        let giaban = $("#giaban").val();
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
        
        let formData = new FormData();
        formData.append("id",id);
        formData.append("namesp",namesp);
        formData.append("motasp",motasp);
        formData.append("giaban",giaban);
        formData.append("hangsx",hangsx);
        formData.append("loaisp",loaisp);
        formData.append("soluongton",soluongton);
        formData.append("soluongban",soluongban);
        formData.append('file', file);
        $.ajax({
            url: "/Toy_children/admin/Product/update",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                showModal(res.status, res.message);
                if(res.status == "success"){
                    setTimeout(function(){
                        window.location.assign
                        ("http://" + window.location.hostname + "/Toy_children/admin/Product");
                    },1100);
                }
                
            }
        })
    })
    // xử lý với loại sản phẩm
    $("#createtypeProduct").click(function(e){
        let typepd = $("#loaisanphammoi").val();
        let notice = $("#loaisp-notice");
        let isvalid = true;
        if(typepd == ""){
            $("#loaisanphammoi").addClass("border-danger");
            $(notice).addClass("text-danger");
            isvalid = false;
        }
        else {
            $("#loaisanphammoi").removeClass("border-danger");
            $(notice).removeClass("text-danger");
        }
        if(isvalid){
            $.post("/Toy_children/admin/Typeproduct/createitem",
                {
                    nametypepd: typepd
                },
                function (res) {
                    console.log(res);
                    showModal(res.status, res.message);
                    if(res.status == "success"){
                        setTimeout(function(){
                            window.location.assign
                            ("http://" + window.location.hostname + "/Toy_children/admin/Typeproduct");
                        },1100);
                    }
                }
            )
        }
    })
    $('#updatetypeProduct').click(function(e){
        let id = $(this).data("id");
        let typepd = $("#tenloaisanpham").val();
        let notice = $("#tenlsp-notice");
        let isvalid = true;
        if(typepd == ""){
            $("#tenloaisanpham").addClass("border-danger");
            $(notice).addClass("text-danger");
            isvalid = false;
        }
        else {
            $("#tenloaisanpham").removeClass("border-danger");
            $(notice).removeClass("text-danger");
        }
        if(isvalid){
            $.post("/Toy_children/admin/Typeproduct/update",
                {
                    id: id,
                    nametypepd: typepd
                },
                function (res) {
                    showModal(res.status, res.message);
                    if(res.status == "success"){
                        setTimeout(function(){
                            window.location.assign
                            ("http://" + window.location.hostname + "/Toy_children/admin/Typeproduct");
                        },1100);
                    }
                }
            )
        }
    })
})
    