<?php

	require_once("Likes.php");

	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 7:09 PM
	 */
	class DAOLikes
	{

		public static function didHeLikedIt($user, $picture)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM likes WHERE (user=:user AND pic_id=:picture)");
			$statement->bindValue(':user', $user, PDO::PARAM_STR);
			$statement->bindValue(':picture', $picture, PDO::PARAM_INT);
			$statement->execute();
			$res = $statement->fetch();
			if ($res)
				return ($res['id']);
			return (false);
		}

		public static function newLike($user, $picture)
		{
			if (!self::didHeLikedIt($user, $picture))
			{
				$statement = PDOS::getInstance()->prepare
				("INSERT INTO likes (user, pic_id) 
							VAlUE (:user, :picture)");
				$statement->bindValue(':user', $user);
				$statement->bindValue(':picture', $picture);
				$statement->execute();
				$statement = PDOS::getInstance()->prepare
				("SELECT MAX(id) FROM likes");
				$statement->execute();
				$id = $statement->fetch();
				return (new Likes($user, $picture, $id));
			}
			return (null);
		}

		public static function getNbrLikes($pic_id)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT COUNT(*) FROM likes WHERE pic_id=:picture");
			$statement->bindValue(':picture', $pic_id, PDO::PARAM_INT);
			$statement->execute();
			return ($statement->fetch()['COUNT(*)']);
		}
		
		public static function deleteLike($id)
		{
			$statement = PDOS::getInstance()->prepare
			("DELETE FROM likes WHERE id=:id");
			$statement->bindValue(':id', $id, PDO::PARAM_INT);
			$statement->execute();	
		}
	}