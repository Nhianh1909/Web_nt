<?php
ob_start(); // Bắt đầu bộ đệm

// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "web_nt");

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Truy vấn danh sách sản phẩm từ bảng product
$sql = "SELECT product.*, product_category.category_name FROM product 
        INNER JOIN product_category ON product.category_id = product_category.category_id 
        ORDER BY product_id";
$query = mysqli_query($mysqli, $sql);

?>

<table class="table table-bordered text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Mã Code</th>
            <th scope="col">Tên Sản Phẩm</th>
            <th scope="col">Hình Ảnh</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Danh Mục</th>
            <th scope="col">Giá Tiền</th>
            <th scope="col">Số Lượng</th>
            <th scope="col">Nhập Kho</th>
            <th scope="col">Thao Tác</th>
        </tr>
    </thead>
    <tbody id="tbody">
        <?php
        while ($row = mysqli_fetch_array($query)) {
            $editing = isset($_POST['edit_p']) && $_POST['edit_p'] == $row['product_id'];
        ?>
            <tr>
                <form action="" method="POST" enctype="multipart/form-data">
                    <td>
                        <?php if ($editing) { ?>
                            <input type="number" name="new_product_id" value="<?php echo $row['product_id'] ?>" class="form-control">
                        <?php } else { ?>
                            <?php echo $row['product_id'] ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>
                            <input type="text" name="new_product_name" value="<?php echo htmlspecialchars($row['product_name']) ?>" class="form-control">
                        <?php } else { ?>
                            <?php echo htmlspecialchars($row['product_name']) ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>
                            <input type="file" name="new_product_image" class="form-control-file">
                        <?php } else { ?>
                            <img src="/lap-Trinh-Web-main/assets/images/<?php echo htmlspecialchars($row['product_image']); ?>" alt="Hình Sản Phẩm" style="width: 150px; height: 150px;">
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>
                            <input type="text" name="new_product_description" value="<?php echo htmlspecialchars($row['product_description']) ?>" class="form-control">
                        <?php } else { ?>
                            <?php echo htmlspecialchars($row['product_description']) ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>
                            <select name="new_category_id" class="form-control">
                                <?php
                                // Lấy danh sách các danh mục để hiển thị trong form chỉnh sửa
                                $category_query = "SELECT * FROM product_category";
                                $category_result = mysqli_query($mysqli, $category_query);
                                while ($cat_row = mysqli_fetch_assoc($category_result)) {
                                    $selected = ($cat_row['category_id'] == $row['category_id']) ? "selected" : "";
                                    echo "<option value='{$cat_row['category_id']}' $selected>{$cat_row['category_name']}</option>";
                                }
                                ?>
                            </select>
                        <?php } else { ?>
                            <?php echo htmlspecialchars($row['category_name']) ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>
                            <input type="text" name="new_product_price" value="<?php echo htmlspecialchars($row['product_price']) ?>" class="form-control">
                        <?php } else { ?>
                            <?php echo htmlspecialchars($row['product_price']) ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>
                            <input type="number" name="new_product_quantity" value="<?php echo htmlspecialchars($row['product_quantity']) ?>" class="form-control">
                        <?php } else { ?>
                            <?php echo htmlspecialchars($row['product_quantity']) ?>
                        <?php } ?>
                    </td>

                    <td>
                        <?php if ($editing) { ?>
                            <input type="date" name="new_created_at" value="<?php echo htmlspecialchars($row['created_at']) ?>" class="form-control">
                        <?php } else { ?>
                            <?php echo htmlspecialchars($row['created_at']) ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>
                            <!-- Nút Lưu -->
                            <input type="hidden" name="update_id" value="<?php echo $row['product_id'] ?>">
                            <button type="submit" name="update_p" class="btn btn-outline-primary btn-sm">Lưu</button>
                            <!-- Nút Hủy -->
                            <button type="submit" name="cancel_edit" class="btn btn-outline-secondary btn-sm">Hủy</button>
                        <?php } else { ?>
                            <!-- Nút Sửa -->
                            <button type="submit" name="edit_p" value="<?php echo $row['product_id'] ?>" class="btn btn-outline-success btn-sm">Sửa</button>
                            <!-- Nút Xóa -->
                            <input type="hidden" name="delete_id" value="<?php echo $row['product_id'] ?>">
                            <button type="submit" name="delete_p" class="btn btn-outline-danger btn-sm">Xóa</button>
                        <?php } ?>
                    </td>
                </form>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
// Xử lý xóa sản phẩm
if (isset($_POST['delete_p'])) {
    $id = $_POST['delete_id'] ?? null;
    if ($id) {
        $id = mysqli_real_escape_string($mysqli, $id); // Bảo mật input
        $sql = "DELETE FROM product WHERE product_id = $id";
        if (mysqli_query($mysqli, $sql)) {
            ob_end_clean();
            header('Location: index.php?action=quanlysanpham');
            exit();
        } else {
            echo "Lỗi khi xóa sản phẩm: " . mysqli_error($mysqli);
        }
    } else {
        echo "ID sản phẩm không hợp lệ!";
    }
}

// Xử lý cập nhật sản phẩm
if (isset($_POST['update_p'])) {
    $id = $_POST['update_id'] ?? null;
    $new_id = mysqli_real_escape_string($mysqli, $_POST['new_product_id'] ?? '');
    $new_name = mysqli_real_escape_string($mysqli, $_POST['new_product_name'] ?? '');
    $new_price = mysqli_real_escape_string($mysqli, $_POST['new_product_price'] ?? '');
    $new_quantity = mysqli_real_escape_string($mysqli, $_POST['new_product_quantity'] ?? '');
    $new_created_at = mysqli_real_escape_string($mysqli, $_POST['new_created_at'] ?? '');
    $new_category_id = mysqli_real_escape_string($mysqli, $_POST['new_category_id'] ?? '');
    $new_description = mysqli_real_escape_string($mysqli, $_POST['new_product_description'] ?? ''); // Mô tả mới
    $new_image = $_FILES['new_product_image']['name'] ?? '';    // Hình ảnh mới
    $new_image_tmp = $_FILES['new_product_image']['tmp_name']; // Hình ảnh tạm


    if ($id) {
        if ($new_image != '') {
            move_uploaded_file($new_image_tmp, 'assets/images/' . $new_image);
            $sql_update .= ", product_image='$new_image'";

            // Xóa ảnh cũ
            $query = mysqli_query($mysqli, "SELECT product_image FROM product WHERE product_id = '$id' LIMIT 1");
            $row = mysqli_fetch_array($query);
            if ($row) unlink('assets/images/' . $row['product_image']);
        }
        // Cập nhật SQL
        $sql_update = "UPDATE product SET 
                product_id = '$new_id', 
                product_name = '$new_name', 
                product_price = '$new_price', 
                product_quantity = '$new_quantity',
                created_at = '$new_created_at',         
                category_id = '$new_category_id',
                product_description = '$new_description',
                product_image = '$new_image'
                WHERE product_id = '$id'";


        if (mysqli_query($mysqli, $sql_update)) {
            ob_end_clean();
            header('Location: index.php?action=quanlysanpham');
            exit();
        } else {
            echo "Lỗi khi cập nhật sản phẩm: " . mysqli_error($mysqli);
        }
    }
}

// Hủy chỉnh sửa sản phẩm
if (isset($_POST['cancel_edit'])) {
    ob_end_clean();
    header('Location: index.php?action=quanlysanpham');
    exit();
}
?>