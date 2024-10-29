<div>



    <?php
    include('./config.php');

    if (isset($_GET['quanly'])) {
        $tam = $_GET['quanly'];
    } else {
        $tam = '';
    }
    if ($tam == 'danhmucsanpham') {
        include("mains/danhmuc.php");
    } else if ($tam == 'tensanpham') {
        include("mains/product.php");
    } else if ($tam == 'chitietsanpham') {
        include("mains/chitietsanpham.php");
    } else if ($tam == 'giohang') {
        include("mains/giohang.php");
    } else if ($tam == 'donhang') {
        include("mains/donhang.php");
    } else {
        include("mains/danhmuc.php");
    }
    ?>
</div>