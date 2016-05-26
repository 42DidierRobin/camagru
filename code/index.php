<?php
	session_start();

    if (isset($_GET['deco'])) {
	    session_destroy();
	    header ('location: index.php');
	    exit (1);
    } else {
		include "include/head.php";
		include "include/header.php";


		if (isset($_SESSION['user']) && !isset($_GET['all_picture']))
			include "./page/index_user.php";
		else
			include "./page/all_picture.php";

		include "include/footer.php";
	}
?>
