<?php
require_once('../db/dbhelper.php');

$id = '';
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
    <title>Category Page - <?= $name ?></title>


    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style//style.min.css">

</head>

<body>

    <div class="container mt-30">
        <div class="panel panel-primary">
            <div class="panel-heading container__title-table">
                <h3 class="panel-title"><?= $name ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php
                    $sql         = 'SELECT product.id, product.title, product.price, product.thumbnail, 
                    product.updated_at, category.name category_name FROM product LEFT JOIN category 
                    ON product.id_category = category.id WHERE category.id = ' . $id;
                    $productList = executeResult($sql);

                    foreach ($productList as $item) {
                        echo
                        '<div class="col-lg-3">
                            <a href="detail.php?id=' . $item['id'] . '">
                                <img src="' . $item['thumbnail'] . '" class="product_img">
                            </a>
                            <a href="detail.php?id=' . $item['id'] . '">
                                <p class="product_name">' . $item['title'] . '</p>
                            </a>
                            <p style="color: red; font-weight: bold;">' . $item['price'] . ' VNĐ</p>
			            </div>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>


    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>