<?php
ob_start();
include('../config.php');

// Truy vấn danh sách các danh mục từ bảng product_category
$category_query = "SELECT * FROM product_category";
$category_result = mysqli_query($mysqli, $category_query);

// Kiểm tra xem form đã được submit hay chưa
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $created_at = $_POST['created_at'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];





    // Kiểm tra và thêm sản phẩm
    if (!empty($product_name) && !empty($category_id) && !empty($product_price) && !empty($product_quantity)) {
        // Thêm dữ liệu vào bảng product
        $sql = "INSERT INTO product (product_name, category_id, product_price, product_quantity, created_at, updated_at, product_description,product_image) 
                VALUES ('$product_name', '$category_id', '$product_price', '$product_quantity', NOW(),NOW(), '$product_description','$product_image')";
        move_uploaded_file($product_image_tmp, '../images/' . $product_image);
        if (mysqli_query($mysqli, $sql)) {
            // Điều hướng sau khi thêm sản phẩm thành công
            header('Location: http://localhost/lap-Trinh-Web-main/Admin/index.php?action=quanlysanpham');
            exit();
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($mysqli);
        }
    } else {
        echo '<p>Vui lòng nhập đầy đủ thông tin sản phẩm</p>';
    }
}
ob_end_flush();
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="product-manager" id="product-manager">
        <div class="notification offset-9">
            <div class="notification-content" id="notifi">
                <p id="notifi-content"></p>
            </div>
        </div>
        <div class="text-center mt-2 mb-3">
            <h4>Quản Lý Sản Phẩm</h4>
        </div>
        <div class="action mb-4">
            <div class="frms container" id="form-id">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="id">Mã Sản Phẩm: </label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="product_name">Tên Sản Phẩm: </label>
                        <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Tên Sản Phẩm">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="product_description">Mô tả: </label>
                        <input type="text" class="form-control" name="product_description" id="product_description" placeholder="Mô tả">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="category_id">Danh Mục: </label>
                        <select name="category_id" class="form-control" id="category_id" required>
                            <option value="">Chọn danh mục</option>
                            <?php
                            // Hiển thị các danh mục dưới dạng option trong select
                            if ($category_result) {
                                while ($row = mysqli_fetch_assoc($category_result)) {
                                    echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="product_price">Giá Tiền: </label>
                        <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Giá tiền">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="product_quantity">Số Lượng: </label>
                        <input type="number" class="form-control" name="product_quantity" id="product_quantity" placeholder="Số lượng">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="created_at">Ngày Nhập Kho: </label>
                        <input type="date" class="form-control" name="created_at" id="created_at">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="product_image">Hình Sản Phẩm: </label>
                    <input type="file" class="form-control-file btn-outline-info" name="product_image" id="product_image">
                </div>

                <div class="text-center" id="actbutton">
                    <button type="button" class="btn btn-outline-info btn-sm" id="updated_at"
                        style="display: none;">Cập Nhật Danh Mục</button>

                    <button type="submit" name="add_product" class="btn btn-outline-success btn-sm">Thêm Sản Phẩm</button>
                </div>
            </div>
        </div>
        <div class="tab container">
            <!-- Search form -->
            <div class="d-flex offset-8 col-md-4 mb-3">
                <input type="text" name="search" id="search" class="search" placeholder="Nhập Tên Sản Phẩm ...">
                <i class="fab fa-searchengin fa-lg"></i>
            </div>
        </div>
    </div>
</form>
<p id="genJSON"></p>