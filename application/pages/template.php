<?php $this->view('template/header'); ?>
<div class="row">
	<div class="col-sm-12">
		<?php $this->view($content,$data); ?>
	</div>
</div>	
<?php 	$this->view('template/footer'); ?>