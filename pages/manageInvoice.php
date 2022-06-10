<?php
if (!isset($_SESSION['username']) || !$_SESSION['username'] === "admin") {
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


    th:nth-child(1),th:nth-child(2) {
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
                            <td><a href="?page=manageComments&&id=<?php echo $value['maHoaDon'] ?>" class="btn btn-success"><i class="fa-solid fa-eye"></i> Chi tiết</a></td>
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Check</th>
                    <th scope="col">Mã bình luận</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Mã khách hàng</th>
                    <th scope="col">Mã hàng hóa</th>
                    <th scope="col" class="color-white th_action">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)) {
                    foreach ($comments as $key => $value) {
                ?>
                        <tr>
                            <td class="td_child"><input class="form-check-input check" type="checkbox" value="" id="flexCheckDefault"></td>
                            <td><?php echo $value['maBinhLuan'] ?></td>

                            <td><?php echo $value['noiDung'] ?></td>
                            <td><?php echo $value['maKh'] ?></td>
                            <td><?php echo $value['maHangHoa'] ?></td>
                            <td class=""> <a class="btn-action btn--remove " href="?page=remove&&removeCmt=<?php echo $value['maBinhLuan'] ?>&&productId=<?php echo $value['maHangHoa'] ?>">
                                    <i class="fa-solid fa-circle-xmark red "></i><span class="color-white">remove</span></a></td>
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