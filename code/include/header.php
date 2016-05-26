<?php ?>
<body>
<div class="header container">
	<div class="header_box box">
		<a href="/Camagru/index.php">
			<h1>
				Camagru
			</h1>
		</a>
		<?php
			if (isset($_SESSION['user']))
			{
				echo '<div class="all_picture_link">
					<a href="/Camagru/index.php?all_picture" class="link">
						Parcourir toutes les photos
					</a>
					| 
					<a href="/Camagru/index.php?" class="link">
						Prendre une photo
					</a></div>';
			}
				?>

		<div class="header_links">
			<?php
				if (isset($_SESSION['user']))
				{
					echo '<a href="/Camagru/index.php?deco=42" class="link">Disconnect</a>';
				}
				else
					echo '<a href="/Camagru/page/connection.php" class="link">Connect</a>'
			?>
			|
			<a href="/Camagru/page/inscription.php" class="link">
				Subscribe
			</a>
		</div>
	</div>
</div>
