<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location:../login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản Lý</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- FontAwsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">


    <link rel="stylesheet" href="../boost trap/css/admin.css">

    <style>
        body {
            overflow-x: hidden;
        }

        i:hover {
            cursor: pointer;
        }

        .search {
            width: 100%;
            border: none;
            border-bottom: 1px solid springgreen;
        }

        .search:focus {
            outline: none;
        }
    </style>
</head>

<body>


    <div class="">
        <div class="row">
            <?php
            include('./modules/menu.php');
            ?>
            <div class="col-10">
                <!-- Navigation -->
                <?php
                include('./modules/header.php');
                include('./modules/main.php');
                ?>
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Chi Tiết Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" id="product-detail">
                    <!-- Data -->
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body" id="detail-content">
                    <!-- Data -->
                    <h1 class="text-center">Đơn Hàng</h1>
                    <div class="row" id="customer-info">
                        <!-- Insert -->
                    </div>

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col" colspan="2">SẢN PHẨM</th>
                                <th scope="col">GIÁ</th>
                                <th scope="col">SỐ LƯỢNG</th>
                                <th scope="col">TỔNG</th>
                            </tr>
                        </thead>
                        <tbody id="customer-product">
                            <!-- Insert Data -->

                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Tổng Tiền: </th>
                                <td id="total-order">100,000 đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('./modules/footer.php');
    ?>
</body>

</html>