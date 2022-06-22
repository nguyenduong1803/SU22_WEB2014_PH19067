

<?php
if (!isset($_SESSION['username']) || !$_SESSION['role'] === "admin") {
    die("không thể truy cập");
}
require "database/get.php";

$list = getProduct();


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
        border: 1px solid #fff;
    }

    th {
        border: 1px solid #fff;
        text-align: center;
    }
    th:nth-child(4){
        width: 30%;
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
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">quantity</th>
                <th scope="col">address</th>
                <th scope="col">Price</th>

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
                        <td>quantity</td>
                        <td>Địa chỉ</td>
                        <td><?php echo $value['donGia'] ?></td>
                    </tr>
                    <!-- database/remove.php?remove=<?php echo $value['maHangHoa'] ?> -->
            <?php
                }
            }
            ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
    </div>
    <button class="btn btn-success">Tiến hành thanh toán</button>

</div>
<script type="text/javascript">
  
</script>