<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/26/16
	 * Time: 11:27 AM
	 */
	if (!DAOPicture::pictureExist($_GET['pic_id']))
	{
		header('location: /index.php');
		exit(1);
	}
	$pic = DAOPicture::getPictureFromId($_GET['pic_id']);
	$user = unserialize($_SESSION['user'])->getLogin();
?>

<div class="the_picture_box">
	<div class="video_picture_container">
		<?php
			echo '<img class="the_picture" id="' . $pic->getId() . '" src="' . $pic->getData() . '"">';
		?>
	</div>
	<div class="picture_user_button">
		<?php
			if ($user == $pic->getUser())
			{
				echo '<a  href="./index.php?pic_id=' . $pic->getId() . '&delete_picture=' . $pic->getId() . '">
						<input class="picture_buttons"type="button" value="delete"></a>';
			}

		?>
		<div class="like_box">
				<?php
					if ($id = DAOLikes::didHeLikedIt($user, $pic->getId()))
					{
						echo '<a class="like_button" href="./index.php?dislike=' . $id . '&pic_id=' . $pic->getId() . '">
						<input class="picture_buttons like_button" type="button" value="dislike">
					  </a>';
					}
					else
					{
						echo '<a class="like_button" href="./index.php?like=1&pic_id=' . $pic->getId() . '">
						<input class="picture_buttons like_button" type="button" value="like">
					  </a>';
					}
				?>
			<div class="nbr_like_box">
				<p class="nbr_like">
					<?php echo DAOLikes::getNbrLikes($pic->getId()); ?>
				</p>
				<img class="thumbs_up_pic" src="/files/like.png" alt="">
			</div></div>
			<form action="./index.php?pic_id=<?php echo $pic->getId(); ?>" method="post">
				<input type="text" class="text" name="comment">
				<input type="hidden" value="<?php echo $pic->getId(); ?>" name="pic_id">
				<input class="picture_buttons" type="submit" value="add comment">
			</form>
		</div>
		<?php require_once("list_comments.php"); ?></div>
