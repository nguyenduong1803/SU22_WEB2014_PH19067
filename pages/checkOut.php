<style>
    .wrap_text {
        border-bottom: 1px solid #F5F5F5;
        min-height: 40px;
    }

    .mini_product {
        width: 80px;
        height: 80px;
    }
    .checkout_product{
        background-color: #fcfcfc;
        padding: 24px;
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
    <div class="row">
        <div class="col-lg-4">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Họ và tên</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Họ và tên">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoại</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Ghi chú</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ghi chú">
                </div>

            </form>
        </div>
        <div class="col-lg-4">
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
        </div>
        <div class="col-lg-4">
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
                    <form class="form-inline">
                        <input type="text" class="d-inline-block" id="inputPassword2" placeholder="Nhập mã giảm giá">
                        <button type="submit" class="btn btn-primary mb-2 d-inline-block">Áp dụng</button>
                    </form>
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
                            <span>
                                < Quay về giỏ hàng</span>
                        </div>
                        <button class="btn  btn-primary">Đặt hàng</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>