<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<?= $this->Html->css('bootstrap.min.css') ?>
	<?= $this->Html->css('fa/css/font-awesome.min') ?>

	<?= $this->Html->meta('icon') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<title>
		<?= $this->fetch('title') ?>
	</title>

	<?= $this->fetch('topScript') ?>
</head>
<body <?php if (!empty($this->fetch('body-class'))): ?>class="<?= $this->fetch('body-class') ?>"<?php endif; ?>>
	<?= $this->Flash->render() ?>
	<?= $this->Flash->render('auth') ?>
	<div class="container-fluid">
		
		<nav class="navbar navbar-fixed-top navbar-light bg-faded hidden-lg-up">
			<button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarResponsive"></button>
			<div class="collapse navbar-toggleable-md" id="navbarResponsive">
				<div id="mobile-left-col-menu" role="tablist">
					<div class="choices menu card">
						<?= $this->fetch('mobileSidebar') ?>
					</div>
				</div>
			</div>
		</nav>

		<div class="row up">
			<div class="col-lg-2 hidden-md-down left-col">
				<?= $this->Html->image('upatras-logo.png', ['class' => 'upatras', 'url' => '/', 'alt' => __('Αρχική Σελίδα'), 'title' => __('Αρχική Σελίδα')]) ?>

				<div id="left-col-menu" role="tablist">
					<div class="choices menu card">
						<?= $this->fetch('sidebar') ?>
					</div>
				</div>

			</div>
			<div class="col-lg-10 col-md-12 right-col">
				<?= $this->fetch('content') ?>
			</div>
		</div>
	</div>
	<?= $this->Html->script(['jquery.min.js', 'tether.min.js', 'bootstrap.min.js']) ?>
	<?= $this->Html->script('main') ?>
	<?= $this->fetch('bottomScript') ?>
</body>
</html>