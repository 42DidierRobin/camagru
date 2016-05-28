<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/28/16
	 * Time: 8:02 PM
	 */

	require_once ("../model/DAOUser.php");
	require_once ('../model/User.php');

	if (isset($_POST['login']) && isset($_POST['mail']))
	{
		if (DAOUser::controlUser(strtolower($_POST['login']), $_POST['mail']))
		{
			$newPwd = DAOUser::randomPwd();
			$user = DAOUser::getUserByLogin($_POST['login']);
			mail($user->getEmail(), "Camagru: reset of your password",
				 'You ask for the reset of your password. Following is your new password: '.$newPwd."\n"
				 .'Note that Camagru wont retain this password after this email. Try not to loose it !');
			DAOUser::resetPwd($user->getLogin(), hash('whirlpool', $newPwd));
			header('location: welcome.php?back');
			exit(1);
		}
		else
		{
			$error = "the combination user/email doesnt exist";
		}
	}
	else {
		$error = "Please fill inputs.";
	}

	include "../include/head.php";
	include "../include/header.php";

?>
	<div class="container">
		<div class="session_form box">
			<form action="reset_pwd.php" method="post">
				<input type="text" class="text_input" placeholder="login" name="login"
					   value="<?php echo isset($_POST['login']) ? $_POST['login'] : '' ?>">
				<input type="email" class="text_input" placeholder="email" name="mail">
				<div class="error">
					<?php echo isset($error) ? $error : '' ?>
				</div>
				<input class="button" type="submit" value="reset my password">
			</form>

		</div>
	</div>
<?php include "../include/footer.php";
?>