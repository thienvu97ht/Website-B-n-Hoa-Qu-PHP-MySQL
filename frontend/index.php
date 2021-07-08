<?php
require_once('../db/dbhelper.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>


    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.min.css">

</head>

<body>


    <div class="container mt-30">
        <div class="panel panel-primary">
            <div class="panel-heading container__title-table">
                <h3 class="panel-title">Quản Lý Danh Mục</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" width="50px">STT</th>
                            <th class="text-center">Tên Danh Mục</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM category";
                        $categoryList = executeResult($sql);
                        $index = 1;
                        foreach ($categoryList as $item) {
                            echo
                            '<tr>
                                <td class="text-center">' . ($index++) . '</td>
                                <td>
                                    <a href="category.php?id=' . ($item['id']) . '">' .  $item['name'] . '</a>
                                </td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>

</html>