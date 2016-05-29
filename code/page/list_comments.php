<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/26/16
	 * Time: 4:29 PM
	 */
	require_once($_SERVER['DOCUMENT_ROOT']."/model/User.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/DAOComments.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/Comments.php");

	$list = DAOComments::getPictureComments($pic->getId());
	echo '<div class="all_comments_container">';
	foreach ($list as $v)
	{
		echo '<div class="comment_box">';
		echo '<p class="comment_user">'.$v->getUser().'</p>';
		echo '<p class="comment_content">'.$v->getContent().'</p>';
		echo '</div>';
	}
	echo '</div>';

	?>
