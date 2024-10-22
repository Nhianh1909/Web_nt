<?php
// Truy vấn dữ liệu
$sql = "SELECT rc.room_name, pc.category_name, pc.category_id
FROM product_category pc 
JOIN room_category rc ON pc.room_id = rc.room_id";

$result = mysqli_query($mysqli, $sql);

// Khai báo mảng lưu trữ dữ liệu để xử lý theo cấu trúc Room > Category
$data = [];

// Đưa dữ liệu vào mảng theo cấu trúc yêu cầu
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $room_name = $row['room_name'];
        $category_name = $row['category_name'];
        $category_id = $row['category_id']; // Lấy thêm category_id

        // Nếu chưa có room_name trong mảng, khởi tạo room_name
        if (!isset($data[$room_name])) {
            $data[$room_name] = [];
        }

        // Thêm danh mục và category_id vào room
        $data[$room_name][] = [
            'name' => $category_name,
            'id' => $category_id
        ];
    }
}
?>

<!-- Hiển thị menu -->
<nav class="menu_bar">
    <div class="container">
        <ul class="menu_bar_content">
            <li>
                <a href="index.php?quanly=danhmucsanpham"><i class="fa-solid fa-house"></i> Home</a>
            </li>

            <!-- Duyệt qua từng room và hiển thị danh mục sản phẩm -->
            <?php foreach ($data as $room_name => $categories): ?>
                <li>
                    <a href="">
                        <i class="fa-solid fa-couch"></i>
                        <?php echo $room_name; ?>
                        <i class="fa-solid fa-caret-down"></i>
                    </a>
                    <ul class="sub_menu">
                        <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="index.php?quanly=tensanpham&id=<?php echo $category['id']; ?>">
                                    <?php echo $category['name']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="search_box">
        <form action="" id="search_box">
            <input type="text" id="search_text" placeholder="Tìm Kiếm Sản Phẩm..." />
            <button class="search_btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
</nav>

<script>
    // Cập nhật số lượng giỏ hàng
    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalQuantity = cart.reduce((sum, product) => sum + product.quantity, 0);
        document.getElementById('cart-count').textContent = totalQuantity;
    }

    // // Thêm sự kiện click cho nút "Thêm vào giỏ hàng"
    // document.querySelectorAll('.add-to-cart').forEach(button => {
    //     button.addEventListener('click', function() {
    //         const productId = this.getAttribute('data-id');
    //         const productName = this.getAttribute('data-name');
    //         const productPrice = parseFloat(this.getAttribute('data-price')); // Đảm bảo là số

    //         // Lấy giỏ hàng từ localStorage
    //         let cart = JSON.parse(localStorage.getItem('cart')) || [];

    //         // Lấy số lượng từ input
    //         const quantity = parseInt(document.getElementById('quantity').value);

    //         // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    //         const existingProduct = cart.find(item => item.id === productId);

    //         if (existingProduct) {
    //             existingProduct.quantity += quantity; // Cộng số lượng từ input
    //         } else {
    //             cart.push({
    //                 id: productId,
    //                 name: productName,
    //                 price: productPrice,
    //                 quantity: quantity // Sử dụng số lượng từ input
    //             });
    //         }

    //         // Lưu lại giỏ hàng vào localStorage
    //         localStorage.setItem('cart', JSON.stringify(cart));

    //         // Cập nhật số lượng giỏ hàng
    //         updateCartCount();

    //         alert('Sản phẩm đã được thêm vào giỏ hàng!');
    //     });
    // });

    // Cập nhật số lượng giỏ hàng khi tải trang
    updateCartCount();
</script>