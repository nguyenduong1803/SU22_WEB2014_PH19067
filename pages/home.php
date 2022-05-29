<?php
require "database/get.php";
$products = getProduct();
$cateArr = getCategory();
?>

<style>
    .banner_img {
        height: auto;
        max-height: 600px;
    }

    .products2 {
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

    .product-img {
        position: relative;
        display: flex;
        justify-content: center;
        width: 90%;
        margin: 0 auto;
    }

    .product-man {
        margin-right: 10px;
    }

    .zoom {
        height: auto;
        /* Chiều cao tự động  */
        margin: 10px auto;
        /* Cách trên dưới 10px và nằm giữa  */
        overflow: hidden;
        /* DÒNG BẮT BUỘC CÓ  */
        position: relative;
        /* Chiều rộng vùng chứa */
    }

    .p-text {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        top: 80%;
        font-family: 'Montserrat', sans-serif;
        color: #000;
        background-color: rgba(255, 255, 255, 0.3);
    }

    .p-title {
        display: inline-block;
        padding: 3px 0 0 10px;
        font-size: 2vw;
        margin: 0;
    }

    .product-img img {
        width: 100%;
        transition: all 1s ease;
    }

    .product-img img:hover {
        cursor: pointer;
        -webkit-transform: scale(0.5);
        transform: scale(1.1);
    }

    .p-texts {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        top: 86.5%;
        font-family: 'Montserrat', sans-serif;
        color: #000;
        background-color: rgba(255, 255, 255, 0.3);
    }

    .p-detail {
        font-size: 1.3vw;
        padding: 0 0 0 10px;
    }

    /* flash sale */
    .flash-sale {
        margin-top: 50px;
        background-image: url('./public/img/backgroundFlashSale.jpg');
        /* padding-top:50%; */
    }

    .font-big {
        font-size: 30px;
    }

    .flash {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        transition: all 0.7s;
    }

    .flash-img {
        flex: 1;
        display: flex;
        justify-content: right;
    }

    .flash-img img {
        margin-right: 25px;
        width: 67%;
        transition: all 0.9s;

        margin-bottom: 60px;
    }

    .flash:hover>.flash-img img {
        opacity: 0.5;
        box-shadow: 0 0 14px rgba(51, 50, 50, 0.8);
        cursor: pointer;
    }

    .flash-info {
        flex: 1.2;
    }

    .time {
        display: flex;
        justify-content: left;
        margin: 25px 0;
    }

    .time-item {
        background-color: #f97e6c;
        min-width: 60px;
        min-height: 60px;
        margin: 10px;
        font-family: 'Montserrat', sans-serif;
        font-size: 17px;
        color: #fff;
    }

    .time-item:first-child {
        margin-left: 0;
    }

    .btn-sale {
        font-size: 21px;
        font-family: 'Montserrat', sans-serif;
        margin: 30px 0;
        height: 44px;
        width: 170px;
        background-color: transparent;
        border: 1px solid #f97e6c;
        color: #f97e6c;
    }

    .btn-sale:hover {
        background-color: #f97e6c;
        color: #fff;
        cursor: pointer;
    }

    .h2-bot {
        font-family: 'Montserrat', sans-serif;
        margin: 20px 0;
    }

    .flash-info span {
        font-family: 'Montserrat', sans-serif;
        color: rgb(95, 93, 93);
    }

    .time span {
        display: block;
        color: #fff;
        font-size: 35px;
        font-weight: 900;
        text-align: center;
    }

    .time p {
        display: block;
        text-align: center;
    }

    .flash-head {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .flash-icon {
        margin: 20px 0;
        font-size: 60px;
        color: #f97e6c;
    }

    .flash-h2 {
        margin: 20px 0;
    }

    .seller-item {
        position: relative;
        height: auto;
        text-align: center;
    }



    .seller-item:hover>.seller_hover {
        filter: opacity(0.6);
        box-shadow: 0px 2px 10px rgba(87, 86, 86, 0.4);
        cursor: pointer;
        transition: all 0.9s;
    }

    .seller-item h2 {
        margin: 16px 0;
        font-family: 'Montserrat', sans-serif;
        font-size: 18px
    }


    .money {
        display: inline;

        font-family: sans-serif;
        font-size: 15px;
        font-weight: 900;
        color: #f97e6c;
        margin-bottom: 10px;
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
        background-color: #fff;
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
        background-color: #fff;
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

    .shows:hover>.seller-item {}

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
    .product__img {
    width: 100%;
    height: 80%;
    object-fit: contain;
    transition: all 0.9s;

  }
</style>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./public/img/banner.jpg" class="d-block w-100 banner_img" alt="...">
        </div>
        <div class="carousel-item">
            <img src="./public/img/bannerLap.png" class="d-block w-100  banner_img" alt="...">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 banner_img" src="./public/img/bannerHead.jpg" alt="">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="products2">
    <h2 class="products-title">DANH MỤC SẢN PHẨM</h2>
    <div class="line"></div>
    <div class="product-img">
        <div class="product-man">
            <div class="man-top zoom ">
                <img class="" src="./public/img/clock1.jpg" alt="">
                <div class="p-text">
                    <h2 class="p-title">Đồng hồ nam</h2>
                    <p class="p-detail">Xem thêm
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </p>
                </div>
            </div>
            <div class="man-bot zoom ">
                <img class="" src="./public/img/PhukienNu.jpg" alt="">
                <div class="p-texts">
                    <h2 class="p-title">Phụ kiện nữ</h2>
                    <p class="p-detail">Xem thêm
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </p>
                </div>
            </div>
        </div>
        <div class="product-feman">
            <div class="feman-top zoom ">
                <img class="" src="./public/img/cate_3.jpg" alt="">
                <div class="p-texts">
                    <h2 class="p-title">Đồng hồ nữ</h2>
                    <p class="p-detail">Xem thêm
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </p>
                </div>
            </div>
            <div class="feman-bot zoom ">
                <img class="" src="./public/img/pkNam.jpg" alt="">
                <div class="p-text">
                    <h2 class="p-title">Phụ kiện nam</h2>
                    <p class="p-detail">Xem thêm
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flash-sale">
    <div class="flash-head">
        <ion-icon class="flash-icon" name="flash-outline"></ion-icon>
        <h2 class="products-title flash-h2">FLASH SALE HÀNG TUẦN</h2>
    </div>
    <div class="line"></div>
    <div class="flash">
        <div class="flash-img">
            <img src="./public/img/clock5.jpg" alt="">
        </div>
        <div class="flash-info">
            <h2 class="h2-bot">Black Link</h2>
            <span class="minusPrice">3.500.000<u>đ</u></span>
            <p class="money font-big">1.300.000<u>đ</u></p>
            <div class="time">
                <div class="time-day time-item"></div>
                <div class="time-hour time-item"></div>
                <div class="time-minutes time-item"> </div>
                <div class="time-seconds time-item"></div>
            </div>
            <span>Đồng hồ MVMT Black Link dòng Classic với thiết kế tối giản tinh tế cho các quý ông hiện
                đại.<br>
                Nhập khẩu chính hãng từ US. Free ship toàn quốc.<br></span>
            <button class="btn-sale">Mua ngay</button>
        </div>
    </div>
</div>
<h2 class="center title">ALL PRODUCTS</h2>
<div class="line"></div>
<div class="container">
    <div class="man-seller">
        <div class="row seller-item">
            <?php
            foreach ($products as $key => $value) {
                # code...
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="seller-item ">
                        <div class="seller_hover"><img class="product__img" id="" src="<?php echo $value['hinhAnh'] ?>" alt=""> </div>
                        <h2 id=""><?php echo $value['tenHangHoa'] ?></h2>
                        <span class="minusPrice"><?php echo $value['donGia'] ?></span>
                        <p class="money"><?php echo $value['donGia'] ?><u>đ</u></p>
                        <ion-icon class="shows" name="eye-outline"></ion-icon>
                        <ion-icon class="add-cart" name="cart-outline"></ion-icon>
                        <span class="sale">-<?php echo $value['mucGiamGia'] ?>%</span>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <nav aria-label="Page navigation example ">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</div>

<script type="text/javascript">
function getTime() {
    console.log("getTime");
    var countDownDate = new Date("July 01, 2022 00:00:00").getTime();
    // Update the count down every 1 second
    var x = setInterval(function () {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        // console.log(seconds);
        // document.querySelector(".time").innerHTML = days + 'day' +
        //     hours + "h " + minutes + "m " + seconds + "s ";
        $('.time-day').innerHTML = `<span>  ${days} </span><p> Ngày</p> `
        $('.time-hour').innerHTML = `<span>  ${hours} </span><p> Giờ</p> `
        $('.time-minutes').innerHTML = `<span> ${minutes} </span><p>Phút</p>  `
        $('.time-seconds').innerHTML = `<span>  ${seconds} </span><p>Giây</p>`
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.querySelector(".time").innerHTML = "Hết thời gian";
        }
    }, 1000);}
    getTime();
</script>