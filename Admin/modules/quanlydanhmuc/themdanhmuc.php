<!-- Category Manager -->


<?php
ob_start();
include('../config.php');

// Truy vấn danh sách các phòng từ bảng room_category
$room_query = "SELECT * FROM room_category";
$room_result = mysqli_query($mysqli, $room_query);

// Kiểm tra xem form đã được submit hay chưa
if (isset($_POST['add_new_c'])) {
    $category_name = $_POST['category_name'];
    $room_id = $_POST['room_id']; // Lấy room_id từ form
    $id = $_GET['id'] ?? null;

    // Kiểm tra và thêm danh mục
    if (!empty($category_name) && !empty($room_id)) {
        // Thêm dữ liệu vào bảng product_category với room_id
        $sql = "INSERT INTO product_category (category_name, room_id, created_at, updated_at) VALUES ('$category_name', '$room_id', NOW(), NOW())";

        if (mysqli_query($mysqli, $sql)) {
            header('Location: http://localhost/lap-Trinh-Web-main/Admin/index.php?action=quanlydanhmuc');

            exit();
        } else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($mysqli);
        }
    } else {
        echo '<p>Vui lòng nhập tên danh mục và chọn phòng</p>';
    }
}
ob_end_flush();
?>

<form action="" method="POST">
    <div class="product-manager" id="product-manager">
        <div class="notification offset-9">
            <div class="notification-content" id="notifi">
                <p id="notifi-content"></p>
            </div>
        </div>
        <div class="text-center mt-2 mb-3">
            <h4>Quản Lý Danh Mục</h4>
        </div>
        <div class="action mb-4">
            <div class="frms container" id="form-id">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="id">Mã danh mục: </label>
                        <input type="text" class="form-control" id="id" placeholder="ID">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="category_name">Tên Danh Mục: </label>
                        <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Tên Danh Mục">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="room_id">Phòng: </label>
                        <select name="room_id" class="form-control" id="room_id" required>
                            <option value="">Chọn phòng</option>
                            <?php
                            // Hiển thị các phòng dưới dạng option trong select
                            if ($room_result) {
                                while ($row = mysqli_fetch_assoc($room_result)) {
                                    echo '<option value="' . $row['room_id'] . '">' . $row['room_name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="form-row">



                </div>

                <div class="text-center" id="actbutton">
                    <button type="button" class="btn btn-outline-info btn-sm" id="updated_at"
                        style="display: none;">Cập Nhật Danh Mục</button>
                    <button type="submit" name="add_new_c" class="btn btn-outline-success btn-sm">Thêm danh mục</button>
                </div>
            </div>
        </div>
        <div class="tab container">
            <!-- Search form -->
            <div class="d-flex offset-8 col-md-4 mb-3">
                <input type="text" name="search" id="search" class="search"
                    placeholder="Nhập Tên Danh Mục ...">
                <i class="fab fa-searchengin fa-lg"></i>
            </div>

        </div>
    </div>
</form>
<p id="genJSON"></p>