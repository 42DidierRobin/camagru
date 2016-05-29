<?php
	session_start();
	require_once ($_SERVER['DOCUMENT_ROOT']."/model/PDOS.php");
	
	$statement = PDOS::getInstance()->prepare
	('SHOW TABLES like \'users\'');
	$statement->execute();
	$res = $statement->fetch();
	if (!$res)
	{
		echo 'go to setup';
		header ('location: /config/setup.php?');
		exit (1);
	}
    if (isset($_GET['deco'])) {
	    session_destroy();
	    header ('location: index.php');
	    exit (1);
    } else {
		include "include/head.php";
		include "include/header.php";
		
		
		if (isset($_SESSION['user']) && !isset($_GET['all_picture']) && !isset($_GET['p']))
		{
			include $_SERVER['DOCUMENT_ROOT'] . "/page/index_user.php";
		}else
			include $_SERVER['DOCUMENT_ROOT'] . "/page/all_picture.php";
			include "include/footer.php";
	}
?>
