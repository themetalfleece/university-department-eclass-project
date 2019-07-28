<?php
	use Cake\Utility\Inflector;
?>

<?php if ($user): ?>
	<?= $this->extend('/' . Inflector::pluralize(Inflector::camelize($user['role'])) . '/common'); ?>
<?php endif; ?>

<?= $this->fetch('content') ?>