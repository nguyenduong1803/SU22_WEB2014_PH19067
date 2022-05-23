<?php
require "database/get.php";
$products = getProduct();
?>

<style>
  .banner_img {
    height: 459px;
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

  /* .bestSeller */

  .bestSeller {
    overflow: hidden;
    min-height: 900px;
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

  .seller-item {
    position: relative;
    height: auto;
    text-align: center;
  }

  

  .seller-item:hover>.seller_hover {
    filter: opacity(0.4);
    box-shadow: 0 5px 8px rgb(87, 86, 86);
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
  }

  .money {
    font-family: sans-serif;
    font-size: 15px;
    font-weight: 900;
    color: #f97e6c;
    margin-bottom: 10px;
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

  .show {
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

  .show:hover {
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

  .show:hover>.seller-item {}

  .seller-item:hover>.show {
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
  }

  .manClock.active {
    background-color: rgba(17, 16, 16, 0.8);
    color: #fff;
  }

  .femanClock.active {
    background-color: rgba(17, 16, 16, 0.8);
    color: #fff;
  }

  .phuKien.active {
    background-color: rgba(17, 16, 16, 0.8);
    color: #fff;
  }

  .man-seller {
    margin: 0 auto;
    width: 100%;
    text-align: center;
  }



  .seller-product2 {
    display: flex;
    justify-content: space-between;
  }

  .feman-seller {
    display: none;
    margin: 0 auto;
    width: 80%;
    text-align: center;
  }

  .feman-title {
    margin: 0 158px;
  }

  .feman-product {
    display: flex;
    justify-content: space-between;
  }

  .feman-product2 {
    display: flex;
    justify-content: space-between;
  }

  .item-seller {
    display: none;
    margin: 0 auto;
    width: 80%;
    text-align: center;
  }

  .phuKien-product {
    display: flex;
    justify-content: space-between;
  }

  .phuKien-product2 {
    display: flex;
    justify-content: space-between;
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

  /* detail */
  .details {
    display: none !important;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .detail__product {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 800px;
    height: 500px;
    background-color: #fff;
    display: flex;
    justify-content: space-between;
    padding: 10px;
  }

  .details__close {
    position: absolute;
    top: -5.5%;
    right: -3.7%;
    font-size: 37px;
    z-index: 11;
  }

  .detail__img img {
    height: 500px;
    height: 380px;
  }

  .detail__bigImg {
    border: 1px solid rgb(207, 206, 206);
    margin-bottom: 10px;
  }

  .detail__img {
    flex-basis: 49%;
  }

  .detail__imgMini img {
    border: 1px solid rgb(207, 206, 206);
    width: 80px;
    height: 80px;
  }

  .detail__imgMini {
    display: flex;
    justify-content: space-between;
  }

  .detail__imgMini .active {
    border: 1px solid red !important;
  }

  .detail__text {
    flex-basis: 49%;
  }

  .detail__text h2 {
    margin-bottom: 15px;
  }

  .space {
    display: inline-block;
    margin: 0 5px 10px 6px;
  }

  .detail__text span {
    font-size: 11.5px;
  }

  .money {}

  .detail__quantity {
    width: 219px;
    height: 40px;
    margin: 20px 0;
    color: rgb(61, 60, 60);
    display: flex;
    justify-content: space-between;
    text-align: center;
  }

  .minus {
    width: 40px;
    height: 100%;
    border-right: 1px solid rgb(207, 206, 206);
    font-size: 23px;
    margin-right: 15px;
  }

  .minus:hover {
    cursor: pointer;
  }

  .num {
    display: inline-block;
    width: 50px;
    height: 60px;
  }

  .plus:hover {
    cursor: pointer;
  }

  .plus {
    width: 40px;
    height: 100%;
    border-left: 1px solid rgb(207, 206, 206);
    margin-left: 15px;
    font-size: 23px;
  }

  .detail__s {
    display: flex;
    justify-content: space-between;
    margin-left: 10px;
    border: 1px solid rgb(207, 206, 206);
    width: 100px;
    height: 30px;
  }

  .detail__quantity span {
    font-size: 20px;
  }

  .detail__text button {
    height: 37px;
    width: 170px;
    background-color: #fff;
    color: #000;
    border: 1px solid rgb(83, 83, 83);
  }

  .detail__text button:hover {
    background-color: rgba(17, 16, 16, 0.8);
    color: #fff;
    cursor: pointer;
  }

  .size20 {
    font-size: 20px;
  }

  .detail__imgMini img:hover {
    cursor: pointer;
  }

  .detail__img {
    position: relative;
  }

  .nextPrev {}

  .detail__imgMini:hover>.nextPrev {
    background: #000;
  }

  .next {
    font-size: 40px;
    position: absolute;
    background-color: rgba(27, 27, 27, 0.3);
    color: #fff;
    right: 0;
    bottom: 5%;
    border-radius: 50%;
  }

  .next:hover {
    cursor: pointer;
  }

  .prev {
    color: #fff;
    position: absolute;
    left: 0;
    font-size: 40px;
    background-color: rgba(27, 27, 27, 0.3);
    bottom: 5%;
    border-radius: 50%;
  }

  .prev:hover {
    cursor: pointer;
  }
  .product__img{
    max-width: 100%;
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

<div class="container">
  <div class="top">
    <h2 class="products-title">TOP SẢN PHẨM BÁN CHẠY</h2>
    <div class="line"></div>
  </div>
  <div class="bestSeller">
    <div class="sell-title row justify-content-center">
      <p class="manClock active  col-lg-3 col-md-4 col-sm-6">Đồng hồ nam</p>
      <p class="femanClock   col-lg-3 col-md-4 col-sm-6">Đồng hồ nữ</p>
      <p class="phuKien col-lg-3 col-md-4 col-sm-6">Phụ kiện</p>
      <p class="phuKien col-lg-3 col-md-4 col-sm-6">Phụ kiện</p>
    </div>
    <div class="man-seller">
      <div class="row seller-item">
        <?php
        foreach ($products as $key => $value) {
          # code...

        ?>
          <div class="seller-item col-lg-3 col-md-4 col-sm-6">
              <div class="seller_hover"><img class="product__img" id="" src="<?php echo $value['hinhAnh'] ?>" alt=""> </div>
              <h2 id=""><?php echo $value['tenHangHoa'] ?></h2>
              <span class="minusPrice"><?php echo $value['donGia'] ?></span>
              <p class="money"><?php echo $value['donGia'] ?><u>đ</u></p>
              <ion-icon class="show" name="eye-outline"></ion-icon>
              <ion-icon class="add-cart" name="cart-outline"></ion-icon>
              <span class="sale">-<?php echo $value['mucGiamGia'] ?>%</span>
          </div>
        <?php
        }
        ?>
      </div>

    </div>
    <div class="feman-seller">
      <div class="feman-product">
      </div>
      <div class="feman-product2">
      </div>
    </div>
    <div class="item-seller">
      <div class="phuKien-product">
      </div>
      <div class="phuKien-product2">
      </div>
    </div>
  </div>
</div>

<!-- <div class="details">
  <div class="detail__product">
    <ion-icon class="details__close" name="close-outline"></ion-icon>
    <div class="detail__img">
      <div class="detail__bigImg">
        <img src="${c.img}" alt="">
      </div>
      <div class="detail__imgMini">

      </div>
      <div class="nextPrev">
        <ion-icon class="prev" name="chevron-back-outline"></ion-icon>
        <ion-icon class="next" name="chevron-forward-outline"></ion-icon>
      </div>
    </div>
    <div class="detail__text">
      <h2>${c.name}</h2>
      <span>Thương hiệu: đang cập nhật</span><span class="space">|</span>
      <span>Mã sản phẩm: Đang cập nhật</span>
      <span class="minusPrice size20 ">${price1}<u>đ</u></span>
      <p class="money size20">${minusPrice.toLocaleString()}<u>đ</u></p>
      <div class="detail__quantity">
        <span class="size13">Số lượng: </span>
        <div class="detail__s">
          <ion-icon class="minus" name="remove-outline"></ion-icon>
          <span class="num">1</span>
          <ion-icon class="plus" name="add-outline"></ion-icon>
        </div>
      </div>
      <button class="addProduct">Thêm vào sản phẩm</button>
    </div>
  </div>
</div> -->

<script>

</script>