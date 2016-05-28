<?php

	require_once("./model/DAOPicture.php");
	require_once("./model/DAOUser.php");
	require_once("./model/DAOComments.php");
	require_once("./model/User.php");
	require_once("./model/DAOLikes.php");
	require_once "./page/list_picture.php";
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/17/16
	 * Time: 6:23 PM
	 */

	if (isset($_POST['picture']))
	{
		$user = unserialize($_SESSION['user'])->getLogin();

		$img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['picture']));
		$img = imagecreatefromstring($img);
		if (!$img)
		{
			echo 'yo';
		}
		$stamp = imagecreatefrompng("./files/".$_POST['png']);
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
?>

<div class="user_main container">
	<div class="main_box box">
		<?php

			//fonction pour retourner a lindex
			function home()
			{
				if (isset($_GET['pic_id']) && $_GET['pic_id'])
				{
					header("location: ./index.php?pic_id=" . $_GET['pic_id']);
				}
				else
				{
					header("location: ./index.php?");
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
			else
			{
				if (isset($_GET['like']))
				{
					DAOLikes::newLike(unserialize($_SESSION['user'])->getLogin(), $_GET['pic_id']);
					home();
				}
				else
				{
					if (isset($_GET['dislike']))
					{
						DAOLikes::deleteLike($_GET['dislike']);
						home();
					}
					else
					{
						if (isset($_POST['comment']))
						{
							DAOComments::newComment(unserialize($_SESSION['user'])->getLogin(), $_POST['pic_id'], $_POST['comment']);
							$OwnerMail = DAOUser::getUserByLogin(DAOPicture::getPictureFromId($_POST['pic_id'])->getUser())->getEmail();
							echo $OwnerMail;
							mail($OwnerMail, "Camagru: a picture of yours has been commented !",
								 'The user :'.unserialize($_SESSION['user'])->getLogin().' just comment one of your picture !');
							home();
						}
					}
				}
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