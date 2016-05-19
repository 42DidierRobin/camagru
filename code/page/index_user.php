<?php
	/**
	 * Created by PhpStorm.
	 * User: rdidier
	 * Date: 5/17/16
	 * Time: 6:23 PM
	 */ ?>

<div class="user_main container">
	<div class="main_box box">
		<div class="video_box">
			<div class="video_container">
				<video id="camera_stream" class="camera_stream" autoplay></video>
			</div>
			<div class="button_box">
				<button id="ouistiti" class="picture">Ouistiti</button>
			</div>
			<canvas id="canvas" class="camera_stream" style="display: none"></canvas>
			<script src="./js/camera.js"></script>
		</div>
		<div class="vertical_bar"></div>
		<div class="picture_box">
			
		</div>
	</div>
</div>
<div class="user_side container">
	<div class="side_box box">
		photo prises
	</div>
</div>
</body>