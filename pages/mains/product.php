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
    if (isset($_GET['id'])) {  // Lấy category_id từ URL
        $category_id = $_GET['id'];  // Lưu category_id vào biến

        // Truy vấn lấy sản phẩm theo category_id
        $sql = "SELECT p.product_id, p.product_name, p.product_description, p.product_price, p.product_image 
                FROM product p 
                JOIN product_category pc ON pc.category_id = p.category_id 
                WHERE pc.category_id = $category_id";  // Lọc sản phẩm theo category_id

        $result = mysqli_query($mysqli, $sql);
    } else {
        echo '<p>Không có sản phẩm nào trong danh mục</p>';
    }
    ?>

    <section class="sp-ban-chay">
        <div class="sp-ban-chay-list">
            <div class="row row-cols-1 row-cols-md-4 g-4 py-5">
                <?php
                if (isset($result) && mysqli_num_rows($result) > 0) {
                    // Lặp qua các sản phẩm trong danh mục
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col">
                            <div class="card" style="width: 18rem">
                                <a href="./index.php?quanly=chitietsanpham&id=<?php echo $row['product_id'] ?>">
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
                    echo "<p class='text-center'>Không có sản phẩm nào trong danh mục này.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- ======== Cảm Nhận Khách Hàng và Các phần khác giữ nguyên ======== -->
</main>