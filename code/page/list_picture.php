<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/25/16
	 * Time: 3:04 PM
	 */
	require_once($_SERVER['DOCUMENT_ROOT']."/model/DAOPicture.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/User.php");

	function list_it($list)
	{
		if ($list)
		{
			echo '<div class="all_pic_container">';
			foreach ($list as $v)
			{
				echo '<a href="';
				if (isset($_SESSION['user']))
				{
					echo './index.php?pic_id=' . $v->getId();
				}
				else
				{
					echo './page/connection.php';
				}
				echo '">';
				echo '<div class="pic_box">';
				echo '<img class="pictures " id="' . $v->getId() . '" src="' . $v->getData() . '"">';
				echo '</div></a>';
			}
			echo '</div>';
		}
	}
?>

