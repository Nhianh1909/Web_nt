<main class="main">
    <style>
        /* Một số CSS cơ bản cho giao diện chi tiết sản phẩm */
        .product-detail {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .product-detail h1 {
            margin: 0 0 20px;
        }

        .product-detail p {
            margin: 5px 0;
        }

        .quantity {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }



        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
    <!-- ======baner======== -->
    <div class="carousel slide main_banner" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel" data-bs-interval="2000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="b-imgs" src="./assets/images/banner2.jpg" alt="" />
            </div>
            <div class="carousel-item">
                <img class="b-imgs" src="./assets/images/banner1.jpg" alt="" />
            </div>
            <div class="carousel-item">
                <img class="b-imgs" src="./assets/images/banner3.jpeg" alt="" />
            </div>
            <div class="carousel-item">
                <img class="b-imgs" src="./assets/images/banner4.jpg" alt="" />
            </div>
            <div class="carousel-item">
                <img class="b-imgs" src="./assets/images/banner5.jpg" alt="" />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselDemo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselDemo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        <div class="carousel-indicators">
            <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="0"></button>
            <button type="button" data-bs-target="#carouselDemo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselDemo" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#carouselDemo" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#carouselDemo" data-bs-slide-to="4"></button>
        </div>
    </div>

    <!-- =====Cam Ket======= -->
    <div class="cam-ket d-flex">
        <div class="grid d-flex ">
            <div class="p-1 g-col-3 bg-info">
                <img src="./assets/images/camket1.png" alt="">
                <p><strong>Chính hãng</strong> <br> Bảo hành dài hạn</p>
            </div>
            <div class="p-1 g-col-3 bg-danger">
                <img src="./assets/images/camket2.png" alt="">
                <p><strong>63 tỉnh thành</strong> <br> Giao hàng tận nơi</p>
            </div>
            <div class="p-1 g-col-3 bg-success ">
                <img src="./assets/images/camket3.png" alt="">
                <p><strong>Tư vấn tận tình</strong> <br> Hỗ trợ 24/7</p>
            </div>
            <div class="p-1 g-col-3 " style="background-color: orange;">
                <img src="./assets/images/camket4.png" alt="">
                <p><strong>Chính sách hậu mãi</strong> <br> Bảo trì trọn đời</p>
            </div>
        </div>
    </div>

    <p>Chi tiết sản phẩm</p>
    <?php
    $sql_chitiet = "SELECT * FROM product_category, product WHERE product.category_id = product_category.category_id AND product.product_id='$_GET[id]' LIMIT 1";
    $query_chitiet = mysqli_query($mysqli, $sql_chitiet);
    while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
    ?>
        <div class="wrapper_chitiet">
            <div class="hinhanh_sanpham">
                <img width="100%" src="<?php echo $row_chitiet['product_image']; ?>" alt="Hình ảnh sản phẩm">
            </div>
            <div class="product-detail">
                <h3 id="product-name">Tên sản phẩm: <?php echo $row_chitiet['product_name']; ?></h3>
                <p>Mã sản phẩm: <?php echo $row_chitiet['product_id']; ?></p>
                <p id="product-price">Giá sản phẩm: <?php echo number_format($row_chitiet['product_price'], 0, ',', '.') . ' vnđ'; ?></p>
                <p class="quantity">Số lượng sản phẩm còn: <?php echo $row_chitiet['product_quantity']; ?>
                </p>
                <p>Số lượng sản phẩm muốn chọn: <input style="width: 50px; text-align: center;" type="number" id="quantity" value="1" min="1"></p>
                <p>Danh mục sản phẩm: <?php echo $row_chitiet['category_name']; ?></p>
                <p><button class="add-to-cart" data-id="<?php echo $row_chitiet['product_id']; ?>" data-name="<?php echo $row_chitiet['product_name']; ?>" data-price="<?php echo $row_chitiet['product_price']; ?>">Thêm vào giỏ hàng</button></p>
            </div>
        </div>
    <?php
    }
    ?>
</main>

<script>
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            const productPrice = parseFloat(this.getAttribute('data-price')); // Đảm bảo là số

            // Lấy giỏ hàng từ localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Lấy số lượng từ input
            const quantity = parseInt(document.getElementById('quantity').value);

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            const existingProduct = cart.find(item => item.id === productId);

            if (existingProduct) {
                existingProduct.quantity += quantity; // Cộng số lượng từ input
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: quantity // Sử dụng số lượng từ input
                });
            }

            // Lưu lại giỏ hàng vào localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Cập nhật số lượng giỏ hàng
            updateCartCount();

            alert('Sản phẩm đã được thêm vào giỏ hàng!');
        });
    });

    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalQuantity = cart.reduce((sum, product) => sum + product.quantity, 0);
        document.getElementById('cart-count').textContent = totalQuantity;
    }

    // Cập nhật số lượng giỏ hàng khi tải trang
    updateCartCount();
</script>