<?php
	// every user will have this in the body's class
	if(empty($this->fetch('body-class'))) {
		$this->assign('body-class', 'admin user');
	}
?>

<?= $this->element('Sidebar/admin', ['open' => $this->fetch('sidebar') ? false : true]) ?>

<!-- the user menu on the top right -->
<?= $this->element('Admin/menu') ?>

<!-- the content of the page -->
<?= $this->fetch('content') ?>