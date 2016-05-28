<?php

	session_start();
	require_once('../model/DAOUser.php');

	//On verifie si il sagit dune activation demail
	if (isset($_GET['a']))
	{
		$ret = DAOUser::activateUserByKey($_GET['a']);
		if (!$ret)
		{
			header('location: ../index.php');
			exit(1);
		}
		else
		{
			$_POST['login'] = $ret;
		}
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$password = hash('whirlpool', $_POST['pwd']);
		$user = DAOUser::getUserByLogin(strtolower($_POST['login']));
		if (!empty($user->getActivation()))
		{
			$error = 'Veuillez activer votre email';
		}
		elseif (empty($user))
		{
			$error = 'Cet Utilisateur n\'existe pas';
		}
		elseif ($password != $user->getPassword())
		{
			$error = 'Mot de passe faux.';
		}
		elseif (empty($_POST['login']))
		{
			$error = 'Champ login vide !';
		}
		elseif (empty($_POST['pwd']))
		{
			$error = 'Champ mot de passe vide!';
		}
		else
		{
			$_SESSION['user'] = serialize($user);
			header('location: ../index.php');
			exit (1);
		}
	}

	include "../include/head.php";
	include "../include/header.php";

?>
	<div class="container">
		<div class="session_form box">
			<form action="connection.php" method="post">
				<input type="text" class="text_input" placeholder="login" name="login"
					   value="<?php echo isset($_POST['login']) ? $_POST['login'] : '' ?>">
				<a href="/page/reset_pwd.php" class="forget_password link">reset my password</a>
				<input type="password" class="text_input" placeholder="Mot de passe" name="pwd">
				<div class="error">
					<?php echo isset($error) ? $error : '' ?>
				</div>
				<input class="button" type="submit" value="se connecter">

			</form>

		</div>
	</div>
<?php include "../include/footer.php";
?>