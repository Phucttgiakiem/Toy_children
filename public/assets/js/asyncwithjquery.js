$(document).ready(function () {
    let parentbtn = $("#next-step-data");
    let btnstep = parentbtn.children().first();
    let btnnext = parentbtn.children().last();
   
    const validateEmail = (email) => {
        return String(email)
            .toLowerCase()
            .match(
                /^[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/i
            );
    }
    const checkPassword = (str) => {
        var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return re.test(str);
    }
    btnstep.click(function () {
        let page1 = $(this).data("id");
        let parentsp = $(".ls-sp");
        if(Number(page1)>= 1){
            $.get(
                "http://localhost/Toy_children/Product/Getnewlistproduct",
                {
                    page:page1
                },
                function(res){
                    let arr = res.product;
                    
                    let divparent = "";
                    if (arr.length > 0) {
                    for(let i = 0; i < arr.length;i++){
                        let div = `
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item d-flex flex-column h-100 " >
                                    <div class="fruite-img" >
                                        <img src="public/assets/img/${arr[i].HinhURL}" class="img-fluid w-100 rounded-top" alt="">
                                    </div>
                                    <!-- <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div> -->
                                    <div class="d-flex flex-column justify-content-between p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1">
                                        <h4>${arr[i].TenSanPham}</h4>
                                        <p class="flex-grow-1">${arr[i].MoTa}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">${arr[i].GiaSanPham} đ</p>
                                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary detail-pd" data-id="${arr[i].MaSanPham}"><i class="fas fa-info-circle me-2 text-primary"></i> Chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        divparent += div;
                    } 
                        parentsp.html(divparent);
                    
                        btnnext.data('id', Number(res.page) + 1);
                        btnstep.data('id', Number(res.page) - 1); 
                    }
                }
            )
        }
    })
    btnnext.click(function () {
        let page1 = $(this).data("id");
        let parentsp = $(".ls-sp");
        $.get(
            "http://localhost/Toy_children/Product/Getnewlistproduct",
            {
                page:page1
            },
            function(res){
                let arr = res.product;
                
                let divparent = "";
                if (arr.length > 0) {
                for(let i = 0; i < arr.length;i++){
                    let div = `
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item d-flex flex-column h-100 " >
                                <div class="fruite-img" >
                                    <img src="public/assets/img/${arr[i].HinhURL}" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <!-- <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div> -->
                                <div class="d-flex flex-column justify-content-between p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1">
                                    <h4>${arr[i].TenSanPham}</h4>
                                    <p class="flex-grow-1">${arr[i].MoTa}</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">${arr[i].GiaSanPham} đ</p>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary detail-pd" data-id="${arr[i].MaSanPham}"><i class="fas fa-info-circle me-2 text-primary"></i> Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>`
                    divparent += div;
                } 
                    parentsp.html(divparent);
                
                    btnnext.data('id', Number(res.page) + 1);
                    btnstep.data('id', Number(res.page) - 1); 
                }
            }
        )
    })
    $(document).on('click',".detail-pd",function (e) {
        e.preventDefault(); // Ngăn chặn load trang mặc định

        let productId = $(this).data("id"); // Lấy ID từ data-id
        $.get(
            "http://localhost/Toy_children/Product/Detailproduct", // Trang xử lý chi tiết sản phẩm
            { 
                id: productId
            },
            function (response) {
                 $("#main").html(response);
            },
        );
    });
    $(document).on('click', '.add-to-card', function(e) {
        e.preventDefault();
        let idsp = $(this).data("id");
        let parent = $(this).closest("div");
        let namesp = parent.find("h4").text();
        let pricesp = parent.find("h5").text().split(" ")[0];
        let divchillass = parent.find("div:nth-last-child(2)");
        let quantity = divchillass.find("input").val();
        let img = $(".img-ps").attr("src");
        $.post(
            "http://localhost/Toy_children/Checkout/Additem",
            {
                id: idsp,
                img: img,
                name: namesp,
                price: pricesp,
                quantity:quantity,
                totalprice:pricesp*quantity
            },
            function (res){
                $(".show-inform h5").text("Thông báo");
                $(".show-inform p").text("Đã thêm sản phẩm vào giỏ hàng");

                 // Chỉ mở modal sau khi nội dung đã được cập nhật
                 setTimeout(() => {
                    $("#exampleModal").modal("show");
                }, 100);
            }
        )
    });
    $(document).on('click', '.ud-sp', function(e) {
        let idsp = $(this).data("id");
        let tr = $(`#${idsp}`);
        let parent1 = tr.find("td");
        let quantity = parent1.eq(2).find("input").val()
        $.post(
            "http://localhost/Toy_children/Checkout/Updateitem",
            {
                id: idsp,
                quantity:quantity
            },
            function (res){
                $(".show-inform h5").text("Thông báo");
                $(".show-inform p").text(res.Notification);
                $(".subtotal").text(res.tongdonhang+" đ");
                $(".Total-bill").text(res.tongdonhang+" đ");
                parent1.eq(3).find("p").text(res.tongsanpham + "đ");
                if(Number(quantity) == 0) parent1.eq(2).find("input").val(1);
                 // Chỉ mở modal sau khi nội dung đã được cập nhật
                 setTimeout(() => {
                    $("#exampleModal").modal("show");
                }, 100);
            }
        )
    })
    $(document).on('click', '.dl-sp', function(e) {
        let idsp = $(this).data("id");
        let tr = $(`#${idsp}`);
        $.post(
            "http://localhost/Toy_children/Checkout/Deleteitem",
            {
                id: idsp,
            },
            function (res){
                $(".show-inform h5").text("Thông báo");
                $(".show-inform p").text(res.Notification);
                $(".subtotal").text(res.tongdonhang+" đ");
                $(".Total-bill").text(res.tongdonhang+" đ");
                tr.remove();
                 // Chỉ mở modal sau khi nội dung đã được cập nhật
                 setTimeout(() => {
                    $("#exampleModal").modal("show");
                }, 100);
            }
        )
    })
    $(document).on('click', '.w-sp', function(e) {
        let idsp = $(this).data("id");
        $.get(
            "http://localhost/Toy_children/Product/Detailproduct", // Trang xử lý chi tiết sản phẩm
            { 
                id: idsp
            },
            function (response) {
                 $("#main").html(response);
            },
        );
    });
    const createaccount = (username,fullname,email,pass,address,numberphone) => {
        $.post(
            "http://localhost/Toy_children/User/handleregister",
            {
                username:username,
                fullname:fullname,
                email:email,
                password:pass,
                address:address,
                numberphone:numberphone
            },
            function (res) {
                console.log(res.Notification);
                if(res.errCode != 0){
                    $(".show-inform h5").text("Thông báo");
                    $(".show-inform p").text(res.Notification);
                    $("#exampleModal").modal("show");
                }else {
                    window.location.assign("http://" + window.location.hostname + "/Toy_children/User/Index");
                }
            }
        )
    }
    //register
    $(document).on('click','.f-register',function(e){
        e.preventDefault();
        let username = $("#res-username").val();
        let fullname = $("#res-fullname").val();
        let email = $("#res-email").val();
        let pass = $("#res-pass").val();
        let re_pass = $("#res-repass").val();
        let address = $("#res-address").val();
        let numberphone = $("#res-numberphone").val();

        // Flag kiểm tra tính hợp lệ
        let isValid = true;

        if(username == ""){
            $("#warning-res-username").css("display","block");
            isValid = false;
        }else {
            $("#warning-res-username").css("display","none");
        }
        if(fullname == ""){
            $("#warning-res-fullname").css("display","block");
            isValid = false;
        }else {
            $("#warning-res-fullname").css("display","none");
        }
        if(email == ""){
            $("#warning-res-email").text("Email không được để trống");
            $("#warning-res-email").css("display","block");
            isValid = false;
        }else {
            if(validateEmail(email) == null){
                $("#warning-res-email").text("Email không đúng định dạng");
                $("#warning-res-email").css("display","block");
                isValid = false;
            }
            else{
                $("#warning-res-email").text("Email không được để trống");
                $("#warning-res-email").css("display","none");
            }
        }
        if(address == ""){
            $("#warning-res-address").css("display","block");
            isValid = false;
        }else {
            $("#warning-res-address").css("display","none");
        }
        if(numberphone == ""){
            $("#warning-numberphone").css("display","block");
            isValid = false;
        }else {
            $("#warning-numberphone").css("display","none");
        }
        if(pass == ""){
            $("#warning-res-pass").text("Mật khẩu không được để trống");
            $("#warning-res-pass").css("display","block");
            isValid = false;
        }else {
            if(!checkPassword(pass)){
                $("#warning-res-pass").text("Mật khẩu không đúng định dạng, nó phải bảo gồm ít nhất 8 ký tự và chứa 1 chứ hoa, chữ thường, số và 1 ký tự đặc biệt");
                $("#warning-res-pass").css("display","block");
                isValid = false;
            }
            else {
                $("#warning-res-pass").text("Mật khẩu không được để trống");
                $("#warning-res-pass").css("display","none");
            }
        }
        if(re_pass == ""){
            $("#warning-repass").text("Nhập lại mật khẩu không được để trống");
            $("#warning-repass").css("display","block");
            isValid = false;
        }else {
            if(re_pass != pass){
                $("#warning-repass").text("Nội dung nhập không khớp với mật khẩu");
                $("#warning-repass").css("display","block");
                isValid = false;
            }else {
                $("#warning-repass").css("display","none");
            }
        }
        if(isValid) createaccount(username,fullname,email,pass,address,numberphone);
    })
    //login
    $(document).on('click','.f-login',function(e) {
        e.preventDefault();
        let usern = $("#exampleInputusername1").val();
        let pass = $("#exampleInputPassword1").val();
        if(usern == ""){
            $("#warning-usn").css("display","block");
        }else {
            $("#warning-usn").css("display","none");
        }
        if(pass == ""){
            $("#warning-pass").css("display","block");
        }else {
            $("#warning-pass").css("display","none");
        }
        if(usern != "" && pass != ""){
            $.post(
                "http://localhost/Toy_children/User/handlelogin",
                {
                    username:usern,
                    password:pass
                },
                function (res){
                    if(res.errCode == 0){
                        $(".show-inform h5").text("Thông báo");
                        $(".show-inform p").text(res.Notification);
                        $("#exampleModal").modal("show");
                    }
                    else {
                        // Kiểm tra nếu có cần chuyển hướng
                        if (res.redirect) {
                            window.location.assign(res.redirect);
                        } else {
                            window.location.assign("http://" + window.location.hostname + "/Toy_children/Home");
                        }
                    }
                } 
            )
        }
    });
    //show and hide pass
    $(document).on('click','#showpass',function(){
        $(this).css("display","none");
        $("#exampleInputPassword1").attr({"type":"text"});
        $("#hidepass").css("display","block");
    });
    $(document).on("click","#hidepass",function(){
        $(this).css("display","none");
        $("#exampleInputPassword1").attr({"type":"password"});
        $("#showpass").css("display","block");
    })
    $(document).on("click","#logout",function(e){
        e.preventDefault();
        $.get("/Toy_children/User/handlelogout",()=>{
            window.location.assign("http://" + window.location.hostname + "/Toy_children/Home");
        })
    });
    
});