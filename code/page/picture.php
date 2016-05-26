<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/26/16
	 * Time: 11:27 AM
	 */

	$pic = DAOPicture::getPictureFromId($_GET['pic_id']);
?>

<div class="video_picture_box">
	<div class="video_picture_container">
		<?php
			echo '<img class="the_picture" id="' . $pic->getId() . '" src="' . $pic->getData() . '"">';
		?>
	</div>
	<div class="picture_user_button">
		<a href="./index.php?<?php echo 'pic_id=' . $pic->getId() . '&delete_picture=' . $pic->getId(); ?>">
			<input type="button" value="delete">
		</a>
		<?php
			if ($id = DAOLikes::didHeLikedIt($pic->getUser(), $pic->getId()))
			{
				echo '<a href="./index.php?dislike=' . $id . '&pic_id=' . $pic->getId() . '">
						<input type="button" value="dislike">
					  </a>';
			}
			else
			{
				echo '<a href="./index.php?like=1&pic_id=' . $pic->getId() . '">
						<input type="button" value="like">
					  </a>';
			}
		?>
		<form action="./index.php?pic_id=<?php echo $pic->getId(); ?>" method="post">
			<input type="text" class="text" name="comment">
			<input type="hidden" value="<?php echo $pic->getId(); ?>" name="pic_id">
			<input type="submit" value="add comment">
		</form>

	</div>
</div>
<div class="vertical_bar"></div>
<div class="picture_options_box">
	<div class="like_box">
		<p class="nbr_like">
			<?php echo DAOLikes::getNbrLikes($pic->getId()); ?>
		</p>
		<img class="thumbs_up_pic" src="/Camagru/files/like.png" alt="">
	</div>
		<?php require_once ("list_comments.php");?>
</div>
