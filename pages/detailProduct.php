<?php
if (session_id() === '') session_start();
// public/img/clock6.jpg
require "database/get.php";
require "database/add.php";
require "./lib/extention.php";
$ip;
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$id = $_GET['id'];
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $user = getUserById($userId);
}
$comments = getComment($id);
$showProduct = getProductById($id);
$products = getProduct();

if (isset($_COOKIE[$id])) {
    $userIp = json_decode($_COOKIE[$id]);
    foreach ($userIp as $key => $value) {
        if ($value != $ip) {
            $view = $showProduct[0]['soLuotXem'];
            $newView = (int)$view + 1;
            echo $newview;

            $sql = "UPDATE `hanghoa` SET `soLuotXem` = {$newView} WHERE `hanghoa`.`maHangHoa` = {$id}";
            db_insert($sql);
            saveCookie($ip, $id, 10);
        }
    }
} else {
    $view = $showProduct[0]['soLuotXem'];
    $newView = (int)$view + 1;
    $sql = "UPDATE `hanghoa` SET `soLuotXem` = {$newView} WHERE `hanghoa`.`maHangHoa` = {$id}";
    db_insert($sql);
    saveCookie($ip, $id, 30);
}
// $sqlView = "SELECT soLuotxem FROM hanghoa where maHangHoa= {$id}";


// setcookie($id,$ip,time()+36);

