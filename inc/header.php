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
    <title>Assigment giai đoạn 1</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/45281df593.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./public/css/style.css" type="text/css">

</head>

<body>
    <style>
        .bigs {
            background-color: #fff !important;
        }
        .mynav{
            margin-bottom: 4px;
        }
        .nav_ul{
            height: 60px;
        }
    </style>
    <div class="bigs">
        <nav class="navbar navbar-expand-lg navbar-light  mynav">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav_ul" id="navbarNavAltMarkup">
                        <ul class="navbar-nav mx-auto ">
                            <!-- Megamenu-->
                            <li class="nav-item"><a href="?page=home" class="nav-link links font-weight-bold text-uppercase">Trang chủ</a></li>
                            <li class="nav-item"><a href="?page=recomand" class="nav-link links font-weight-bold text-uppercase">Giới thiệu</a></li>
                            <li class="nav-item"><a href="?page=news" class="nav-link links font-weight-bold text-uppercase">Tin tức</a></li>
                            <li class="nav-item"><a href="?page=products" class="nav-link links font-weight-bold text-uppercase">Sản phẩm</a></li>
                            <li class="nav-item"><a href="?page=register" class="nav-link links font-weight-bold text-uppercase">Đăng Ký</a></li>
                            <li class="nav-item"><a href="?page=<?php
                                                                if (isset($_SESSION['username'])) {
                                                                    if ($_SESSION['username'] === 'admin' ) {
                                                                        echo "admin";
                                                                    } else {
                                                                        echo "loginSusses";
                                                                    }
                                                                } else {
                                                                    echo "login";
                                                                }
                                                                ?>" class="nav-link links font-weight-bold text-uppercase">
                                    <?php echo isset($_SESSION['username']) ? "Chào " . $_SESSION['username'] : "Đăng nhập"; ?> </a></li>
                        </ul>
                </div>
            </div>
        </nav>

        <main id="main">