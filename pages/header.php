<?php
session_start();
?>

<header class="header">
    <img class="h_logo" src="./assets/images/LOGO.png" alt="" />
    <img class="h_slogan" src="./assets/images/Slogan.png" alt="" />
    <div class="lienhe">
        <strong>Liên Hệ Với Chúng Tôi:</strong> <br />
        <i class="fa-solid fa-phone"></i><span> : 1900-1009</span> <br />
        <i class="fa-solid fa-envelope"></i><span> : tranbao091@gmail.com</span>
    </div>
    <div class="h_social">
        <a href=""><i class="fa-brands fa-square-x-twitter"></i></a>
        <a href=""><i class="fa-brands fa-facebook text-primary"></i></a>
        <a href=""><i class="fa-brands fa-square-instagram"></i></a>
        <a href=""><i class="fa-brands fa-youtube text-danger"></i></a>
    </div>
    <div class="h_login">
        <span id="user-name"></span>
        <a href="./login.php?quanly=login" id="login-link" style="display: none;"><i class="fa-solid fa-user"></i> Tài Khoản</a>
        <button id="logout-button" style="display: none;">Đăng Xuất</button>
        <div class="cart-icon">
            <a href="index.php?quanly=giohang">
                <i class="fa-solid fa-cart-shopping"></i> Giỏ Hàng
            </a>
            <span id="cart-count">0</span>
        </div>
    </div>


    </div>
    <div class="header-fix">
        <a href=""><img src="./assets/images/Messenger.png" alt=""></a>
        <a href=""><img src="./assets/images/Zalo1.png" alt=""></a>
    </div>
</header>

<script>
    // Lấy phần tử hiển thị số lượng giỏ hàng
    const cartCount = document.getElementById('cart-count');

    // Bắt sự kiện khi sản phẩm được thêm vào giỏ hàng
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            let currentCount = parseInt(cartCount.textContent);
            currentCount += 1; // tăng số lượng sản phẩm
            cartCount.textContent = currentCount; // cập nhật lại số lượng hiển thị
        });
    });

    // Kiểm tra xem người dùng đã đăng nhập chưa
    document.addEventListener('DOMContentLoaded', function() {
        const userNameDisplay = document.getElementById('user-name');
        const loginLink = document.getElementById('login-link');
        const logoutButton = document.getElementById('logout-button');

        // Lấy thông tin người dùng từ localStorage
        const loggedInUser = localStorage.getItem('username');

        if (loggedInUser) {
            // Nếu đã đăng nhập, hiển thị tên người dùng
            userNameDisplay.textContent = `Xin chào, ${loggedInUser}`;
            loginLink.style.display = 'none'; // Ẩn liên kết đăng nhập
            logoutButton.style.display = 'inline-block'; // Hiển thị nút đăng xuất
        } else {
            // Nếu chưa đăng nhập, hiển thị liên kết đăng nhập
            loginLink.style.display = 'inline'; // Hiển thị liên kết đăng nhập
            logoutButton.style.display = 'none'; // Ẩn nút đăng xuất
        }

        // Xử lý sự kiện đăng xuất
        logoutButton.addEventListener('click', function() {
            // Xóa thông tin người dùng trong localStorage
            localStorage.removeItem('username');
            // Tải lại trang để cập nhật giao diện
            location.reload();
        });
    });
</script>