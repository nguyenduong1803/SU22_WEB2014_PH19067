<?php
require "database/get.php";
require "./lib/extention.php";
if (isset($_GET['listId'])) {
    $listId = $_GET['listId'];
    $listQuantity = explode(',',  $_GET['q']);
    $products = getProductByListId($listId);
}
$totalMoney = array_reduce($products, function ($init, $value) {
    if ($value['mucGiamGia'] != 0) {
        return $init + $value['donGia'] * (100 - $value['mucGiamGia']) / 100;
    }
}, 0);
$error = [];
if (isset($_POST['btn_checkout'])) {
    $user = $_POST['user'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $office = $_POST['office'];
    if (isRequired($user)) {
        $error['user'] = "Vui lòng nhập tên khách hàng";
    } else if (strlen($user) < 6) {
        $error['user']  =  "Vui lòng điền tên khách hàng lớn hơn 6 kí tự";
    }
    if (!isNumber($phone)) {
        $error['phone']  =  "Vui lòng nhập số dương";
    }
    if (isRequired($address)) {
        $error['address'] = "Vui lòng nhập địa chỉ khách hàng";
    } else if (strlen($address) < 10) {
        $error['address']  =  "Vui lòng điền tên khách hàng lớn hơn 10 kí tự";
    }
    if (isRequired($office)) {
        $error['office']  =  "Vui lòng chọn nơi nhận hàng";
    }
}

?>

<style>
    .wrap_text {
        border-bottom: 1px solid #F5F5F5;
        min-height: 40px;
    }

    .mini_product {
        width: 80px;
        height: 80px;
    }

    .checkout_product {
        background-color: #fcfcfc;
        padding: 24px;
    }

    .btn_address {
        margin: 12px;
        padding: 12px;
    }

    .label_address {
        height: 100%;
    }

    .text_address {}

    #address {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;

    }

    #address:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
        outline: none;
    }
</style>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Đặt hàng</li>
        </ol>
    </nav>
    <h4>Thông tin nhận hàng</h4>
    <form class="row" method="POST">
        <div class="col-lg-5">

            <div class="form-group">
                <label for="exampleInputtext1">Họ và tên</label>
                <input type="text" class="form-control" name="user" placeholder="Họ và tên">
                <div class="notify"><?php echo !empty($error['user']) ? $error['user'] : ""; ?></div>

            </div>

            <div class="form-group">
                <label for="exampleInputtext1">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
            <div class="notify"><?php echo !empty($error['phone']) ? $error['phone'] : ""; ?></div>

            </div>
            <div class="form-group">
                <label for="address" class="d-block text_address">Tỉnh/Thành phố, Quận/Huyện, Xã/Phường </label>
                <textarea type="text" id="address" class="" name="address" placeholder="Địa chỉ">
                </textarea>
                <div class="notify"><?php echo !empty($error['address']) ? $error['address'] : ""; ?></div>

            </div>

            <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea type="text" id="address" class="" name="note" placeholder="Ghi chú">
                </textarea>
            </div>

            <div class="d-flex">
                <div class=" col-lg-6 ">
                    <div class="btn-success btn_address">
                        <input class="form-check-input" type="radio" name="office" id="home">
                        <label class="label_address" for="home">
                            Nhà riêng
                        </label>
                    </div>

                </div>
                <div class=" col-lg-6 ">
                    <div class="btn-success btn_address">
                        <input class="form-check-input" type="radio" name="office" id="office">
                        <label class="label_address" for="office">
                            Văn Phòng
                        </label>
                    </div>

                </div>
            </div>
            <div class="notify"><?php echo !empty($error['office']) ? $error['office'] : ""; ?></div>

        </div>
        <!-- <div class="col-lg-4">
            <form>
                <div class="form-group">
                    <input class="form-check-input" type="radio" name="pay">
                    <label class="form-check-label">Thanh toán khi nhận hàng</label>
                    <input type="text" class="form-control" placeholder="Thanh toán">

                </div>
                <div class="form-group">
                    <input class="form-check-input" type="radio" name="pay">
                    <label class="form-check-label">Thanh toán bằng thẻ</label>
                    <input type="text" class="form-control" placeholder="Ghi chú">

                </div>

            </form>
        </div> -->
        <div class="col-lg-6">
            <div class="checkout_product">
                <div class="wrap_text">
                    <span>Đơn hàng (<?php echo isset($_GET['listId']) ?  count($products) : "0" ?> sản phẩm )</span>

                </div>
                <?php
                if (isset($_GET['listId'])) {
                    foreach ($products as $key => $value) {
                ?>
                        <div class="wrap_text">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <img class="mini_product" src="<?php echo $value['hinhAnh'] ?>" alt="">
                                    <span><?php echo $value['tenHangHoa'] ?></span>
                                </div>
                                <div class="quantity">x<?php echo $listQuantity[$key] ?></div>
                                <div class="sale">giảm <?php echo $value['mucGiamGia'] ?>%</div>
                                <div class="price"><?php echo $value['donGia'] ?> đ</div>
                            </div>

                        </div>

                <?php
                    }
                }

                ?>

            </div>
            <div class="wrap_text">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Mã giảm giá" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="button" id="button-addon2">Áp dụng</button>
                </div>
            </div>
            <div class="wrap_text">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span>Tạm tính</span>
                    </div>
                    <div class="price"><?php echo $totalMoney ?> đ</div>

                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span>Phí vận chuyển</span>
                    </div>
                    <div class="price">30000 đ</div>

                </div>

            </div>
            <div class="wrap_text">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span>Tổng cộng</span>
                    </div>
                    <div class="price"><?php echo (int)$totalMoney + (int)30000 ?> đ</div>

                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <a href="?page=cart">
                            < Quay về giỏ hàng</a>
                    </div>
                    <button class="btn  btn-success" name="btn_checkout">Đặt hàng</button>
                </div>
            </div>
        </div>
</div>
</form>
</div>