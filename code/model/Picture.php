<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 10:48 AM
	 */
	class Picture
	{
		private $id;
		private $data;
		private $user;
		private $date;

		/**
		 * Picture constructor.
		 * @param $id
		 * @param $data
		 * @param $user
		 */
		public function __construct($id, $data, $user, $date)
		{
			$this->id = $id;
			$this->data = $data;
			$this->user = $user;
			$this->date = $date;
		}

		/**
		 * @return mixed
		 */
		public function getId()
		{
			return $this->id;
		}

		/**
		 * @param mixed $id
		 */
		public function setId($id)
		{
			$this->id = $id;
		}

		/**
		 * @return mixed
		 */
		public function getData()
		{
			return $this->data;
		}

		/**
		 * @param mixed $data
		 */
		public function setData($data)
		{
			$this->data = $data;
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
		
		
	}