<?php
if (session_id() === '')
    session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự Án Mẫu</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/45281df593.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./public/css/style.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>

<body>
    <style>
        .bigs {
            background-color: #fff !important;
        }
        .nav__item{
            box-shadow:1px 2px 20px rgb(114 114 114 / 30%);
        }
        .mynav {
            margin-bottom: 4px;
        }

        .nav_ul {
            height: 60px;
        }

        .ul_mynav {
            background-color: #fff;
            z-index: 30;
        }

        .logo_xshop {
            max-width: 180px;
        }
        .navlinks{
            color:#4a4a4a;
        }
    </style>
    <nav class="navbar navbar-expand-lg bg-light nav__item">
        <div class="container ">
            <a class="navbar-brand" href="?page=home"><img class="logo_xshop" src="./public/img/xshop.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ul_mynav m-auto">
                        <!-- Megamenu-->
                        <li class="nav-item"><a href="?page=home" class="nav-link navlinks links font-weight-bold text-uppercase">Trang chủ</a></li>
                        <!-- <li class="nav-item"><a href="?page=recomand" class="nav-link navlinks links font-weight-bold text-uppercase">Giới thiệu</a></li> -->
                        <li class="nav-item"><a href="?page=news" class="nav-link navlinks links font-weight-bold text-uppercase">Tin tức</a></li>
                        <li class="nav-item"><a href="?page=products" class="nav-link navlinks links font-weight-bold text-uppercase">Sản phẩm</a></li>
                        <li class="nav-item"><a href="?page=cart" class="nav-link navlinks links font-weight-bold text-uppercase">Giỏ hàng</a></li>
                        <li class="nav-item"><a href="?page=register" class="nav-link navlinks links font-weight-bold text-uppercase">Đăng Ký</a></li>
                        <li class="nav-item"><a href="?page=<?php
                                                            if (isset($_SESSION['username'])) {
                                                                if ($_SESSION['username'] === 'admin' || $_SESSION['role'] === 1) {
                                                                    echo "admin";
                                                                } else {
                                                                    echo "loginSusses";
                                                                }
                                                            } else {
                                                                echo "login";
                                                            }
                                                            ?>" class="nav-link navlinks links font-weight-bold text-uppercase">
                                <?php echo isset($_SESSION['username']) ? "Chào " . $_SESSION['username'] : "Đăng nhập"; ?> </a></li>
                    </ul>
                
            </div>
        </div>
    </nav>
    <div class="bigs">
        <main id="main">