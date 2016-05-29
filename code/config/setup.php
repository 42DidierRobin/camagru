<?php
	require_once('../model/PDOS.php');

	function initDB()
	{
		$statement = PDOS::getInstance()->prepare
		('DROP TABLE IF EXISTS likes ;
DROP TABLE IF EXISTS comments ;
DROP TABLE IF EXISTS pictures ;
DROP TABLE IF EXISTS users ;

			CREATE TABLE users
			(
				id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
				login CHAR(42) NOT NULL UNIQUE,
				email CHAR(84) NOT NULL,
				password CHAR(255) NOT NULL,
				activation VARCHAR(42)
			);
			
			CREATE TABLE pictures
			(
				id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
				likes INT NULL,
				data MEDIUMTEXT,
				timestamp DATETIME NOT NULL DEFAULT NOW(),
				user CHAR(42) NOT NULL,
				FOREIGN KEY (user)
					REFERENCES users(login)
			);
			
			CREATE TABLE comments
			(
				id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
				content TEXT,
				pic_id INT NOT NULL,
				FOREIGN KEY (pic_id)
					REFERENCES pictures(id) ON DELETE CASCADE,
				user CHAR(42) NOT NULL,
				FOREIGN KEY (user)
					REFERENCES users(login) ON DELETE CASCADE
			);
			
			CREATE TABLE likes
			(
				id INT NOT NULL AUTO_INCREMENT UNIQUE PRIMARY KEY,
				pic_id INT NOT NULL,
				FOREIGN KEY (pic_id)
					REFERENCES pictures(id) ON DELETE CASCADE,
				user CHAR(42) NOT NULL,
				FOREIGN KEY (user)
					REFERENCES users(login) ON DELETE CASCADE
			)');
		$statement->execute();
	}
	echo 'click <a href="/config/setup.php?done">here</a> to set/reset the database';
	if (isset($_GET['done']))
	{
		initDB();
		header('location: /index.php');
	}

?>

