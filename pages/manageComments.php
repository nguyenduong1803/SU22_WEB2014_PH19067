<?php
if (!isset($_SESSION['username']) || !$_SESSION['role'] === "admin") {
    die("không thể truy cập");
}
require "database/get.php";

$list = getProduct();
$comments = [];
if (isset($_GET['id'])) {
    $comments = getComment(($_GET['id']));
}


?>
<style>
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

    .btn--remove {
        background-color: #654ea3;
    }

    .btn--remove:hover {
        background-color: #4e3398;
    }
    .table{
    }

    td {
        border: 1px solid #fff;
    }

    th {
        border: 1px solid #fff;
        text-align: center;
        width: 16%;
    }
    
    /* th:nth-child(1) {

        width: 30px;
    }

    th:nth-child(5) {
        width: 20%;
    }

    th:nth-child(4) {
        width: 30px;
    } */

    .table>:not(:first-child) {
        border-top: none !important;
    }

    .th_action {
        width: 40px;
        ;
    }

    .td_child {
        position: relative;
    }

    .check {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 1.5rem;
        height: 1.5rem;
    }

    .clearAll {
        display: none;
    }

    .form__conatiner {
        padding: 60px 0;
        background: #eaafc8;
        background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
        background: linear-gradient(to right, #eaafc8, #654ea3);
    }
</style>


<div class="form__conatiner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?page=admin">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quảng lý bình luận</li>
            </ol>
        </nav>
        <h2>Danh sách hàng hóa</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Comment quantity</th>
                    <th scope="col">Price</th>
                    <th>View Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)) {
                    foreach ($list as $key => $value) {
                ?>
                        <tr>
                            <td><img class="mini-img" src="<?php echo $value['hinhAnh'] ?>" alt=""></td>
                            <td><?php echo $value['tenHangHoa'] ?></td>
                            <td><?php echo $value['moTa'] ?></td>
                            <td><?php echo $value['donGia'] ?></td>
                            <td><a href="?page=manageComments&&id=<?php echo $value['maHangHoa'] ?>" class="btn btn-success"><i class="fa-solid fa-eye"></i> Xem bình luận</a></td>
                        </tr>
                        <!-- database/remove.php?remove=<?php echo $value['maHangHoa'] ?> -->
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <h2>Bình luận hàng hóa</h2>
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
        <button class="btn btn-success chooseAll"> Chọn tất cả</button>
        <button class="btn btn-success clearAll">Bỏ chọn tất cả</button>
        <button class="btn btn-danger  deleteAll"> Xóa mục đã chọn</button>


    </div>
</div>
<script type="text/javascript">
    const checkbox = document.querySelectorAll(".check");
    const choose = document.querySelector(".chooseAll");
    const clear = document.querySelector(".clearAll");
    choose.addEventListener('click', function() {
        clear.style.display = "inline-block"
        choose.style.display = "none"
        checkbox.forEach((ele) => {
            ele.checked = true
        })
    })
    clear.addEventListener('click', function() {
        clear.style.display = "none"
        choose.style.display = "inline-block"
        checkbox.forEach((ele) => {
            if (ele.checked === true) {
                ele.checked = false;
            }
            ele.checked = false
        })
    })
    document.querySelector(".deleteAll").addEventListener('click', function() {})
</script>