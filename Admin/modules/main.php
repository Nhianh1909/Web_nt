<?php
ob_start(); // Bắt đầu bộ đệm toàn bộ tệp

if (isset($_GET['action'])) {
    $tam = $_GET['action'];
} else {
    $tam = '';
}

if ($tam == 'quanlysanpham') {
    include("quanlysp/themsp.php");
    include("quanlysp/lietke.php");
} else if ($tam == 'quanlykhachhang') {
    include("quanlykhachhang/lietkekhachhang.php");
} else if ($tam == 'quanlydanhmuc') {
    include("quanlydanhmuc/themdanhmuc.php");
    include("quanlydanhmuc/lietkedanhmuc.php");
} else if ($tam == 'quanlydonhang') {
    include("quanlydonhang/lietkedonhang.php");
} else {
    include("modules/dashboard.php");
}

ob_end_flush(); // Kết thúc bộ đệm toàn bộ tệp
