<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/26/16
	 * Time: 11:21 AM
	 */

?>
<div class="video_picture_box">
	<div class="video_picture_container">
		<video id="camera_stream" class="camera_stream" autoplay></video>
	</div>
	<div class="button_box">
		<button id="ouistiti" class="ouistiti disabled" disabled="disabled">Select a picture!</button>
	</div>
	<canvas id="canvas" class="camera_stream" style="display: none"></canvas>
	<script src="./js/camera.js"></script>
</div>
<div class="vertical_bar"></div>
<div class="picture_options_box">
	What do YOU play ?!
	<div id="picture_to_add_box">
			<img id="lol.png" class="picture_to_add" src="/Camagru/files/lol.png" alt="" name="lol">
			<img id="overwatch.png" class="picture_to_add" src="/Camagru/files/overwatch.png" alt="" name="overwatch">
			<img id="hearthstone.png" class="picture_to_add" src="/Camagru/files/hearthstone.png" alt="" name="hearthstone">
			<img id="rleague.png" class="picture_to_add" src="/Camagru/files/rleague.png" alt="" name="rleague">
			<img id="wow.png" class="picture_to_add" src="/Camagru/files/wow.png" alt="" name="wow">
			<img id="aoe2.png" class="picture_to_add" src="/Camagru/files/aoe2.png" alt="" name="aoe2">
			<img id="assassin.png" class="picture_to_add" src="/Camagru/files/assassin.png" alt="" name="assassin">
			<img id="cod.png" class="picture_to_add" src="/Camagru/files/cod.png" alt="" name="cod">
	</div>
</div>
