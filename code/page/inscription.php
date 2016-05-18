<?php

	require_once('../model/DAOUser.php');

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//TODO: verifier les entrees avec des expressions regulieres
		$result = DAOUser::getUserByLogin($_POST['login']);
		if (!empty($result)) {
			$error = 'Utilisateur deja existant';
		} elseif ($_POST['pwd'] != $_POST['pwd2']) {
			$error = 'Mots de passe non identiques';
		} elseif (empty($_POST['login'])) {
			$error = 'Champ login vide !';
		} elseif (empty($_POST['email'])) {
			$error = 'Champ email vide!';
		}elseif (empty($_POST['login'])) {
			$error = 'utilisateur deja existant!';
		} else {
			$user = DAOUser::newUser($_POST['login'], hash('whirlpool',$_POST['pwd']), $_POST['email']);
			$link = 'http://164.132.103.226/Camagru/page/connection.php?a='.$user->getActivation();
			mail($_POST['email'], "Camagru confirmation",'Welcome ! Follow this link to activate your account : '.$link);
			header('location: welcome.php');
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