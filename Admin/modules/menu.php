<!-- Vertical navbar -->
<div class="vertical-nav bg-white col-2" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light text-center">
        <img src="https://res.cloudinary.com/mhmd/image/upload/v1556074849/avatar-1_tcnd60.png" alt="..."
            width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <?php
        if (isset($_SESSION['username'])) {
            echo $_SESSION['username'];
        } else {
        ?>


            <p class="font-weight-light text-muted mb-0">Tài khoản</p>
        <?php
        }
        ?>

    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-3 mb-0 ml-1">Quản Lý</p>

    <ul class="nav flex-column bg-white mb-0 ml-1">
        <li class="nav-item" id="s_product">
            <a href="index.php?action=quanlysanpham" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-th-large mr-1 text-primary fa-fw"></i>
                Sản Phẩm
            </a>
        </li>
        <li class="nav-item" id="s_product">
            <a href="index.php?action=quanlydanhmuc" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-th-large mr-1 text-primary fa-fw"></i>
                Danh mục
            </a>
        </li>
        <li class="nav-item" id="s_user">
            <a href="index.php?action=quanlykhachhang" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-address-card mr-1 text-primary fa-fw"></i>
                Khách Hàng
            </a>
        </li>
        <li class="nav-item" id="s_order">
            <a href="index.php?action=quanlydonhang" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-cubes mr-1 text-primary fa-fw"></i>
                Đơn Hàng
            </a>
        </li>
    </ul>
</div>