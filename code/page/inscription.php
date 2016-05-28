<?php
	error_reporting("E_ALL");
	ini_set("display_errors", '1');
	require_once('../model/DAOUser.php');

	print_r($_POST);
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$result = DAOUser::getUserByLogin($_POST['login']);
		if (!empty($result))
		{
			$error = 'already existing user';
		}
		elseif (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
		{
			$error = 'invalid mail adress format';
		}
		elseif (!preg_match("#^[a-z0-9._-]{4,17}$#", strtolower($_POST['login'])))
		{
			$error = 'invalid login format';
		}
		elseif ($_POST['pwd'] != $_POST['pwd2'])
		{
			$error = 'password different';
		}
		elseif (!preg_match("#^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$#", $_POST['pwd']))
		{
			$error = 'invalid password format';
		}
		elseif (empty($_POST['login']))
		{
			$error = 'already existing user';
		}
		else
		{
			$user = DAOUser::newUser(strtolower($_POST['login']), hash('whirlpool', $_POST['pwd']), $_POST['email']);
			$link = 'http://164.132.103.226/page/connection.php?a=' . $user->getActivation();
			mail($_POST['email'], "Camagru confirmation", 'Welcome ! Follow this link to activate your account : ' . $link);
			//header('location: welcome.php');
			exit (1);
		}

	}

	include "../include/head.php";
	include "../include/header.php";
	session_start();
?>
	<div class="container">
		<div class="session_form box">
			<form action="" method="post">
				<input type="text" class="text_input" placeholder="login" name="login"
					   value="<?php echo isset($_POST['login']) ? $_POST['login'] : '' ?>">
				<input type="email" class="text_input" placeholder="email" name="email"
					   value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
				<input type="password" class="text_input" placeholder="Mot de passe" name="pwd">
				<input type="password" class="text_input" placeholder="Confirmer Mot de passe" name="pwd2">
				<div class="error">
					<?php echo isset($error) ? $error : '' ?>
				</div>
				<input class="button" type="submit" value="Créer">
			</form>
		</div>
	</div>
<?php include "../include/footer.php";
?>