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
		
	//TODO : mettre les informations de connection a la base de donne dans le fichier config.ini (cf sujet)	
	private function __construct()
	{
		self::$pdoInstance = new PDO('mysql:host=localhost;dbname=camagru', 'camagru_user', 'camagru42');
		self::$pdoInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new PDOS();
		}

		return self::$pdoInstance;
	}
	}