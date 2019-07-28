<?php
if (!is_array($message) && (!isset($params['escape']) || $params['escape'] !== false)) {
    $message = h($message);
}
?>

<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
<?php if (is_array($message)): ?>
	<?= $message[0] ?>
	<?php array_shift($message); ?>
	<ul>
		<?php foreach($message as $subMsg): ?>
			<li><?= $subMsg ?></li>
		<?php endforeach ?>
	</ul>
<?php else: ?>
	<?= $message ?>
<?php endif; ?>
</div>