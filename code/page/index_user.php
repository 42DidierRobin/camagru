<?php

	require_once($_SERVER['DOCUMENT_ROOT']."/model/DAOPicture.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/DAOUser.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/DAOComments.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/User.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/DAOLikes.php");
	require_once $_SERVER['DOCUMENT_ROOT']."/page/list_picture.php";
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/17/16
	 * Time: 6:23 PM
	 */

	function check_image($img_str)
	{
		$img = @imagecreatefromstring($img_str);
		if (!$img)
		{
			return false;
		}
		return true;
	}

	$error = "";
	if (isset($_POST['picture']))
	{
		$user = unserialize($_SESSION['user'])->getLogin();
		$img_str = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['picture']));
		if (!check_image($img_str))
		{
			$error = "not a valid format.";
		}
		else if (strlen($img_str) > 2000000){
			$error = 'too big';
		}
		else
		{
			$img = imagecreatefromstring($img_str);
			$stamp = imagecreatefrompng($_SERVER['DOCUMENT_ROOT']."/files/" . $_POST['png']);
			$marge_right = 10;
			$marge_bottom = 10;
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);
			imagecopy($img, $stamp, imagesx($img) - $sx - $marge_right, imagesy($img) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
			ob_start();
			imagepng($img);
			$final = ob_get_contents();
			ob_end_clean();
			$final = 'data:image/png;base64,' . base64_encode($final);
			DAOPicture::newPicture($user, $final);
			header("location: index.php");
			exit(1);
		}
	}
?>

<div class="user_main container">
	<div class="main_box_on_user box">
		<?php

			//fonction pour retourner a lindex
			function home()
			{
				if (isset($_GET['pic_id']) && $_GET['pic_id'] && DAOPicture::pictureExist($_GET['pic_id']))
				{
					header("location: ./index.php?pic_id=" . $_GET['pic_id']);
				}
				else
				{
					header("location: ./index.php");
				}
				exit(1);
			}

			//suivent les differents cas en fonction de laction (delete, comment, like)
			if (isset($_GET['delete_picture'])
				&& DAOPicture::checkIdentity(unserialize($_SESSION['user'])->getLogin(), $_GET['delete_picture'])
			)
			{
				DAOPicture::deletePicture($_GET['delete_picture']);
				$_GET['pic_id'] = 0;
				home();
			}
			elseif (isset($_GET['like']) && DAOPicture::pictureExist($_GET['pic_id']))
			{
				DAOLikes::newLike(unserialize($_SESSION['user'])->getLogin(), $_GET['pic_id']);
				home();
			}
			elseif (isset($_GET['dislike']) && DAOPicture::pictureExist($_GET['pic_id']))
			{
				DAOLikes::deleteLike($_GET['dislike']);
				home();
			}
			elseif (isset($_POST['comment']) && DAOPicture::pictureExist($_GET['pic_id']))
			{
				$comment = htmlentities($_POST['comment']);
				if (!$comment)
				{
					home();
				}
				DAOComments::newComment(unserialize($_SESSION['user'])->getLogin(), $_POST['pic_id'], $comment);
				$OwnerMail = DAOUser::getUserByLogin(DAOPicture::getPictureFromId($_POST['pic_id'])->getUser())->getEmail();
				echo $OwnerMail;
				mail($OwnerMail, "Camagru: a picture of yours has been commented !",
					 'The user :' . unserialize($_SESSION['user'])->getLogin() . ' just comment one of your picture !');
				home();
			}


			//on affiche limage ou la video
			if (isset($_GET['pic_id']) && $_GET['pic_id'] && isset($_SESSION['user']))
			{
				require_once("picture.php");
			}
			else
			{
				require_once("video.php");
			}


		?>
	</div>
</div>
<div class="user_side container">
	<div class="side_box box">
		Mes photos
		<?php list_it(DAOPicture::getUserListPicture(unserialize($_SESSION['user'])->getLogin())) ?>
	</div>
</div>
</body>