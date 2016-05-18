<?php

    if (isset($_GET['deco'])) {
	    session_start();
	    session_destroy();
	    header ('location: index.php');
	    exit (1);
    }
	else {
		session_start();
		include "include/head.php";
		include "include/header.php";


		if (isset($_SESSION['user']))
			include "./page/index_user.php";
		else
			include "./page/index_anonym.php";

		include "include/footer.php";
	}
?>
