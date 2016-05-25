<?php

	require_once("./Likes.php");

	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 7:09 PM
	 */
	class DAOLikes
	{

		private static function didHeLikedIt($user, $picture)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM likes WHERE user=:user AND picture=:picture");
			$statement->bindValue(':user', $user);
			$statement->bindValue(':picture', $picture);
			$statement->execute();
			$res = $statement->fetch();
			if ($res)
			{
				return (true);
			}
			return (false);
		}

		public static function newLike($user, $picture)
		{
			if (!self::didHeLikedIt($user, $picture))
			{
				$statement = PDOS::getInstance()->prepare
				("INSERT INTO likes (user, picture) 
							VAlUE (:user, :picture)");
				$statement->bindValue(':user', $user);
				$statement->bindValue(':picture', $picture);
				$statement->execute();
				$statement = PDOS::getInstance()->prepare
				("SELECT MAX(id) FROM likes");
				$statement->execute();
				$id = $statement->fetch();
				return (new Like($user, $picture, $id));
			}
			else
			{
				//TODO: supprimer le like
			}
		}

		public static function getNbrLikes($picture)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT COUNT(*) FROM likes WHERE picture=:picture");
			$statement->bindValue(':picture', $picture);
			$statement->execute();
			return ($statement->fetch());
		}
	}