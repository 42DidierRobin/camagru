<?php
	//TODO: pagination des images
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
		<?php list_it(DAOPicture::getAllPicture()) ?>
	</div>
</div>
