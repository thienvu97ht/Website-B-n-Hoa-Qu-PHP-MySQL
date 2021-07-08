<?php
require_once '../../db/dbhelper.php';
require_once '../../common/util.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>


    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.min.css">

</head>

<body>

    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <ul class="nav navbar-nav">
            <li>
                <a href="../category">Quản Lý Danh Mục</a>
            </li>
            <li class="active">
                <a href="./">Quản Lý Sản Phẩm</a>
            </li>
        </ul>
    </nav>


    <div class="container mt-30">
        <div class="panel panel-primary">
            <div class="panel-heading container__title-table">
                <h3 class="panel-title">Quản Lý Danh Mục</h3>
                <a href="./add.php">
                    <button class="btn btn-success">Thêm danh mục</button>
                </a>
            </div>
            <div class="panel-body">
                <form method="GET">
                    <div class="form-group">
                        <label for="s">Tìm kiếm</label>
                        <input type="text" class="form-control" id="s" placeholder="Searching..." name="s">
                    </div>
                </form>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">STT</th>
                            <th class="text-center">Hình Ảnh</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Giá Bán</th>
                            <th class="text-center">Danh Mục</th>
                            <th class="text-center">Ngày cập nhật</th>
                            <th colspan="2" class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $itemPerPage = 8;
                        $currentPage = 1;
                        if (isset($_GET['page'])) {
                            $currentPage = $_GET['page'];
                        }

                        if ($currentPage <= 0) {
                            $currentPage = 1;
                        }

                        $start = ($currentPage - 1) * $itemPerPage;

                        $s = "";
                        if (isset($_GET['s'])) {
                            $s = $_GET['s'];
                        }

                        // Trang cần lấy sản phẩm
                        $additional = "";
                        if (!empty($s)) {
                            $additional = "AND title LIKE '%" . $s . "%'";
                        }
                        $sql = "SELECT product.id, product.title, product.price, product.thumbnail, 
                        product.updated_at, category.name category_name FROM product LEFT JOIN category 
                        ON product.id_category = category.id WHERE 1 $additional LIMIT $start, $itemPerPage";
                        $productList = executeResult($sql);

                        // Tính tổng số trang
                        $sql = "SELECT count(id) AS total FROM product WHERE 1 " . $additional . "";
                        $countResult = executeSingleResult($sql);
                        $totalPage = 0;
                        if ($countResult != null) {
                            $count = $countResult['total'];
                            $totalPage = ceil($count / $itemPerPage);
                        }

                        foreach ($productList as $item) {
                            echo
                            '<tr>
                                <td class="text-center">' . (++$start) . '</td>
                                <td class="text-center">
                                    <img src="' . $item['thumbnail'] . '" style="max-width: 120px" />
                                </td>
                                <td>' . $item['title'] . '</td>
                                <td>' . $item['price'] . '</td>
                                <td>' . $item['category_name'] . '</td>
                                <td>' . $item['updated_at'] . '</td>
                                <td class="text-center" width="80px">
                                    <a href="add.php?id=' . $item['id'] . '" >
                                        <button class="btn btn-success">
                                            Sửa
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center" width="80px">
                                    <button class="btn btn-danger" onclick="deleteProduct(' . $item['id'] . ')">
                                        Xóa
                                    </button>
                                </td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Bài toán phân trang -->
                <?= pagination($totalPage, $currentPage, '&s=' . $s) ?>
            </div>
        </div>
    </div>


    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
    function deleteProduct(id) {
        let option = confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');

        if (!option) return;

        $.post('ajax.php', {
            'id': id,
            'action': 'delete',
        }, function(data) {
            location.reload()
        })
    }
    </script>
</body>

</html>