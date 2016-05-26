<?php

	require_once("./model/DAOPicture.php");
	require_once("./model/DAOComments.php");
	require_once("./model/User.php");
	require_once ("./model/DAOLikes.php");
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
		DAOPicture::newPicture($user, $_POST['picture']);
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
					header("location: ./index.php?pic_id=".$_GET['pic_id']);
				else
					header("location: ./index.php?");
				exit(1);
			}

			//suivent les differents cas en fonction de laction (delete, comment, like)
			if (isset($_GET['delete_picture'])
				&& DAOPicture::checkIdentity(unserialize($_SESSION['user'])->getLogin(),$_GET['delete_picture']))
			{
				DAOPicture::deletePicture($_GET['delete_picture']);
				$_GET['pic_id'] = 0;
				home();
			}
			else if (isset($_GET['like']))
			{
				DAOLikes::newLike(unserialize($_SESSION['user'])->getLogin(), $_GET['pic_id']);
				home();
			}
			else if (isset($_GET['dislike']))
			{
				DAOLikes::deleteLike($_GET['dislike']);
				home();
			}
			else if (isset($_POST['comment']))
			{
				DAOComments::newComment(unserialize($_SESSION['user'])->getLogin(), $_POST['pic_id'], $_POST['comment']);
				home();
			}

			//on affiche limage ou la video
			if (isset($_GET['pic_id']) && $_GET['pic_id'] && isset($_SESSION['user']))
				require_once ("picture.php");
			else
				require_once ("video.php");


		?>
	</div>
</div>
<div class="user_side container">
	<div class="side_box box">
		Mes photos
		<?php  list_it(DAOPicture::getUserListPicture(unserialize($_SESSION['user'])->getLogin()))?>
	</div>
</div>
</body>