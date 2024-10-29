<?php
ob_start(); // Bắt đầu bộ đệm

$sql = "SELECT * FROM product_category ORDER BY category_id";
$query = mysqli_query($mysqli, $sql);

?>

<table class="table table-bordered text-center">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Mã Danh Mục</th>
            <th scope="col">Tên Danh Mục</th>
            <th scope="col">Quản Lý</th>
        </tr>
    </thead>
    <tbody id="tbody">
        <?php
        while ($row = mysqli_fetch_array($query)) {
            $editing = isset($_POST['edit_c']) && $_POST['edit_c'] == $row['category_id'];
        ?>
            <tr>
                <form action="" method="POST">
                    <td>
                        <?php if ($editing) { ?>
                            <input type="number" name="new_category_id" value="<?php echo $row['category_id'] ?>" class="form-control">

                        <?php } else { ?>
                            <?php echo $row['category_id'] ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>

                            <input type="text" name="new_category_name" value="<?php echo $row['category_name'] ?>" class="form-control">
                        <?php } else { ?>
                            <?php echo $row['category_name'] ?>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($editing) { ?>
                            <!-- Nút Lưu -->
                            <input type="hidden" name="update_id" value="<?php echo $row['category_id'] ?>">
                            <button type="submit" name="update_c" class="btn btn-outline-primary btn-sm">Lưu</button>
                            <!-- Nút Hủy -->
                            <button type="submit" name="cancel_edit" class="btn btn-outline-secondary btn-sm">Hủy</button>
                        <?php } else { ?>
                            <!-- Nút Sửa -->
                            <button type="submit" name="edit_c" value="<?php echo $row['category_id'] ?>" class="btn btn-outline-success btn-sm">Sửa</button>
                            <!-- Nút Xóa -->
                            <input type="hidden" name="delete_id" value="<?php echo $row['category_id'] ?>">
                            <button type="submit" name="delete_c" class="btn btn-outline-danger btn-sm">Xóa</button>
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
// Xử lý xóa danh mục
if (isset($_POST['delete_c'])) {
    $id = $_POST['delete_id'] ?? null;
    if ($id) {
        $sql = "DELETE FROM product_category WHERE category_id = $id";
        if (mysqli_query($mysqli, $sql)) {
            ob_end_clean();
            header('Location: index.php?action=quanlydanhmuc');
            exit();
        } else {
            echo "Lỗi khi xóa danh mục: " . mysqli_error($mysqli);
        }
    } else {
        echo "ID danh mục không hợp lệ!";
    }
}

// Xử lý cập nhật danh mục
if (isset($_POST['update_c'])) {
    $id = $_POST['update_id'] ?? null;
    $new_id = $_POST['new_category_id'] ?? '';
    $new_name = $_POST['new_category_name'] ?? '';
    if ($id && !empty($new_name)) {
        $sql = "UPDATE product_category SET category_name = '$new_name',category_id = '$new_id' WHERE category_id = $id";
        if (mysqli_query($mysqli, $sql)) {
            ob_end_clean();
            header('Location: index.php?action=quanlydanhmuc');
            exit();
        } else {
            echo "Lỗi khi cập nhật danh mục: " . mysqli_error($mysqli);
        }
    } else {
        echo "Vui lòng nhập tên danh mục mới!";
    }
}

ob_end_flush(); // Kết thúc bộ đệm, in ra nội dung
?>