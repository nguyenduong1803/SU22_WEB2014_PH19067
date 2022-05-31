<?php
require "database/get.php";

if (isset($_GET['addCart'])) {
    $productId = $_GET['addCart'];
    if (isset($_COOKIE['list'])) {
        $saveCookie = json_decode($_COOKIE['list']);
        $product =  getProductById($productId);
        foreach ($saveCookie as $key => $value) {
            if ($value->maHangHoa !== $productId) {
                array_push($saveCookie, $product['0']);
                setcookie("list", json_encode($saveCookie));
            } else {
                echo "đã có trong giỏ hàng";
            }
        }
    }else{
        $listProduct=[];
        $product =  getProductById($productId);

        array_push($listProduct, $product['0']);
        setcookie("list", json_encode($listProduct));
    }
   
    // var_dump($saveCookie[0]);


}
// var_dump(json_decode($_COOKIE['list']));



?>
<style>
    .form {
        max-width: 800px;
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
        border: 1px solid #ccc;
    }

    th {
        border: 1px solid #ccc;
        text-align: center;
    }

    th:nth-child(1) {

        width: 30px;
    }


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
</style>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="?page=home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
        </ol>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Check</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">quantity</th>
                <th scope="col">Price</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($saveCookie)) {
                foreach ($saveCookie as $key => $value) {
            ?>
                    <tr>
                        <td class="td_child"><input class="form-check-input check" type="checkbox" value="" id="flexCheckDefault"></td>
                        <td><img class="mini-img" src="<?php echo $value->hinhAnh ?>" alt=""></td>
                        <td><?php echo $value->tenHangHoa ?></td>

                        <td><input type="number" value="1" name="quantity"></td>
                        <td><?php echo $value->donGia ?></td>
                        <td class=""> <a class="btn-action btn--remove " href="?page=remove&&remove=<?php echo $value->maHangHoa ?>"><i class="fa-solid fa-circle-xmark red "></i><span class="color-white">remove</span></a></td>
                    </tr>
                    <!-- database/remove.php?remove=<?php echo $value->maHangHoa ?> -->
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <button class="btn btn-success chooseAll"> Chọn tất cả</button>
        <button class="btn btn-success clearAll">Bỏ chọn tất cả</button>
        <div class="btn btn-success ">Tổng tiền : 20000000</div>
    </div>
    <button class="btn btn-success">Tiến hành thanh toán</button>

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
    document.querySelector(".deleteAll").addEventListener('click', function() {

    })
</script>