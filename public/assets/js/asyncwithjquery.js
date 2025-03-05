$(document).ready(function () {
    let parentbtn = $("#next-step-data");
    let btnstep = parentbtn.children().first();;
    let btnnext = parentbtn.children().last();

    // $(".shopping-card").click(function (e) {
    //     e.preventDefault();
    //     $.get(
    //         "http://localhost/Toy_children/Checkout/cardshopping", // Trang xử lý chi tiết sản phẩm
    //         function (response) {
    //              $("#main").html(response);
    //         },
    //     );
    // })
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
});