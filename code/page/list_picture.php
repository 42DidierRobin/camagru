<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 3:04 PM
	 */
	require_once("./model/DAOPicture.php");
	require_once("./model/User.php");

	if (isset($_SESSION['user']))
	{
		$user = unserialize($_SESSION['user'])->getLogin();
		$list = DAOPicture::getUserListPicture($user);
		$list = array_reverse($list, true);
		$test=true;
	}
	else
	{
		$list = DAOPicture::getRandomPicture(42);
		$test = false;
	}
	
	if ($list)
	{
		echo '<div class="all_pic_container">';
		foreach ($list as $v)
		{
			echo '<a href="';
			if ($test)
				echo './index.php?pic_id='. $v->getId();
			else
				echo './page/connection.php';
			echo '">';
			echo '<div class="pic_box">';
			echo '<img class="pictures" id="' . $v->getId() . '" src="' . $v->getData() . '"">';
			echo '</div></a>';
		}
		echo '</div>';
	}

