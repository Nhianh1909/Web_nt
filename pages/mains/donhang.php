<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng</title>
    <style>
        /* Một số CSS cơ bản cho giao diện giỏ hàng */
        .wrapper_cart {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item p {
            margin: 0;
        }

        .cart-item button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        #total-price {
            font-weight: bold;
            font-size: 1.5em;
        }

        button#clear-cart,
        button#place-order {
            background-color: #ff9800;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            margin-top: 20px;
        }

        /* CSS cho form đặt hàng */
        #order-form {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            width: 300px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #order-form h3 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
        }

        #order-form label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-top: 10px;
        }

        #order-form input[type="text"],
        #order-form input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        #order-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        #order-form button[type="submit"]:hover {
            background-color: #218838;
        }

        #order-form input[type="text"]:focus,
        #order-form input[type="tel"]:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(128, 189, 255, 0.5);
        }
    </style>
</head>

<body>

    <div class="wrapper_cart">
        <h1>Đơn hàng của bạn</h1>
        <div id="cart-items">
            <!-- Các sản phẩm trong giỏ hàng sẽ được hiển thị ở đây -->
        </div>
        <p>Tổng tiền: <span id="total-price">0</span> vnđ</p>
        <button id="clear-cart">Xóa đơn hàng</button>
        <button style="float: right; background-color:green;" id="place-order">Thanh toán</button>
    </div>

    <!-- Form đặt hàng -->
    <div id="order-form" style="display: none; margin-top: 20px;">
        <h3>Thông tin đặt hàng</h3>
        <form id="checkout-form">
            <label for="username">Tên người dùng:</label>
            <input type="text" id="username" name="username" readonly><br><br>

            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required><br><br>

            <label for="phone">Số điện thoại:</label>
            <input type="tel" id="phone" name="phone" required><br><br>

            <button type="submit">Xác nhận đặt hàng</button>
        </form>
    </div>

    <script>
        // Khởi tạo giỏ hàng từ localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        //chuyển đổi một chuỗi (string) định dạng JSON thành một đối tượng (object) hoặc mảng (array) JavaScript.

        // Hàm hiển thị giỏ hàng
        function displayCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = ''; // Clear nội dung cũ để sau khi cập nhật không bị trùng lập

            let totalPrice = 0;

            if (cart.length === 0) {
                cartItems.innerHTML = '<p>Đơn hàng của bạn đang trống.</p>';
            } else {
                cart.forEach((item, index) => {
                    const itemElement = document.createElement('div');
                    itemElement.classList.add('cart-item');
                    itemElement.innerHTML = `
                    <div>
                        <p>Sản phẩm: ${item.name}</p>
                        <p>Giá: ${item.price.toLocaleString()} vnđ</p>
                        <p>Số lượng: 
                            <button onclick="decreaseQuantity(${index})">-</button> 
                            ${item.quantity} 
                            <button onclick="increaseQuantity(${index})">+</button>
                        </p>
                    </div>
                    <div>
                        <button onclick="removeItem(${index})">Xóa</button>
                    </div>
                `;
                    cartItems.appendChild(itemElement);

                    totalPrice += item.price * item.quantity;
                });
            }

            document.getElementById('total-price').textContent = totalPrice.toLocaleString(); // Cập nhật tổng tiền
        }

        // Hàm thêm sản phẩm 
        function addToCart(productId, productName, productPrice) {
            const existingProduct = cart.find(item => item.id === productId);

            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: 1
                });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            displayCart();
        }

        // Hàm tăng số lượng
        function increaseQuantity(index) {
            cart[index].quantity += 1;
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
        }

        // Hàm giảm số lượng
        function decreaseQuantity(index) {
            cart[index].quantity -= 1;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1); // Xóa sản phẩm nếu số lượng bằng 0
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
        }

        // Hàm xóa sản phẩm khỏi giỏ hàng
        function removeItem(index) {
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
        }

        // Hàm xóa toàn bộ giỏ hàng
        document.getElementById('clear-cart').addEventListener('click', function() {
            cart = [];
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
        });

        // Hàm cập nhật số lượng sản phẩm trên biểu tượng giỏ hàng
        function updateCartCount() {
            const cartCount = document.getElementById('cart-count');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems;
        }

        // Hiển thị giỏ hàng khi tải trang
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            displayCart();
        });

        document.getElementById('place-order').addEventListener('click', function() {
            // Kiểm tra xem tên người dùng có tồn tại trong localStorage
            const username = localStorage.getItem('username'); // Giả sử tên người dùng được lưu vào localStorage

            if (!username) {
                alert('Bạn cần đăng nhập trước khi đặt hàng.');
                window.location.href = './login.php'; // Chuyển hướng đến trang đăng nhập
            } else {
                // Nếu đã đăng nhập, hiển thị form đặt hàng và điền tên người dùng vào form
                document.getElementById('order-form').style.display = 'block';
                document.getElementById('username').value = username;
            }
        });

        // Hàm xử lý khi gửi form đặt hàng
        document.getElementById('checkout-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn hành động gửi form mặc định

            // Xử lý đặt hàng tại đây, ví dụ gửi thông tin đơn hàng lên server
            const address = document.getElementById('address').value;
            const phone = document.getElementById('phone').value;

            // Xử lý logic để lưu đơn hàng hoặc gửi đơn hàng
            alert(`Đặt hàng thành công! Tên người dùng: ${username}, Địa chỉ: ${address}, Số điện thoại: ${phone}`);

            // Sau khi đặt hàng thành công, có thể xóa giỏ hàng
            cart = [];
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
            document.getElementById('order-form').style.display = 'none'; // Ẩn form đặt hàng
        });
    </script>

</body>

</html>