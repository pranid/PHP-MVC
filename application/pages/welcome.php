<div class="container-fluid torty-image-browser">
	<div class="torty-brw brw-main">
		<img src="http://localhost/torty-gallery//gallery/SPG_009.jpg" class="img-responsive" alt="Torty image">
	</div>
	<div class="torty-brw brw-thumb-dock">
		<div class="thumb-dock-controll">
			<div class="torty-btn-group">
				<button type="button" id="prv-img" class="torty-btn"><span class="glyphicon glyphicon-fast-backward" aria-hidden="true"></span></button>
				<button type="button" id="nxt-img" class="torty-btn"><span class="glyphicon glyphicon-fast-forward" aria-hidden="true"></span></button>
				<button type="button" id="cls-img" class="torty-btn"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			</div>
		</div>
		<div class="thumb-dock-images">
			
		</div>
	</div>
</div>
<div class="col-sm-12" id="dock-yard">
	<?php foreach ($images as $key => $value): ?>
	<div class="torty-image-dock col-md-3 col-sm-6 col-xs-12">
		<img src="<?= $value; ?>" class="img-responsive img-thumbnail torty-img" alt="Torty image" height="478px">
	</div>
	<?php endforeach; ?>
</div>