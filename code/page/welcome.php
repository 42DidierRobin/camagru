<?php
	include "../include/head.php";
	include "../include/header.php";
?>
	<div class="container">
		<div class="welcome_box box">
			<p class="welcome">
				<?php
					if (isset($_GET['back']))
					{
						echo ' Your new password has just been sent on your email adress. Welcome back on Camagru !';
					}
					else
					{
						echo 'Welcome in this amazing Website ! We just sent you an email. Don\'t forget to activate your account by clicking on the link in it .
								Then you will be able to take your picture and share it with your friend !';
					}
				?>
			</p>
			<div class="homepage_link_box">
				<a href="../index.php" class="homepage_link">Home Page</a>
			</div>

		</div>
	</div>
<?php include "../include/footer.php";
?>