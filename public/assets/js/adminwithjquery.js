
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
                    setTimeout(function(){
                        window.location.assign
                        ("http://" + window.location.hostname + "/Toy_children/admin/Bill");
                    },1200);
                }else if (res.status_rs == 3){
                    showModal('error',"lỗi kiểm tra sản phẩm, thử lại !!!");
                }else if (res.status_rs == 4){
                    showModal('error',"Có sản phẩm trong hóa đơn không đủ số lượng để bán, thử lại !!!");
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
        if (file) {
            formData.append('file', file);
        }
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
            },
            error: function (xhr, status, error) {
                console.log("Lỗi: " + error);
                console.log("phản hồi lỗi từ máy chủ:", xhr.responseText);
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
    // xử lý với hãng sản xuất
    //create
    $("#createcompanyfirm").click(function(e){
        let companyfirm = $("#tenhangsanxuat").val();
        let notice = $("#tenhsx-notice");
        let file = $("#inputGroupFile02")[0].files[0];
        let isvalid = true;

        if(companyfirm == ""){
            $("#tenhangsanxuat").addClass("border-danger");
            $(notice).addClass("text-danger");
            isvalid = false;
        }
        else {
            $("#tenhangsanxuat").removeClass("border-danger");
            $(notice).removeClass("text-danger");
            isvalid = true;
        }
        formData = new FormData();
        formData.append("namecompanyfirm",companyfirm);
        if (file) {
            formData.append('file', file);
        }
        if(isvalid){
            $.ajax({
                url: "/Toy_children/admin/Hangsanxuat/createitem",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    showModal(res.status, res.message);
                    if(res.status == "success"){
                        setTimeout(function(){
                            window.location.assign
                            ("http://" + window.location.hostname + "/Toy_children/admin/Hangsanxuat");
                        },1100);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Lỗi: " + error);
                    console.log("phản hồi lỗi từ máy chủ:", xhr.responseText);
                }
            })
        }
    })
    //edit
    $("#inputGroupFile03").change(function(e){
        let file = e.target.files[0];
        let idimg = $("#logofirm");
        idimg.attr("src",URL.createObjectURL(file));
    })
    $("#updateCompanyfirm").click(function(e){
        let id = $(this).data("id");
        let companyfirm = $("#tenhangsanxuat").val();
        let notice = $("#tenhang-notice");
        let file = $("#inputGroupFile03")[0].files[0];
        let isvalid = true;
        if(companyfirm == ""){
            $("#tenhangsanxuat").addClass("border-danger");
            $(notice).addClass("text-danger");
            isvalid = false;
        }
        else {
            $("#tenhangsanxuat").removeClass("border-danger");
            $(notice).removeClass("text-danger");
            isvalid = true;
        }
        formData = new FormData();
        formData.append("id",id);
        formData.append("namehangsx",companyfirm);
        if (file) {
            formData.append('file', file);
        }
        if(isvalid){
            $.ajax({
                url: "/Toy_children/admin/Hangsanxuat/update",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    showModal(res.status, res.message);
                    if(res.status == "success"){
                        setTimeout(function(){
                            window.location.assign
                            ("http://" + window.location.hostname + "/Toy_children/admin/Hangsanxuat");
                        },1100);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Lỗi: " + error);
                    console.log("phản hồi lỗi từ máy chủ:", xhr.responseText);
                }
            })
        }
    })
    //tạo mới sản phẩm
    //thay đổi ảnh sản phẩm
    $("#inputGroupFile02").change(function(event){
        // Lấy file từ input
        const file = event.target.files[0];

        // Kiểm tra xem người dùng đã chọn file chưa
        if (file) {
            // Tạo URL từ tệp được chọn
            const reader = new FileReader();

            // Khi file được đọc thành công
            reader.onload = function(e) {
                // Cập nhật thuộc tính src của thẻ img
                document.getElementById('imgPreview').src = e.target.result;
            };

            // Đọc file dưới dạng URL data
            reader.readAsDataURL(file);
        }
    })
    $("#btn-create-pd").click(function(event){
        event.preventDefault();  // Ngừng gửi form ngay lập tức, cả khi form hợp lệ hay không
        let form = $("#create_product");
        // Kiểm tra tính hợp lệ của form
        if (!$(form)[0].checkValidity()) {  
        
            // Thêm lớp 'was-validated' để hiển thị thông báo lỗi
            $(form).addClass('was-validated');
            return;  // Không tiếp tục gửi AJAX nếu form không hợp lệ
        }
    
        // Nếu form hợp lệ, tiếp tục gửi AJAX
        var formData = new FormData($(form)[0]);  // Lấy dữ liệu từ form (thêm [0] để lấy DOM element)
        // Gửi dữ liệu qua Ajax
        $.ajax({
            url: '/Toy_children/admin/Product/createproduct', // URL của controller
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                // Xử lý kết quả trả về từ controller
                showModal(res.status, res.message);
                if (res.status === 'success') {
                    $("#close-notice").click(function(){
                        $('#myModal').modal("hide");
                        window.location.assign("http://" + window.location.hostname + "/Toy_children/admin/product");
                    });
                    // Nếu cần, có thể chuyển hướng hoặc reset form
                    $("#create_product")[0].reset(); // Đặt lại form
                }
            },
            error: function(xhr, status, error) {
                console.log('Có lỗi xảy ra khi gửi form. Vui lòng thử lại!');
            }
        });
    });
})
    