<?php ?>
<body>
<div class="header_container">
	<div class="header_box box">
		<a href="/index.php">
			<h1>
				Camagru
			</h1>
		</a>
		<?php
			if (isset($_SESSION['user']))
			{
				echo '<div class="all_picture_link">
					<a href="/index.php?all_picture" class="link">
						Browse user pictures
					</a>
					| 
					<a href="/index.php" class="link">
						Take a picture
					</a></div>';
			}
				?>

		<div class="header_links">
			<?php
				if (isset($_SESSION['user']))
				{
					echo '<a href="/index.php?deco=42" class="link">Disconnect</a>';
				}
				else
					echo '<a href="/page/connection.php" class="link">Connect</a>'
			?>
			|
			<a href="/page/inscription.php" class="link">
				Subscribe
			</a>
		</div>
	</div>
</div>
