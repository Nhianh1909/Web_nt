<main class="main">
    <!-- ======baner======== -->
    <div
        class="carousel slide main_banner"
        id="carouselDemo"
        data-bs-wrap="true"
        data-bs-ride="carousel"
        data-bs-interval="2000">
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
        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselDemo"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselDemo"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        <div class="carousel-indicators">
            <button
                type="button"
                class="active"
                data-bs-target="#carouselDemo"
                data-bs-slide-to="0"></button>
            <button
                type="button"
                data-bs-target="#carouselDemo"
                data-bs-slide-to="1"></button>
            <button
                type="button"
                data-bs-target="#carouselDemo"
                data-bs-slide-to="2"></button>
            <button
                type="button"
                data-bs-target="#carouselDemo"
                data-bs-slide-to="3"></button>
            <button
                type="button"
                data-bs-target="#carouselDemo"
                data-bs-slide-to="4"></button>
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
    <!-- ==========San Pham Ban Chay===== -->
    <?php
    $sql = "SELECT product_id, product_name, product_description, product_price, product_image FROM product";
    $result =  mysqli_query($mysqli, $sql);
    ?>

    <section class="sp-ban-chay">
        <div class="sp-ban-chay-title">
            <h1>Sản Phẩm Bán Chạy</h1>
        </div>
        <div class="sp-ban-chay-list">
            <div class="row row-cols-1 row-cols-md-4 g-4 py-5">
                <?php
                if ($result->num_rows > 0) {
                    // Vòng lặp qua từng sản phẩm
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col">
                            <div class="card" style="width: 18rem">
                                <a href="./index.php?quanly=chitietsanpham&id=<?php echo $row['product_id']; ?>">
                                    <img width="287px" height="200px" src="/lap-Trinh-Web-main/assets/images/<?php echo $row['product_image']; ?>" alt="Hình ảnh sản phẩm" />
                                    <div class="sp-note-Hot">HOT</div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                        <p class="card-text">
                                            <?php echo $row['product_description']; ?>
                                        </p>
                                    </div>
                                </a>
                                <div class="d-flex justify-content-around mb-5">
                                    <h3><?php echo number_format($row['product_price'], 0, ',', '.'); ?>₫</h3>
                                    <a href="#" class="btn btn-primary">Mua Ngay</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='text-center'>Không có sản phẩm nào</p>";
                }
                ?>
            </div>
        </div>
    </section>


    <h1 class="danh-gia-title">Cảm Nhận Của Khách Hàng <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></h1>
    <!-- =========Danh Gia Khach Hang========== -->
    <section class="danh-gia">
        <div class="testimonial-carousel owl-carousel">
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/Bill_Gatesr.jpg" alt="">
                <h3>Bill Gates</h3>
                <p style="font-size: 17px;">Chất lượng vượt xa mong đợi, sofa rất thoải mái và thiết kế hiện đại, phù hợp với không gian nhà tôi.</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/02_Putin_0.jpg" alt="">
                <h3>Vladimir Putin</h3>
                <p style="font-size: 17px;">Bàn ăn gỗ sồi rất chắc chắn và sang trọng. Tôi rất hài lòng với sản phẩm này, gia đình tôi yêu thích mỗi khi ngồi dùng bữa.</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/trump.jpg" alt="">
                <h3>Donald Trump</h3>
                <p style="font-size: 17px;">Tủ quần áo rộng rãi, ngăn kéo trượt rất mượt mà và kiểu dáng thời thượng. Đáng để đầu tư cho không gian sống</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/ronaldo.jpg" alt="">
                <h3>C. Ronaldo</h3>
                <p style="font-size: 17px;">Bàn trà có thiết kế tối giản nhưng cực kỳ tiện lợi. Kết cấu chắc chắn, màu gỗ rất tự nhiên và tinh tế.</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/Messi.jpg" alt="">
                <h3>Lionel Messi</h3>
                <p style="font-size: 17px;">Ghế bành vừa đẹp vừa thoải mái, hoàn hảo cho phòng khách của tôi. Đặc biệt, màu sắc rất hài hòa với nội thất khác.</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/kim.jpg" alt="">
                <h3>Kim Jong Un</h3>
                <p style="font-size: 17px;">Tôi yêu chiếc kệ sách này! Rất chắc chắn và phong cách hiện đại, giúp không gian phòng tôi trở nên gọn gàng và bắt mắt hơn.</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/elon-musks.png" alt="">
                <h3>Elon Musk</h3>
                <p style="font-size: 17px;">Kệ TV vừa vặn và đẹp mắt, chất liệu gỗ tự nhiên bền chắc và rất dễ lắp đặt. Một điểm nhấn tuyệt vời cho phòng khách</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/tran-thanh.jpg" alt="">
                <h3>Trấn Thành</h3>
                <p style="font-size: 17px;">Bộ bàn ghế ăn với thiết kế đơn giản nhưng rất tinh tế. Gỗ tự nhiên chắc chắn và nước sơn rất mịn, tạo cảm giác sang trọng.</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/jack-ma.jpg" alt="">
                <h3>Jack Ma</h3>
                <p style="font-size: 17px;">Tôi rất ấn tượng với chiếc tủ bếp mới. Nhiều ngăn tiện lợi, thiết kế tối giản mà sang trọng, chất liệu rất bền.</p>
            </div>
            <div class="testimonial-item">
                <img src="./assets/images/KhachHang/tap-can-binh.jpg" alt="">
                <h3>Tập Cận Bình</h3>
                <p style="font-size: 17px;">Ghế tựa gỗ này có kiểu dáng cổ điển nhưng cực kỳ thoải mái. Độ hoàn thiện và đường nét sắc sảo của sản phẩm thật sự đẳng cấp.</p>
            </div>



        </div>
    </section>
    <!-- ===========Tin Tuc =========== -->
    <h1 class="tin-tuc-title">Kiến Thức Nội Thất <i class="fa-solid fa-lightbulb"></i></h1>
    <section class="tin-tuc">
        <div class="news-carousel owl-carousel">
            <div class="news-item">
                <a href="news1.html">
                    <img src="./assets/images/KhachHang/tintuc1.jpg" alt="News 1">
                    <div class="news-description">
                        <div class="tintuc-note">
                            Xem Ngay
                        </div>
                        Top 5 thương hiệu nội thất Ý cho tổ ấm hiện đại
                    </div>
                </a>
            </div>
            <div class="news-item">
                <a href="news2.html">
                    <img src="assets/images/tintuc2.jpg" alt="News 2">

                    <div class="news-description">
                        <div class="tintuc-note">
                            Xem Ngay
                        </div>
                        Top 5 Chất Liệu Ghế Sofa Phổ Biến Nhất Dành Cho Tổ Ấm Việt
                    </div>
                </a>
            </div>
            <div class="news-item">
                <a href="news3.html">
                    <img src="./assets/images/tintuc3.jpg" alt="News 3">
                    <div class="news-description">
                        <div class="tintuc-note">
                            Xem Ngay
                        </div>
                        Top 5 Xu Hướng Thiết Kế Nhà Thịnh Hành Nhất Hiện Nay
                    </div>
                </a>
            </div>
            <div class="news-item">
                <a href="news4.html">
                    <img src="./assets/images/tintuc4.jpg" alt="News 4">
                    <div class="news-description">
                        <div class="tintuc-note">
                            Xem Ngay
                        </div>
                        Top 5 sai lầm nên tránh khi mua sofa phòng khách
                    </div>
                </a>
            </div>
            <div class="news-item">
                <a href="news5.html">
                    <img src="./assets/images/tintuc5.jpg" alt="News 5">
                    <div class="news-description">
                        <div class="tintuc-note">
                            Xem Ngay
                        </div>
                        Bí Quyết Để Giữ Căn Bếp Luôn Gọn Gàng
                    </div>
                </a>
            </div>
            <div class="news-item">
                <a href="news5.html">
                    <img src="./assets/images/tintuc6.jpg" alt="News 5">
                    <div class="news-description">
                        <div class="tintuc-note">
                            Xem Ngay
                        </div>
                        Tips Trang Trí Góc Học Tập, Làm Việc Đẹp Và Khoa Học
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>
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