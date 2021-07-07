<?php
require_once('config.php');

function execute($sql)
{
    // Tạo connection tới database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    mysqli_set_charset($conn, 'utf8');

    // Query
    mysqli_query($conn, $sql);

    // Đóng kết nối
    mysqli_close($conn);
}


// Sử dụng cho hàm SELECT
function executeResult($sql)
{
    // Tạo connection tới database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    mysqli_set_charset($conn, 'utf8');

    // Query
    $resultset = mysqli_query($conn, $sql);
    $data = [];

    if ($resultset != null) {
        while ($row = mysqli_fetch_array($resultset, 1)) {
            // Thêm vào cuối phần tử mới
            $data[] = $row;
        }
    }

    // Đóng kết nối
    mysqli_close($conn);

    return $data;
}

function executeSingleResult($sql)
{
    // Tạo connection tới database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    mysqli_set_charset($conn, 'utf8');

    // Query
    $resultset = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($resultset, 1);

    // Đóng kết nối
    mysqli_close($conn);

    return $row;
}