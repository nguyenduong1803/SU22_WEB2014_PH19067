<?php
require "database/get.php";
// $arr = [1, 2, 3, 34, 3, 3];
// var_dump(array_unique($arr));
if (isset($_GET['addCart'])) {
    $productId = $_GET['addCart'];
    // echo $productId;
    $saveCookie = (int)$productId;
    if ($saveCookie != "" && isset($_COOKIE['list']) && $_COOKIE['list'] != "null") {
        $getCookie = json_decode($_COOKIE['list']);
        if (in_array($saveCookie, $getCookie)) {
            header("Location:?page=products&sussec=false");
        } else {
            array_push($getCookie, $saveCookie);
            $newArr = array_unique($getCookie);
            setcookie("list", json_encode($newArr));
            header("Location:?page=products&sussec=true");
        }
    } else {
        setcookie("list", json_encode(array($saveCookie)));
        header("Location:?page=products&sussec=true");
    }
}

if (isset($_COOKIE['list'])) {
    $products = [];
    $getCookie = json_decode($_COOKIE['list']);
    $products = getProductById($getCookie);
}
if (isset($_POST['checkout'])) {
    $arrId = [];
    $arrQuantity = [];
    foreach ($products as $key => $value) {
        if (isset($_POST["checkProduct{$key}"])) {
            echo $_POST["checkProduct{$key}"];
            array_push($arrId, (int)$_POST["checkProduct{$key}"]);
            array_push($arrQuantity, (int)$_POST["quantity{$key}"]);
        }
    }
    if (count($arrId) > 0) {
        $listId = implode(",", $arrId);
        $quantity = implode(",", $arrQuantity);
        header("Location:?page=checkout&listId={$listId}&q={$quantity}");
    } else {
    }
    var_dump($arrId);

    echo "click";
}


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
    <form action="" method="POST">
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
                if (!empty($products) && count($products) > 0) {
                    foreach ($products as $key => $value) {
                ?>
                        <tr>
                            <td class="td_child"><input onClick="handle(this)" class="form-check-input check" name="checkProduct<?php echo $key ?>" type="checkbox" value="<?php echo $value['maHangHoa'] ?>" id="flexCheckDefault"></td>
                            <td><img class="mini-img" src="<?php echo $value['hinhAnh'] ?>" alt=""></td>
                            <td><?php echo $value['tenHangHoa'] ?></td>

                            <td><input type="number" value="1" name="quantity<?php echo $key ?>"></td>
                            <td class="td_price"><?php echo $value['donGia'] ?></td>
                            <td class=""> <a class="btn-action btn--remove " href="?page=remove&&removeCookie=<?php echo $value['maHangHoa'] ?>"><i class="fa-solid fa-circle-xmark red "></i><span class="color-white">remove</span></a></td>
                        </tr>

                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div class="btn btn-success chooseAll"> Chọn tất cả</div>
            <div class="btn btn-success clearAll">Bỏ chọn tất cả</div>
            <div class="btn btn-success totalMoney ">Tổng tiền : </div>
        </div>
        <button type="submit" name="checkout" class="btn btn-success">Tiến hành thanh toán</button>
    </form>

</div>
<script type="text/javascript">
    const checkbox = document.querySelectorAll(".check");
    const choose = document.querySelector(".chooseAll");
    const clear = document.querySelector(".clearAll");
    const totalMoney = document.querySelector(".totalMoney");
    let count = [];
    const handle = function(e) {
        if (e.checked === true) {
            count.push(e.parentElement.parentElement.children[4].innerText)
        }
        totalMoney.innerHTML = `Tổng tiền : ${count.reduce((init,value)=>Number(init)+Number(value),0)}`
        console.log(e.parentElement.parentElement.children[4].innerText)
    }
    checkbox.forEach((ele) => {
        console.log([ele])
        ele.onClick = function(eles) {
            if (eles.checked === true) {
                count = eles.parentElement.parentElement.children[4].innerText;
                console.log(count);
            }
        }
        totalMoney.innerHTML = `Tổng tiền : ${count}`
    })
    if (choose) {
        choose.addEventListener('click', function() {
            let count = [];

            clear.style.display = "inline-block"
            choose.style.display = "none"
            checkbox.forEach((ele) => {
                count.push(ele.parentElement.parentElement.children[4].innerText)
                ele.checked = true
            })
            totalMoney.innerHTML = `Tổng tiền : ${count.reduce((init,value)=>Number(init)+Number(value),0)}`
        })
    }
    if (clear) {
        clear.addEventListener('click', function() {
            clear.style.display = "none"
            choose.style.display = "inline-block"
            checkbox.forEach((ele) => {
                if (ele.checked === true) {
                    ele.checked = false;
                }
                ele.checked = false
                totalMoney.innerHTML = `Tổng tiền : 0`
            })
        })
    }
</script>