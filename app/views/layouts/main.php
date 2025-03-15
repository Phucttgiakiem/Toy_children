<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Fruitables - Vegetable Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https:/fonts.googleapis.com">
        <link rel="preconnect" href="https:/fonts.gstatic.com" crossorigin>
        <link href="https:/fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https:/use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link rel="stylesheet" href="https:/cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https:/cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" >

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="/Toy_children/public/assets/lib/lightbox/css/lightbox.min.css" >
        <link rel="stylesheet" href="/Toy_children/public/assets/lib/owlcarousel/assets/owl.carousel.min.css" >


        <!-- Customized Bootstrap Stylesheet -->
        <link rel="stylesheet" href="/Toy_children/public/assets/css/bootstrap.min.css" >

        <!-- Template Stylesheet -->
        <link rel="stylesheet" href="/Toy_children/public/assets/css/style.css">
    </head>

    <body>

        
        <?php 
            require_once __DIR__ . "/header.php" 
        ?>

        <div id="main">
            <?php
                global $sharedData;
                $content_page = $sharedData['content_page'];
                require_once ($content_page);
            ?>
        </div>
        <!-- Footer Start -->
        <div class="container-fluid text-white-50 footer pt-5" style="background-color:#dee2e6;min-height:30rem">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0">ToyToy shop</h1>
                            </a>
                        </div>
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                </div>
            </div>
        </div>
        <!-- Footer End -->
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4" style="background-color:#dee2e6">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        Thiết bởi <a class="border-bottom" href="#">HTML</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   
       
        
    <!-- JavaScript Libraries -->
    
    <script src="https:/ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https:/cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Toy_children/public/assets/lib/easing/easing.min.js"></script>
    <script src="/Toy_children/public/assets/lib/waypoints/waypoints.min.js"></script>
    <script src="/Toy_children/public/assets/lib/lightbox/js/lightbox.min.js"></script>
    <script src="/Toy_children/public/assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/Toy_children/public/assets/js/main.js"></script>
    <script src="/Toy_children/public/assets/js/asyncwithjquery.js"></script>
    </body>

</html>