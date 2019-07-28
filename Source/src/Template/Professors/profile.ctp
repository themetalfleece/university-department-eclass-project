<?php
use Cake\Core\Configure;

if (isset($user)) {
	$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');
} else {
	$this->extend('/Common/pages');
}

$this->Title->set(__('Προφίλ Χρήστη | {0}', h($this->User->fullName($profileUser))));

$this->assign('body-class', 'user profile');

	// true if the user is watching their own profile
$profileSameAsLoggedIn = (isset($user) && $user['id'] === $profileUser->id);
?>

<?php if ($profileSameAsLoggedIn): ?>
	<h3 class="text-xs-center"><?= __('Το προφίλ σας') ?></h3>
<?php endif; ?>
<div class="row text-xs-center mt-1">
	<div class="text-xs-center col-xs-12 mb-1">
		<img class="rounded-circle img-fluid main-profile-picture" src="<?= $this->User->pictureUrl($profileUser->picture) ?>">
	</div>
</div>
<div class="row text-xs-center mt-1">

	<div class="col-sm-6 text-sm-left col-xs-12">
		<div class="container">
			<div class="card">
				<div class="card-block"">
					<?= h($this->User->fullName($profileUser)) ?>
					<br>
					<?= __('Καθηγητής') ?>
					<br>
					<?= $this->Html->link($profileUser->email, h('mailto:' . $profileUser->email)) ?>
					<br>
					<?= h($professor->office_location) ?>
					<hr>
					<p>
						<?= h($professor->bio) ?>
					</p>
				</div>

			</div>
		</div>
	</div>

	<div class="col-sm-6 text-sm-left col-xs-12">
		<div class="container">
			<div class="card">
				<div class="card-block"">
					<?= $this->cell('Professor::visitHours', [$profileUser->id]) ?>
				</div>
			</div>
		</div>
	</div>
</div>

		<div class="row">

	<?php if (!empty($profileUser->user_emails)): ?>
		<div class="col-xs-12 col-md-6 mb-1">
			<h6 class="text-xs-center"><?= __('Άλλα emails:') ?></h6>			
			<ul class="list-group">
				<?php foreach($profileUser->user_emails as $userEmail): ?>
					<li class="list-group-item">
						<?= $this->Html->link($userEmail->email, h('mailto:' . $userEmail->email)) ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if (!empty($profileUser->user_phones)): ?>
		<div class="col-xs-12 col-md-6 mb-1">
			<h6 class="text-xs-center"><?= __('Τηλέφωνα:') ?></h6>	
			<ul class="list-group">
				<?php foreach($profileUser->user_phones as $userPhone): ?>
					<li class="list-group-item">
						<?= $this->Html->link($userPhone->phone, h('tel:' . $userPhone->phone)) ?><br>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

</div>

