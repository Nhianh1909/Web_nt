<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
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
    </style>
</head>

<body>

    <div class="wrapper_cart">
        <h1>Giỏ hàng của bạn</h1>
        <div id="cart-items">
            <!-- Các sản phẩm trong giỏ hàng sẽ được hiển thị ở đây -->
        </div>
        <p>Tổng tiền: <span id="total-price">0</span> vnđ</p>
        <button id="clear-cart">Xóa giỏ hàng</button>
        <button style="float: right; background-color:green;" id="place-order">Đặt Hàng</button>
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
                cartItems.innerHTML = '<p>Giỏ hàng của bạn đang trống.</p>';
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

        // Hàm thêm sản phẩm vào giỏ hàng
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

        // Hàm đặt hàng
        document.getElementById('place-order').addEventListener('click', function() {
            // Kiểm tra xem tên người dùng có tồn tại trong localStorage
            const username = localStorage.getItem('username'); // Giả sử tên người dùng được lưu vào localStorage

            if (!username) {
                alert('Bạn cần đăng nhập trước khi đặt hàng.');
                window.location.href = './login.php'; // Chuyển hướng đến trang đăng nhập
            } else {
                // Nếu đã đăng nhập, bạn có thể xử lý đặt hàng tại đây
                alert('Đặt hàng thành công!');
                // Thêm mã xử lý đơn hàng ở đây
            }
        });
    </script>

</body>

</html>