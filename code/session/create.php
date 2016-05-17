<?php
	session_start();

	if (!$_POST['login'] || !$_POST['pwd']) {
		header('Location: session_create.php?error=1');
		exit(1);
	} elseif ($_POST['pwd'] != $_POST['pwd2']) {
		header('Location: session_create.php?error=3');
		exit(1);
	}

	$login = $_POST['login'];
	$pwd = hash('whirlpool', $_POST['pwd']);

	$dbh = new PDO('mysql:host=localhost;dbname=camagru', $user, $pass);

	$statment = $dbh->prepare("SELECT * FROM people WHERE pseudo = :pseudo AND password = :password");
	$statment->bindValue(':pseudo', $_POST['pseudo']);
	$statment->bindValue(':password', $_POST['password']);
	$statment->execute();

	$result = $statment->fetch();
	if (!empty($result)) {
		session_start();

	}