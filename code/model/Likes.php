<?php

	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 7:08 PM
	 */
	class likes
	{
		private $id;
		private $picture;
		private $user;

		public function __construct($user, $picture, $id)
		{
			$this->user = $user;
			$this->id = $id;
			$this->picture = $picture;
		}

		public function getId()
		{
			return $this->id;
		}

		/**
		 * @return mixed
		 */
		public function getPicture()
		{
			return $this->picture;
		}

		/**
		 * @param mixed $picture
		 */
		public function setPicture($picture)
		{
			$this->picture = $picture;
		}

		/**
		 * @param mixed $user
		 */
		public function setUser($user)
		{
			$this->user = $user;
		}

		public function getUser()
		{
			return $this->user;
		}

	}