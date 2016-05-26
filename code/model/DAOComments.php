<?php

	require_once ("Comments.php");
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 7:08 PM
	 */
	class DAOComments
	{
		private $id;
		private $content;
		private $pic_id;
		private $user;

		private static function tabToObject($tab)
		{
			$ret = array();
			foreach ($tab as $v)
				array_push($ret, new Comments($v['content'], $v['user'], $v['pic_id'], $v['id']));
			return ($ret);
		}

		public static function newComment($user, $pic_id, $content)
		{
			$statement = PDOS::getInstance()->prepare
			("INSERT INTO comments (user, pic_id, content) 
							VAlUE (:user, :pic_id, :content)");
			$statement->bindValue(':user', $user);
			$statement->bindValue(':pic_id', $pic_id);
			$statement->bindValue(':content', $content);
			$statement->execute();
			$statement = PDOS::getInstance()->prepare
			("SELECT MAX(id) FROM comments");
			$statement->execute();
			$id = $statement->fetch();
			return (new Comments($content, $user, $pic_id, $id));
		}

		public static function getPictureComments($pic_id)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM comments WHERE pic_id=:id");
			$statement->bindValue(":id", $pic_id);
			$statement->execute();
			$r = $statement->fetchAll();
			return (self::tabToObject($r));
		}
		
	}