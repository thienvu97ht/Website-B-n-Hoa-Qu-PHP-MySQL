<?php
require_once('../../db/dbhelper.php');

$id = $title = $thumbnail = $price = $id_category = $content = '';

if (!empty($_POST)) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    if (isset($_POST['title'])) {
        $title = $_POST['title'];
        $title = str_replace('"', '\\"', $title);
    }

    if (isset($_POST['thumbnail'])) {
        $thumbnail = $_POST['thumbnail'];
        $thumbnail = str_replace('"', '\\"', $thumbnail);
    }

    if (isset($_POST['price'])) {
        $price = $_POST['price'];
        $price = str_replace('"', '\\"', $price);
    }

    if (isset($_POST['id_category'])) {
        $id_category = $_POST['id_category'];
        $id_category = str_replace('"', '\\"', $id_category);
    }

    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        $content = str_replace('"', '\\"', $content);
    }


    if (!empty($title)) {
        $created_at = $updated_at = date('Y-m-d H:s:i');
        // Lưu vào database
        if ($id == "") {
            $sql = "INSERT INTO product (title, thumbnail, price, content, id_category, created_at, 
            updated_at) VALUES ('$title','$thumbnail','$price','$content','$id_category',
            '$created_at','$updated_at')";
        } else {
            $sql = "UPDATE product set title = '$title', thumbnail = '$thumbnail', 
            price = '$price', content = '$content', id_category = '$id_category', created_at = '$created_at', updated_at= '$updated_at' WHERE id = " . $id;
        }

        execute($sql);
        header("Location: index.php");
        die();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id = " . $id;
    $product = executeSingleResult($sql);
    if ($product != null) {
        $title = $product['title'];
        $price = $product['price'];
        $thumbnail = $product['thumbnail'];
        $id_category = $product['id_category'];
        $content = $product['content'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>


    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.min.css">

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <ul class="nav navbar-nav">
            <li>
                <a href="../category">Quản Lý Danh Mục</a>
            </li>
            <li>
                <a href="./">Quản Lý Sản Phẩm</a>
            </li>
        </ul>
    </nav>


    <div class="container mt-30">
        <div class="panel panel-primary">
            <div class="panel-heading container__title-table">

                <?= $id == "" ? '<h3 class="panel-title">Thêm Sản Phẩm</h3>' :
                    '<h3 class="panel-title">Sửa Sản Phẩm</h3>' ?>
            </div>
            <div class="panel-body">

                <form action="" method="POST" role="form">
                    <input type="text" name="id" value="<?= $id ?>" hidden>
                    <div class="form-group">
                        <label for="title">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>">
                    </div>

                    <div class="form-group">
                        <label for="id_category">Chọn danh mục</label>
                        <select class="form-control" name="id_category" id="id_category">
                            <option>-- Lựa chọn danh mục --</option>
                            <?php
                            $sql = "SELECT * FROM category";
                            $categoryList = executeResult($sql);
                            foreach ($categoryList as $item) {
                                if ($item['id'] == $id_category) {
                                    echo '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Giá bán</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?= $price ?>">
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="text" class="form-control" id="thumbnail" name="thumbnail"
                            value="<?= $thumbnail ?>" onchange="updateThumbnail()">
                        <img src="<?= $thumbnail ?>" alt="" style="max-width: 200px; margin-top: 20px"
                            id="img_thumbnail">
                    </div>

                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea class="form-control" rows="5" name="content" id="content"><?= $content ?></textarea>
                    </div>

                    <?= $id == "" ? '<button type="submit" class="btn btn-success">Thêm sản phẩm</button>' :
                        '<button type="submit" class="btn btn-success">Sửa sản phẩm</button>' ?>
                </form>

            </div>
        </div>
    </div>


    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
    function updateThumbnail() {
        $('#img_thumbnail').attr('src', $('#thumbnail').val());
    };

    $(function() {
        // Đợi website load xong nội dung => xử lý phần JS
        $('#content').summernote({
            height: 150, // set editor height
            'disableResizeEditor': false,
        });
    });
    </script>
</body>

</html>