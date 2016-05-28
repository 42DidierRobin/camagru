<?php

	require_once('User.php');
	require_once('PDOS.php');

	class DAOUser
	{
		public static function randomPwd()
		{
			$all = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ0123456789";
			$maj = "ABCDEFGHIJKLMNOPQRSUTVWXYZ";
			$nbr = "0123456789";
			$ret = array();
			$ret[0] = $maj[rand(0, strlen($maj)-1)];
			$ret[1] = $nbr[rand(0, strlen($nbr)-1)];
			for ($i = 2; $i < 8; $i++) {
				$ret[$i] = $all[rand(0, strlen($all)-1)];
			}
			return (implode($ret));
		}

		private static function random_str($nbr)
		{
			$str = "";
			$chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSUTVWXYZ0123456789";
			$nb_chars = strlen($chaine);
			for ($i = 0; $i < $nbr; $i++) {
				$str .= $chaine[rand(0, ($nb_chars - 1))];
			}
			return $str;
		}

		public static function getUserByLogin($login)
		{
			$statement = PDOS::getInstance()->prepare
							("SELECT * FROM users WHERE login = :login");
			$statement->bindValue(':login', $login);
			$statement->execute();
			$result = $statement->fetch();
			if ($result)
				return (new User($result['login'], $result['password'], $result['email'], $result['activation']));
			else
				return (null);
		}

		public static function newUser($login, $password, $email)
		{
			$activation = self::random_str(42);
			$statement = PDOS::getInstance()->prepare
				("INSERT INTO users (login, email, password, activation) 
							VAlUE (:login, :email, :password, :activation)");
			$statement->bindValue(':login', $login);
			$statement->bindValue(':email', $email);
			$statement->bindValue(':activation', $activation);
			$statement->bindValue(':password', $password);
			$statement->execute();
			return (new User($login, $password, $email, $activation));
		}

		public static function activateUserByKey($key)
		{
			$statement = PDOS::getInstance()->prepare
				("SELECT login FROM users WHERE activation=:key");
			$statement->bindValue(':key', $key);
			$statement->execute();
			$login = $statement->fetch()['login'];
			if (!$login)
				return (null);
			$statement = PDOS::getInstance()->prepare
				("UPDATE users SET activation=null WHERE login=:login");
			$statement->bindValue(':login', $login);
			$statement->execute();
			return ($login);
		}

		public static function controlUser($user, $mail)
		{
			$statement = PDOS::getInstance()->prepare
			("SELECT * FROM users WHERE (login=:user AND email=:mail)");
			$statement->bindValue(':user', $user);
			$statement->bindValue(':mail', $mail);
			$statement->execute();
			return($statement->fetch());
		}

		public static function resetPwd($user, $pwd)
		{
			$statement = PDOS::getInstance()->prepare
			("UPDATE users SET password=:pwd WHERE login=:user");
			$statement->bindValue(':user', $user);
			$statement->bindValue(':pwd', $pwd);
			$statement->execute();
		}
	}