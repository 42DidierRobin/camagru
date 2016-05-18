<?php
	session_start();

    if (isset($_GET['deco'])) {
	    session_destroy();
	    header ('location: index.php');
	    exit (1);
    } else {
		include "include/head.php";
		include "include/header.php";


		if (isset($_SESSION['user']))
			include "./page/index_user.php";
		else
			include "./page/index_anonym.php";

		include "include/footer.php";
	}
?>
