<?php

	require_once('Picture.php');
	require_once('PDOS.php');

	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 10:55 AM
	 */
	class DAOPicture
	{
		public static function newPicture($user, $data)
		{
			$statement = PDOS::getInstance()->prepare
				("INSERT INTO pictures (user, data) 
								VAlUE (:user, :data)");
			$statement->bindValue(':user', $user);
			$statement->bindValue(':data', $data);
			$statement->execute();
			$statement = PDOS::getInstance()->prepare
				("SELECT MAX(id) FROM pictures");
			$statement->execute();
			$id = $statement->fetch();
			return (new Picture($id, $data, $user));
		}

		public static function getUserPicture ($user)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM pictures WHERE user = :user");
			$statement->bindValue(':user', $user);
			$statement->execute();
			$result = $statement->fetchAll();
			print_r ($result);
		}
	}