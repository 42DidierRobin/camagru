<?php ?>
<body>
<div class="header container">
	<div class="header_box box">
		<a href="/Camagru/index.php">
			<h1>
				Camagru
			</h1>
		</a>
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
