<?php

	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/18/16
	 * Time: 12:16 PM
	 */

	class PDOS
	{
		private static $pdoInstance = null;
		private static $instance = null;

		private function __construct()
		{
			require($_SERVER['DOCUMENT_ROOT']."/config/database.php");
			self::$pdoInstance = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			self::$pdoInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		public static function getInstance()
		{
			if (is_null(self::$instance))
			{
				self::$instance = new PDOS();
			}

			return self::$pdoInstance;
		}
	}