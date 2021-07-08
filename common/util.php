<?php
function pagination($totalPage, $currentPage, $addition)
{
    if ($totalPage > 1) {
        echo '<ul class="pagination">';
        if ($currentPage > 1) {
            echo '<li><a href="?page=' . 1 . '' . $addition . '">&laquo;</a></li>';
        }

        $avaiablePage = [1, $currentPage - 1, $currentPage, $currentPage + 1, $totalPage];
        $isFirst = $isLast = false;

        for ($i = 1; $i <= $totalPage; $i++) {
            if (!in_array($i, $avaiablePage)) {
                if (!$isFirst && $currentPage > 3) {
                    echo '<li><a href="?page=' . ($currentPage - 2) . '' . $addition . '">...</a></li>';
                    $isFirst = true;
                }

                if (!$isLast && $i > $currentPage) {
                    echo '<li><a href="?page=' . ($currentPage + 2) . '' . $addition . '">...</a></li>';
                    $isLast = true;
                }

                continue;
            }

            if ($currentPage == $i) {
                echo '<li class="active"><a href="?page=' . $i . '' . $addition . '">' . $i . '</a></li>';
            } else {
                echo '<li><a href="?page=' . $i . '' . $addition . '">' . $i . '</a></li>';
            }
        }

        if ($currentPage < $totalPage) {
            echo '<li><a href="?page=' . $totalPage . '' . $addition . '">&raquo;</a></li>';
        }

        echo '</ul>';
    }
}