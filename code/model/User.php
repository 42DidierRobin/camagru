<?php

	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/18/16
	 * Time: 11:29 AM
	 */
	class User
	{
		private $login;
		private $password;
		private $email;
		private $activation;

		/**
		 * User constructor.
		 * @param $login
		 * @param $password
		 * @param $email
		 */
		public function __construct($login, $password, $email, $activation)
		{
			$this->login = $login;
			$this->password = $password;
			$this->email = $email;
			$this->activation = $activation;
		}

		/**
		 * @return mixed
		 */
		public function getLogin()
		{
			return $this->login;
		}

		/**
		 * @param mixed $login
		 */
		public function setLogin($login)
		{
			$this->login = $login;
		}

		/**
		 * @return mixed
		 */
		public function getPassword()
		{
			return $this->password;
		}

		/**
		 * @param mixed $password
		 */
		public function setPassword($password)
		{
			$this->password = $password;
		}

		/**
		 * @return mixed
		 */
		public function getEmail()
		{
			return $this->email;
		}

		/**
		 * @param mixed $email
		 */
		public function setEmail($email)
		{
			$this->email = $email;
		}
		
		/**
		 * @return mixed
		 */
		public function getActivation()
		{
			return $this->activation;
		}
		
		/**
		 * @param mixed $activation
		 */
		public function setActivation($activation)
		{
			$this->activation = $activation;
		}
	}