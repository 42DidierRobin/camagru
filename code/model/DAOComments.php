<?php

	require_once ("./Comments.php");
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
		
		//TODO: ajouter les fonctions utiles au commentaires
	}