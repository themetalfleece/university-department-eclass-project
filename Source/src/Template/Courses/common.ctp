<?php
	use Cake\Utility\Inflector;
?>

<?= $this->element('Sidebar/course') ?>

<?php if (isset($user) and $user): ?>
	<?= $this->extend('/' . Inflector::pluralize(Inflector::camelize($user['role'])) . '/common'); ?>
<?php else: ?>
	<?= $this->extend('/Common/pages'); ?>
<?php endif; ?>

<?= $this->fetch('content') ?>