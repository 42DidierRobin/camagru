<?php
    include "include/head.php";
    include "include/header.php";

    session_start();
    if ($_SESSION)
        include "./page/index_user.php";
    else
        include "./page/index_anonym.php";


    include "include/footer.php";
?>
