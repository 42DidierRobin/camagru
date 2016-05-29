<?php
	require_once $_SERVER['DOCUMENT_ROOT']."/page/list_picture.php";
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/17/16
	 * Time: 5:57 PM
	 */ ?>

<div class="container anonym_main">
	<div class="main_box box">
		<?php
			$allPics = DAOPicture::getAllPicture();
			$nbPics = count($allPics);
			$nbPerPage = 8;
			$nbPage = floor($nbPics / $nbPerPage) + (($nbPics % $nbPerPage == 0) ? 0 : 1);
			if (!$nbPage)
				$nbPage = 1;

			if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
			{
				$listPics = array_slice($allPics, ($_GET['p'] - 1) * $nbPerPage, $nbPerPage);
				list_it($listPics);
			}
			else{
				header('location: ./index.php?p=1');
				exit(1);
			}

			echo '<div class=\"pagination\">';
			for ($p = 0; $p < $nbPage ; $p++)
			{
				echo '<a href="/index.php?p='.($p + 1).'" class="pagination"><div class=\'shadow page_box\'>'.($p + 1).'</div></a>';
			}
			echo '</div>'
		?>
	</div>

</div>
