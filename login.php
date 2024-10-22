<?php
include("./config.php");

if (isset($_POST['signup'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']); // Mã hóa mật khẩu bằng MD5

  // Kiểm tra tài khoản đã tồn tại chưa
  $check_user = "SELECT * FROM customer WHERE customer_fullname='$username' OR customer_email='$email'";
  $result = mysqli_query($mysqli, $check_user);

  // Kiểm tra xem truy vấn có thành công hay không
  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      echo "Tên người dùng hoặc email đã tồn tại!";
    } else {
      // Thêm người dùng mới vào database
      $insert_user = "INSERT INTO customer (customer_fullname, customer_email, customer_password) VALUES ('$username', '$email', '$password')";
      if (mysqli_query($mysqli, $insert_user) === TRUE) {
        echo '<p style="color:green;">"Đăng ký thành công!"</p>';
      } else {
        echo "Lỗi: " . mysqli_error($mysqli); // Sử dụng mysqli_error để lấy thông báo lỗi
      }
    }
  } else {
    echo "Lỗi truy vấn: " . mysqli_error($mysqli); // Thông báo lỗi truy vấn
  }
}
?>

<?php
if (isset($_POST['signin'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']); // Mã hóa mật khẩu để so sánh

  // Kiểm tra tài khoản
  $check_login = "SELECT * FROM customer WHERE customer_fullname='$username' AND customer_password='$password'";
  $result = mysqli_query($mysqli, $check_login);

  // Kiểm tra xem truy vấn có thành công không
  if ($result) {
    if (mysqli_num_rows($result) == 1) {
      // Tạo session để lưu trạng thái đăng nhập
      session_start();
      $_SESSION['username'] = $username;

      // Thêm thông tin vào localStorage
      echo "
      <script>
        localStorage.setItem('isLoggedIn', 'true');
        localStorage.setItem('username', '$username');
        window.location.href = 'index.php'; // Chuyển hướng đến trang chủ
      </script>
      ";
      exit(); // Dừng script sau khi chuyển hướng
    } else {
      echo "Tên người dùng hoặc mật khẩu không chính xác!";
    }
  } else {
    echo "Lỗi truy vấn: " . mysqli_error($mysqli); // Thông báo lỗi truy vấn
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/boost trap/css/login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <title>Welcome!</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <!-- Form đăng nhập -->
        <form action="" method="POST" class="sign-in-form">
          <h2 class="title">Sign In</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required />
          </div>
          <input type="submit" name="signin" value="Login" class="btn solid" />
        </form>
        <!-- Form đăng ký -->
        <form action="" method="POST" class="sign-up-form">
          <h2 class="title">Sign Up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required />
          </div>
          <input type="submit" name="signup" value="Sign Up" class="btn solid" />
        </form>
      </div>
    </div>
    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, error.</p>
          <button class="btn transparent" id="sign-up-btn">Sign Up</button>
        </div>
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of Us?</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, error.</p>
          <button class="btn transparent" id="sign-in-btn">Sign In</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });
    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });
  </script>
</body>

</html>