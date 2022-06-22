<?php
if (!isset($_SESSION['username']) || !$_SESSION['role'] === "admin") {
    die("không thể truy cập");
}
require "./database/add.php";
require "./database/get.php";


$list = getInvoice("*");
$state = false;
$error = [];

// get category

$notify = "";
if ($state === true) {
    if (count($error) > 0 && !empty($error)) {
        $notify = "thêm thất bại";
    } else {
        $product  = "INSERT INTO `loaihang` (`tenLoaiHang`) VALUES ( '{$categoryName}');";
        db_insert($product);
        $notify = "thêm Thành công";
        header("Location:?page=manageCategory");
    }
}



?>
<style>
    .form {
        max-width: 400px;
        width: auto;
    }

    .form__conatiner {
        padding: 60px 0;
        background: #eaafc8;
        background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
        background: linear-gradient(to right, #eaafc8, #654ea3);
    }

    .mini-img {
        width: 120px;
        height: 90px;
    }

    .green {
        color: #fff;
        font-size: 1.4rem;
    }

    .green:hover,
    .red:hover {
        cursor: pointer;
    }

    .red {
        position: relative;
        top: 2px;
        color: red;
        font-size: 1.4rem;

    }

    .color-white {
        width: 100px;
        color: #fff;
        margin-left: 5px;
    }

    .btn-action {
        text-decoration: none !important;
        width: 100px;
        height: 40px;
        padding: 5px 10px;
        border-radius: 5px;
        box-shadow: 2px 4px 7px rgb(46 44 44 / 60%)
    }



    td {
        border: 1px solid #fff;
    }

    th {
        border: 1px solid #fff;
        text-align: center;
    }


    th:nth-child(1),
    th:nth-child(2) {
        width: 60px;
    }

    /* th:nth-child(5) {
        width: 30%;
    }

    th:nth-child(4) {
        width: 30px;
    } */

    .table>:not(:first-child) {
        border-top: none !important;
    }

    .th_action {
        width: 40px;

    }

    .td_child {
        position: relative;
    }
</style>
<div class="form__conatiner">
    <div class="container">
        <h2>Hóa Đơn</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã hóa đơn</th>
                    <th scope="col">Mã khách hàng</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Ghi Chú</th>
                    <th scope="col">Nơi Nhận</th>
                    <th scope="col">Tổng thanh toán</th>
                    <th scope="col" colspan="2" class="color-white th_action">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)) {
                    foreach ($list as $key => $value) {
                ?>
                        <tr>
                            <td><?php echo $value['maHoaDon'] ?></td>
                            <td><?php echo $value['maKh'] ?></td>
                            <td><?php echo $value['diaChi'] ?></td>
                            <td><?php echo $value['soDienThoai'] ?></td>
                            <td><?php echo $value['ghiChu'] ?></td>
                            <td><?php echo $value['noiNhan'] ?></td>
                            <td><?php echo $value['tongThanhToan'] ?> đ</td>
                            <td><a href="?page=manageInvoice&&hoaDon=<?php echo $value['maHoaDon'] ?>" class="btn btn-success"><i class="fa-solid fa-eye"></i> Chi tiết</a></td>
                            <td class="">
                                <a href="?page=editUser&&userEdit=<?php echo $value['maKh'] ?>" class="btn-action btn-success btn--edit ">
                                    <i class="fa-solid fa-pen-to-square green"></i>
                                </a>
                            </td>


                        </tr>
                        <!-- database/remove.php?remove=<?php echo $value['maHangHoa'] ?> -->
                <?php
                    }
                }
                ?>
            </tbody>
        </table>

        <div class="demo"></div>
        <h2>Hóa Đơn Chi Tiết</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã Hóa Đơn</th>
                    <th scope="col">Mã Chi Tiết</th>
                    <th scope="col">Mã Hàng Hóa</th>
                    <th scope="col">Số Lượng</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php

                if (isset($_GET['hoaDon'])) {
                    $hoaDonId = $_GET['hoaDon'];
                    $invoice = getDetailIvoice($hoaDonId);
                    foreach ($invoice as $key => $value) {
                ?>
                        <tr>
                            <td><?php echo $value['maHoaDon'] ?></td>
                            <td><?php echo $value['maChitiet'] ?></td>
                            <td><?php echo $value['maHangHoa'] ?></td>
                            <td><?php echo $value['soLuong'] ?></td>
                            <td><?php echo $value['soTien'] ?></td>
                            <td class="">
                                <a href="?page=editUser&&detail=<?php echo $value['maChitiet'] ?>" class="btn-action btn-success btn--edit ">
                                    <i class="fa-solid fa-pen-to-square green"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- database/remove.php?remove=<?php echo $value['maHangHoa'] ?> -->
                <?php
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
</div>

<script type="text/javascript">

</script>