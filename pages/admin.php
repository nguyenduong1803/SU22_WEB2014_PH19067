<?php


?>
<style>
    .form__conatiner {
        min-height: 400px;
        padding: 60px 0;
        background: #eaafc8;
        background: -webkit-linear-gradient(to right, #eaafc8, #654ea3);
        background: linear-gradient(to right, #eaafc8, #654ea3);
    }

    .logout {
        height: 40px;
        margin-top: 20px;
    }

    .space {
        justify-content: space-between;
    }
</style>
<div class="form__conatiner">
    <div class="container">
        <sestion class="d-flex space">
            <div class="nav-item btn-add"><a href="?page=manageProduct" class="nav-link links add font-weight-bold text-uppercase">Quản lý sản phẩm</a></div>
            <button class="btn btn-success logout"><a href="?page=login&&logout=true" class="white">Đăng xuất</a> </button>
        </sestion>
    </div>

</div>