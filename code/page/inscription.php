<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$dbh = new PDO('mysql:host=localhost;dbname=camagru', 'camagru_user', 'camagru42');
		$statment = $dbh->prepare("SELECT * FROM users WHERE login = :login");
		$statment->bindValue(':login', $_POST['login']);
		$statment->execute();
		$result = $statment->fetch();
		//TODO: verifier correctement le formatage des champs du formulaire (espace, nb de charactere etc)
		if (!empty($result)) {
			$error = 'Utilisateur deja existant';
		} elseif ($_POST['pwd'] != $_POST['pwd2']) {
			$error = 'Mots de passe non identiques';
		} elseif (empty($_POST['email'])) {
			$error = 'Champ email vide!';
		}elseif (empty($_POST['login'])) {
			$error = 'utilisateur deja existant!';
		} else {
			//TODO: Tout est bon, creer la page dacceuil et envoyer lemail
			echo 'comte cree !';
			$password = hash('whirlpool', $_POST['pwd']);
			$statment = $dbh->prepare("INSERT INTO users (login, password, email) VALUES (:login, :password , :email)");
			$statment->bindValue(':login', $_POST['login']);
			$statment->bindValue(':password', $password);
			$statment->bindValue(':email', $_POST['email']);
			$statment->execute();
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