<?php
	require_once "./page/list_picture.php";
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/17/16
	 * Time: 5:57 PM
	 */ ?>

<div class="container anonym_main">
	<div class="main_box box">
		photo du site
		<?php
			$allPics = DAOPicture::getAllPicture();
			$nbPics = count($allPics);
			$nbPerPage = 21;
			$nbPage = floor($nbPics / $nbPerPage) + (($nbPics % $nbPerPage == 0) ? 0 : 1);
			echo $nbPage;

			if (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage)
			{
				$listPics = array_slice($allPics, $_GET['p'] * $nbPerPage, $nbPerPage);
				list_it($listPics);
			}
			else{
				list_it(array_slice($allPics, 0, $nbPerPage));
			}

			echo '<div class=\"pagination\">';
			for ($p = 0; $p < $nbPage ; $p++)
			{
				echo '<a href="/index.php?p='.$p.'" class="pagination">'.($p + 1).'</a>';
			}
			echo '</div>'
		?>
	</div>

</div>
