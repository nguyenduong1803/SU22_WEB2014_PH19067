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
                <label for="exampleInputEmail1">Họ và tên</label>
                <input type="email" class="form-control"name="name" placeholder="Họ và tên">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Số điện thoại</label>
                <input type="email" class="form-control"name="phone" placeholder="Số điện thoại">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tỉnh/Thành phố, Quận/Huyện, Xã/Phường </label>
                <input type="email" class="form-control"name="address" placeholder="Địa chỉ">

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Ghi chú</label>
                <input type="email" class="form-control"name="note" placeholder="Ghi chú">
            </div>

            <div class="d-flex">
                <div class=" col-lg-6 ">
                    <div class="btn-success btn_address">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="home">
                        <label class="label_address" for="home">
                            Nhà riêng
                        </label>
                    </div>

                </div>
                <div class=" col-lg-6 ">
                    <div class="btn-success btn_address">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="office">
                        <label class="label_address" for="office">
                            Văn Phòng
                        </label>
                    </div>

                </div>
            </div>

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
                    <span>Đơn hàng ( 5 sản phẩm )</span>

                </div>
                <div class="wrap_text">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <img class="mini_product" src="public/img/img4p4.jpg" alt="">
                            <span>State</span>
                        </div>
                        <div class="price">1200000 đ</div>

                    </div>

                </div>
                <div class="wrap_text">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <img class="mini_product" src="public/img/img4p4.jpg" alt="">
                            <span>State</span>
                        </div>
                        <div class="price">1200000 đ</div>

                    </div>
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
                            <span>Tạm tinh</span>
                        </div>
                        <div class="price">1200000 đ</div>

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
                        <div class="price">30000 đ</div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <a href="?page=checkOut">
                                < Quay về giỏ hàng</a>
                        </div>
                        <button class="btn  btn-success">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>