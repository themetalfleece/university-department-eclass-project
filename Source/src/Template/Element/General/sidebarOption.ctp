<?php
	$open = !empty($this->fetch($id . '-open'));
	$mobile = isset($mobile) ? $mobile : false;
?>
<div class="card-header" role="tab" id="<?= $mobile ? 'mobile-' : '' ?><?= $id ?>-heading">
	<a data-toggle="collapse" data-parent="#left-col-menu" href="#<?= $mobile ? 'mobile-' : '' ?><?= $id ?>">
		<i class="fa fa-chevron-<?= $open ? 'down' : 'right' ?>"></i> <?= h($header) ?>
	</a>
</div>

<div id="<?= $mobile ? 'mobile-' : '' ?><?= $id ?>" class="collapse <?= $open ? 'in ' : '' ?>main-menu" role="tabpanel">
	<div class="card-block">
		<ul class="list-group">
			<?= $optionList ?>
		</ul>
	</div>
</div>