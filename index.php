<?php
include './header.php';
if (isset($_GET['page'])) {
    $page = htmlentities($_GET['page']);
    if ($page == 'Shop') include './shop.php';
    else include './form.php';
} else include './shop.php';
include './footer.php';
