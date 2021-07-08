<?php
require_once('../../db/dbhelper.php');

$name = $id = '';

if (!empty($_POST)) {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $name = str_replace('"', '\\"', $name);
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    if (!empty($name)) {
        $created_at = $updated_at = date('Y-m-d H:s:i');
        // Lưu vào database
        if ($id == "") {
            $sql = "INSERT INTO category (name, created_at, updated_at) VALUES ('$name','$created_at','$updated_at')";
        } else {
            $sql = "UPDATE category set name = '$name', created_at = '$created_at', updated_at= '$updated_at' WHERE id = " . $id;
        }

        execute($sql);
        header("Location: index.php");
        die();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM category WHERE id = " . $id;
    $category = executeSingleResult($sql);
    if ($category != null) {
        $name = $category['name'];
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

</head>

<body>

    <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <ul class="nav navbar-nav">
            <li>
                <a href="./">Quản Lý Danh Mục</a>
            </li>
            <li>
                <a href="../product">Quản Lý Sản Phẩm</a>
            </li>
        </ul>
    </nav>


    <div class="container mt-30">
        <div class="panel panel-primary">
            <div class="panel-heading container__title-table">

                <?= $id == "" ? '<h3 class="panel-title">Thêm Danh Mục Sản Phẩm</h3>' :
                    '<h3 class="panel-title">Sửa Danh Mục Sản Phẩm</h3>' ?>
            </div>
            <div class="panel-body">

                <form action="" method="POST" role="form">
                    <input type="text" name="id" value="<?= $id ?>" hidden>
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">
                    </div>


                    <?= $id == "" ? '<button type="submit" class="btn btn-success">Thêm danh mục</button>' :
                        '<button type="submit" class="btn btn-success">Sửa danh mục</button>' ?>
                </form>

            </div>
        </div>
    </div>


    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>