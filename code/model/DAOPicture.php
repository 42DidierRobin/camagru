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

		private static function tabToObject($tab)
		{
			$ret = array();
			foreach ($tab as $v)
				array_push($ret, new Picture($v['id'], $v['data'], $v['user'], $v['timestamp']));
			return ($ret);
		}

		public static function newPicture($user, $data)
		{
			$statement = PDOS::getInstance()->prepare
			("INSERT INTO pictures (user, data) 
								VAlUE (:user, :data)");
			$statement->bindValue(':user', $user);
			$statement->bindValue(':data', $data);
			$statement->execute();
			$statement = PDOS::getInstance()->prepare
			("SELECT id, timestamp FROM pictures WHERE id=(SELECT MAX(id) FROM pictures)");
			$statement->execute();
			$res = $statement->fetch();
			return (new Picture($res['id'], $data, $user, $res['timestamp']));
		}

		public static function getUserListPicture($user)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM pictures WHERE user = :user");
			$statement->bindValue(':user', $user);
			$statement->execute();
			$result = $statement->fetchAll();
			return (self::tabToObject($result));
		}

		public static function getAllPicture()
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM pictures ORDER BY timestamp DESC");
			$statement->execute();
			$result = $statement->fetchAll();
			return (self::tabToObject($result));
		}
		
		public static function getPictureFromId($id)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM pictures WHERE id=:id");
			$statement->bindValue(':id', $id, PDO::PARAM_INT);
			$statement->execute();
			$r = $statement->fetch();
			return (new Picture($id, $r['data'], $r['user'], $r['timestamp']));
		}

		public static function deletePicture($id)
		{
			$statement = PDOS::getInstance()->prepare
			("DELETE FROM pictures WHERE id=:id");
			$statement->bindValue(':id', $id, PDO::PARAM_INT);
			$statement->execute();
		}
		
		public static function checkIdentity($user, $pic_id)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM pictures WHERE (user=:user AND id=:id)");
			$statement->bindValue(':id', $pic_id, PDO::PARAM_INT);
			$statement->bindValue(':user', $user, PDO::PARAM_STR);
			$statement->execute();
			if (empty($statement->fetch()))
				return (false);
			return (true);
		}
	}