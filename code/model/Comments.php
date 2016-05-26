<?php

	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 7:08 PM
	 */
	class Comments
	{
		private $id;
		private $content;
		private $user;
		private $picture;

		/**
		 * Comments constructor.
		 * @param $content
		 * @param $user
		 * @param $picture
		 */
		public function __construct($content, $user, $picture, $id)
		{
			$this->content = $content;
			$this->id = $id;
			$this->user = $user;
			$this->picture = $picture;
		}

		/**
		 * @return mixed
		 */
		public function getContent()
		{
			return $this->content;
		}

		/**
		 * @param mixed $content
		 */
		public function setContent($content)
		{
			$this->content = $content;
		}

		/**
		 * @return mixed
		 */
		public function getUser()
		{
			return $this->user;
		}

		/**
		 * @param mixed $user
		 */
		public function setUser($user)
		{
			$this->user = $user;
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

		
	}