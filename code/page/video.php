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
		<div id="no_camera_div">
			<div>
				<label class="no_camera_text" for="fileToUpload">
					No Camera detected. Upload a file instead :</label>
				<input type="file" id="fileToUpload"/>
				<p class="error"><?php echo $error;?></p>
			</div>
		</div>
	</div>
	<div class="button_box">
		<button id="ouistiti" class="ouistiti disabled" disabled="disabled">Select a picture!</button>
	</div>
	<canvas id="canvas" class="camera_stream" style="display: none"></canvas>
	<script src="./js/camera.js"></script>
</div>
<div class="picture_options_box">
	<div id="picture_to_add_box">
		<img id="lol.png" class="picture_to_add" src="/files/lol.png" alt="" name="lol">
		<img id="overwatch.png" class="picture_to_add" src="/files/overwatch.png" alt="" name="overwatch">
		<img id="hearthstone.png" class="picture_to_add" src="/files/hearthstone.png" alt="" name="hearthstone">
		<img id="rleague.png" class="picture_to_add" src="/files/rleague.png" alt="" name="rleague">
		<img id="wow.png" class="picture_to_add" src="/files/wow.png" alt="" name="wow">
		<img id="aoe2.png" class="picture_to_add" src="/files/aoe2.png" alt="" name="aoe2">
		<img id="assassin.png" class="picture_to_add" src="/files/assassin.png" alt="" name="assassin">
		<img id="cod.png" class="picture_to_add" src="/files/cod.png" alt="" name="cod">
	</div>
</div>
