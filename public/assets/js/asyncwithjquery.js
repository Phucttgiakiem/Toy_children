$(document).ready(function () {
    let parentbtn = $("#next-step-data");
    let btnstep = parentbtn.children().first();;
    let btnnext = parentbtn.children().last();

    $(".detail-pd").click(function (e) {
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
    })
});