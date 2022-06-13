<style>
  .white {
    color: #fff !important;
    text-decoration: none;
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
  .mt{
    margin: 40px auto;
  }
</style>
<div class="container">
  <h2>Trang cá nhân của <?php echo $_SESSION['username'] ?> </h2>
  <div class="row mt">
    <div class="col-lg-4">
      <a href="?page=editUser&&userEdit=<?php echo $_SESSION['id'] ?>" class="btn-action btn-success btn--edit ">
        <i class="fa-solid fa-pen-to-square green"></i> <span class="color-white">Sửa thông tin cá nhân</span>
      </a>
    </div>
    <div class="col-lg-4">
      <button class="btn btn-success logout"><a href="?page=login&&logout=true" class="white">Đăng xuất</a> </button>

    </div>
  </div>
</div>