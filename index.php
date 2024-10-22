<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/boost trap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/boost trap/css/style.css" />

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <title>Document</title>
  <link rel="stylesheet" href="./assets/boost trap/css/owl.carousel.min.css">
  <link rel="stylesheet" href="./assets/boost trap/css/owl.theme.default.min.css">
</head>

<body>
  <!-- =========Header============== -->
  <?php
  include("./config.php");
  include("./pages/header.php");
  include("./pages/menu.php");
  include("./pages/main.php");
  include("./pages/footer.php");
  ?>
  <!-- ===========Menu========= -->

  <!-- =========main========== -->

  <!-- =================footer=========== -->



  <!-- ================Nhung JS ============= -->
  <script src="./assets/boost trap/js/jquery.min.js"></script>
  <script src="./assets/boost trap/js/owl.carousel.min.js"></script>
  <script src="./assets/boost trap/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/boost trap/js/main.js"></script>
  <script>
    $(document).ready(function() {
      $('.owl-carousel').owlCarousel({
        loop: true, // Lặp lại carousel
        margin: 10, // Khoảng cách giữa các mục
        nav: true, // Hiển thị nút điều hướng
        items: 4, // Hiển thị 4 mục mỗi slide
        autoHeight: true, // Tự động điều chỉnh chiều cao
        responsive: {
          0: {
            items: 1 // Hiển thị 1 mục trên màn hình nhỏ (mobile)
          },
          600: {
            items: 2 // Hiển thị 2 mục trên màn hình trung bình
          },
          1000: {
            items: 4 // Hiển thị 4 mục trên màn hình lớn (desktop)
          }
        }
      });
    });
  </script>

</body>

</html>