<?php
if (!isset($_SESSION['username']) || !$_SESSION['username'] === "admin") {
    die("không thể truy cập");
}
require "database/get.php";
require "database/add.php";
$list = getUserById("*");
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

    .btn--remove {
        background-color: #654ea3;
    }

    .btn--remove:hover {
        background-color: #4e3398;
    }

    td {
        border: 1px solid #fff;
    }

    th {
        border: 1px solid #fff;
        text-align: center;
    }


    th:nth-child(1) {

        width: 30px;
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
    .avatar {
        vertical-align: middle;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
</style>
<div class="form__conatiner">
        <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Check</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Chức năng</th>
                    <th scope="col">email</th>
                    <th scope="col" colspan="2" class="color-white th_action">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list)) {
                    foreach ($list as $key => $value) {
                ?>
                        <tr>
                            <td class="td_child"><input class="form-check-input check" type="checkbox" value="<?php echo $value['maKh'] ?>" id="flexCheckDefault"></td>
                            <td><img class="avatar" src="<?php echo $value['hinhAnh'] ?>" alt=""></td>
                            <td><?php echo $value['tenKh'] ?></td>
                            <td><?php echo $value['chucNang'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td class="">
                                <a href="?page=editUser&&userEdit=<?php echo $value['maKh'] ?>" class="btn-action btn-success btn--edit ">
                                    <i class="fa-solid fa-pen-to-square green"></i> <span class="color-white">Edit</span>
                                </a>
                            </td>
                            <td class="">
                                <a class="btn-action btn--remove " style="<?php echo $value['chucNang']==0 ?"display:flex":"display:none" ?>" href="?page=remove&&userRemove=<?php echo $value['maKh'] ?>">
                                    <i class="fa-solid fa-circle-xmark red "></i><span class="color-white">remove </span>
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
        <button class="btn btn-success chooseAll"> Chọn tất cả</button>
        <button class="btn btn-success clearAll">Bỏ chọn tất cả</button>
        <button class="btn btn-danger  deleteAll"> Xóa mục đã chọn</button>
        <div class="demo"></div>
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
    alerts()

    function alerts() {
        const deleteAll = document.querySelector('.deleteAll');
        const allChoose = document.querySelectorAll('.check');


        deleteAll.onclick = e => {
            const isSucssec = confirm('Bạn có muốn xóa những Sản Phẩm đã chọn');
            // console.log(allChoose)
            if (isSucssec) {
                let payload = [];
                allChoose.forEach((item) => {
                    if (item.checked === true) {
                        payload.push(item.defaultValue)
                    }
                    console.log(payload)
                })
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                    }

                };
                xmlhttp.open("GET", "?page=remove&removeUser=" + payload.valueOf(), true);
                xmlhttp.send();
                allChoose.forEach((item) => {
                    if (item.checked === true) {
                        item.parentElement.parentElement.remove();
                    }

                })
            } else {
                e.preventDefault();
            }

        }

    }
</script>