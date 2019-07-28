<?php
	// every user will have this in the body's class
	if(empty($this->fetch('body-class'))) {
		$this->assign('body-class', 'user');
	}
?>

<?= $this->element('Sidebar/student', ['open' => $this->fetch('sidebar') ? false : true]) ?>

<!-- the user menu on the top right -->
<?= $this->element('Student/menu') ?>

<!-- the content of the page -->
<?= $this->fetch('content') ?>