// print_r(getdate());
// $product = getProductById(1);
$notify = "";
if (isset($_POST['sendComment'])) {
    //    var_dump($product);
    if (isset($_SESSION['username'])) {
        $productId = $products[0]['maHangHoa'];
        $content = $_POST['content'];
        if ($content === "") {
            $notify = "Vui lòng nhập bình luận";
        } else {
            // header('Location:?page=handleClick');
            if (isset($_POST['content'])) {
                //     echo $productId;
                //   $content=  $_GET['content_cmt'];
                $sql = "INSERT INTO `binhluan` ( `noiDung`, `maHangHoa`, `ngayBinhLuan`, `maKh`)
                 VALUES ( '$content', '$id',now(), '$userId');";
                db_insert($sql);
                echo $product;
                header("Location:?page=detailProduct&&id={$id}");
            }
        }
    } else {
        header('Location:?page=login');
    }
}
?>
<style>
    .wrap_text {
        border-bottom: 1px solid #F5F5F5;
        min-height: 40px;
    }

    .descript_product {
        margin: 40px auto;
    }
    .text-bold {
        font-weight: 700;
    }
    .price__product {
        font-weight: 700;
        color: #f97e6c;
        font-size: 2rem;
    }
    .quantity {
        display: inline-block;
        padding: 0.375rem 0.75rem;
    }

    .count {
        position: relative;
        display: block;
        color: #0d6efd;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #dee2e6;

    }

    .count_click {
        cursor: pointer;
    }

    .btn_custom {
        background-color: #f97e6c;
        color: #fff;
        font-weight: 700;
    }

    .btn_custom:hover {
        background-color: #fff;
        color: #f97e6c;
        border: 1px solid #ccc;
    }


    .sell-title {
        width: 100%;
        margin: 30px 0;

    }

    .sell-title p {
        display: inline-block;
        margin: 10px 0;
        font-size: 17px;
        font-family: 'Montserrat', sans-serif;

        min-height: 45px;
        text-align: center;
        line-height: 45px;
        font-weight: 20px;
    }

    .sell-title p:hover {
        color: #fff;
        cursor: pointer;
        background-color: rgba(17, 16, 16, 0.8);
    }

    .manClock.active {
        background-color: rgba(17, 16, 16, 0.8);
        color: #fff;
    }

    .manClock,
    .phuKien,
    .femanClock {
        width: 100%;
    }

    .products-title {
        font-weight: 1000;
        text-align: center;
        font-size: 40px;
        font-family: monospace;
        margin: 60px 0 10px 0;
    }

    .line {
        border-bottom: 2px solid tomato;
        width: 150px;
        margin: 0 auto;
        margin-bottom: 20px;
    }

    .review {
        padding: 10px 0 50px 0;
        margin: 20px 0;
        background-color: #fcf9f4;
    }

    .box_vote {
        padding: 30px;
        background-color: rgba(128, 187, 53, 0.1);

    }

    .btn-vote {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 3px;
        height: 44px;
        width: 120px;
        margin: 2px;
    }

    .resuilt_vote {
        color: #80BB35;
        font-weight: 500;
        font-size: 2.3rem;
        text-align: center;
    }

    .btn_green {
        background-color: #80BB35;
        width: 100%;
        height: 40px;
        color: #fff;
        font-weight: 500;
    }

    .btn_green:hover {
        color: #fff;
    }

    .wrap_all_vote {
        border: 1px solid #ccc;
    }

    .wrap_commment {
        background-color: #fff;
        padding: 24px;
        border-top: 1px solid #ccc;
    }

    /* product */
    .seller-item:hover>.shows {
        display: block;
    }

    .seller-item:hover>.add-cart {
        display: block;
    }

    .sale {
        position: absolute;
        top: 5px;
        left: 17px;
        padding: 3px;
        line-height: 1.5;
        font-size: 15px;
        background-color: #f97e6c;
        font-family: 'Montserrat', sans-serif;
        color: #fff;
        border-radius: 2px;
        animation: flash infinite 1.4s;
    }

    .manClock.active {
        background-color: rgba(17, 16, 16, 0.8);
        color: #fff;
    }

    .product__img {
        max-width: 100%;
        height: 80%;
        object-fit: contain;
        transition: all 0.9s;

    }

    .minusPrice {
        display: inline-block;
        margin-right: 10px;
        text-decoration: line-through;
        font-family: 'Montserrat', sans-serif;
        color: #000;
        font-weight: 700;
        opacity: 0.5;
        font-size: 12px;
    }

    .money {
        display: inline;

        font-family: sans-serif;
        font-size: 15px;
        font-weight: 900;
        color: #f97e6c;
        margin-bottom: 10px;
    }

    .form_cmt {
        margin: 12px;
    }

    .cmt_input {
        margin-right: 24px;
    }

    .wrap_content {
        background-color: #F5F5F5;
        border-radius: 20px;
        width: 100%;
        padding: 12px;
        margin-left: 10px;
    }

    @keyframes flash {
        0% {
            color: #fff
        }

        50% {
            color: #fce9ff;
        }

        100% {
            color: #f86363;
        }
    }

    @keyframes mymove {
        from {
            opacity: 0;
            right: 0;
        }

        to {
            opacity: 1;
            right: 15px;
        }
    }

    .shows {
        display: none;
        font-weight: 900;
        border-radius: 50%;
        border: 1px solid #f97e6c;
        color: #f97e6c;
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 30px;
        padding: 3px;
        animation: mymove 0.3s linear;
    }

    .add-cart {
        display: none;
        font-weight: 900;
        border-radius: 50%;
        border: 1px solid #f97e6c;
        color: #f97e6c;
        position: absolute;
        top: 60px;
        right: 15px;
        font-size: 30px;
        padding: 3px;
        animation: mymove 0.3s linear;
    }

    .shows:hover {
        border: 1px solid #fff;
        background-color: #f97e6c;
        cursor: pointer;
        color: #fff;
    }

    .add-cart:hover {
        border: 1px solid #fff;
        background-color: #f97e6c;
        cursor: pointer;
        color: #fff;
    }

    .avatar {
        vertical-align: middle;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .avatar_bot {
        position: relative;
        top: 4px;
    }

    .comment_item {
        margin: 0 12px;
        /* border: 1px solid #d8d8d8; */
        border-radius: 3px;
        padding: 10px;
    }

    .seller_hover {
        position: relative;
    }

    .text_avatar {
        /* margin: 0 12px; */
        font-weight: 400;
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thông tin sản phẩm</li>
        </ol>
    </nav>
    <section class="descript_product">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="wrap d-flex justify-content-end">
                    <img class="img-fluid col-lg-12" src="<?php echo $showProduct[0]['hinhAnh'] ?>" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="wrap">
                    <div class="wrap_text">
                        <h2><?php echo $showProduct[0]['tenHangHoa'] ?></h2>
                        <p class="price__product"><?php echo $showProduct[0]['donGia'] ?></p>
                    </div>
                    <div class="wrap_text">
                        <p> <span>Loại máy: </span> <span class=" text-bold">Đang cập nhật</span></p>
                        <p><span>Thương hiệu: </span> <span class=" text-bold">Đang cập nhật</span></p>
                        <p><span class="text-justify">Mô tả: <?php echo $showProduct[0]['moTa'] ?>.</span></p>
                    </div>
                    <div class="wrap_text">
                        <p><i class="fa-solid fa-truck-fast"></i> <span class="text-ads">Giao hàng toàn quốc </span></p>
                        <p><i class="fa-solid fa-sack-dollar"></i></i> <span class="text-ads">Thanh toán khi nhận hàng </span></p>
                        <p><i class="fa-solid fa-arrows-rotate"></i> <span class="text-ads">Cam kết đổi trả miễn phí </span></p>
                        <p><i class="fa-solid fa-shield-halved"></i> <span class="text-ads">Hàng chính hãng/Bảo hành 10 năm </span></p>
                    </div>
                    <div class="wrap_text">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div>
                        <ul class="pagination ">
                            <li class="increase"><span class="page-link count_click">-</span></li>
                            <li class="count"><span class="quantity">1</span></li>
                            <li class="decrease"><span class="page-link count_click">+</span></li>
                            <li> <span>Còn lại 3 sản phẩm trong kho</span></li>
                        </ul>

                    </div>
                    <div>
                        <div class="btn btn_custom">Thêm vào giỏ hàng</div>
                        <div class="btn btn_custom">Mua ngay</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="">
        <div class="sell-title row justify-content-center">

            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="manClock active  ">Thông tin sản phẩm</p>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="femanClock">Chính sách vận chuyển</p>

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="phuKien">Đổi trả & Bảo hành</p>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <p class="phuKien">Hình thức thanh toán</p>
            </div>


        </div>
    </section>

</div>
<section class="review">
    <div class="container">
        <h2 class="products-title ">REVIEWS CỦA KHÁCH HÀNG</h2>
        <div class="line"></div>
        <div class="wrap_all_vote">
            <div class="box_vote">
                <div class="row">
                    <div class="col-lg-3">
                        <p class="resuilt_vote">5/5</p>
                        <div class="wrap_star text-center">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-center">( 1 Đánh giá )</p>
                        <button class="btn btn_green">Gửi đánh giá của bạn</button>
                    </div>
                    <div class="col-lg-9">
                        <button class="btn btn-vote">Tất cả</button>
                        <button class="btn btn-vote">5 Điểm(1)</button>
                        <button class="btn btn-vote">4 Điểm (2)</button>
                        <button class="btn btn-vote">3 Điểm (1)</button>
                        <button class="btn btn-vote">2 Điểm (1)</button>
                        <button class="btn btn-vote">1 Điểm (0)</button>
                    </div>
                </div>
            </div>
            <div class="wrap_commment">
                <?php
                if (isset($_COOKIE['username'])) {
                } else {
                    //     echo ' <div class="write_cmt ">
                    //     <img class="avatar" src="./public/img/avt2.png" alt=""></img>
                    //     <input type="text">
                    //     <a href="" class="btn btn-success">Comment</a>
                    // </div>';
                }
                ?>
                <div class="write_cmt ">
                    <form method="POST" class="row form_cmt">
                        <div class="col-lg-1 ">
                            <img class="avatar" src="./<?php echo $user[0]['hinhAnh'] ?>" alt=""></img>
                        </div>
                        <input type="text" class="col-lg-9" name="content" placeholder="Viết bình luận">
                        <button type="submit" class="btn btn-primary col-lg-2" name="sendComment" value="Comment">Comment</button>
                        <p> <?php echo $notify  ?></p>
                    </form>
                </div>
                <!-- <a href="" class="btn btn-success">Comment</a> -->
                <?php
                foreach ($comments as $key => $value) {
                    // if($value['maHangHoa']===$id){

                ?>
                    <div class="comment_item d-flex">
                        <img class="avatar d-inline-block avatar_bot" src="./<?php echo joinUserCmt($value['maKh'])[0]['hinhAnh']  ?>" alt=""></img>
                        <div class="wrap_content">
                            <h4 class="d-inline-block text_avatar"><?php echo joinUserCmt($value['maKh'])[0]['tenKh'] ?></h4>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <p class="comment_content"><?php echo  $value['noiDung'] ?></p>
                            <div>
                                <span> <i class="fa-solid fa-thumbs-up"></i> Hữu ích</span>
                                <span> <i class="fa-solid fa-triangle-exclamation"></i> Báo cáo sai phạm</span>
                                <span><?php echo $value['ngayBinhLuan'] ?></span>
                            </div>
                        </div>
                        <!-- <div><i class="fa-solid fa-check"></i><span>Đã mua hàng tại cửa hàng</span></div> -->
                    </div>
                <?php
                }
                // }
                ?>
            </div>
        </div>

    </div>
</section>
<section class="">
    <h2 class="products-title ">SẢN PHẨM TƯƠNG TỰ</h2>
    <div class="line"></div>
    <div class="container">
        <div class="row seller-item">
            <?php
            foreach ($products as $key => $value) {
                # code...

            ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="seller-item ">
                        <a href="?page=detailProduct&&id=<?php echo $value['maHangHoa'] ?>" class="seller_hover">
                            <img class="product__img" id="" src="<?php echo $value['hinhAnh'] ?>" alt="">
                            <span class="sale">-<?php echo $value['mucGiamGia'] ?>%</span>
                        </a>
                        <h2 id=""><?php echo $value['tenHangHoa'] ?></h2>
                        <span class="minusPrice"><?php echo $value['donGia'] ?></span>
                        <p class="money"><?php echo $value['donGia'] * (100 - $value['mucGiamGia']) ?><u>đ</u></p>
                        <ion-icon class="shows" name="eye-outline"></ion-icon>
                        <ion-icon class="add-cart" name="cart-outline"></ion-icon>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</section>