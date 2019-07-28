<?php
use Cake\Core\Configure;

if (isset($user)) {
		// somebody's logged in
	$this->extend('/Students/common');
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

<br>

<div class="row text-xs-center">
	<div class="col-sm-6 text-sm-right col-xs-12 mb-1">
		<img class="rounded-circle img-fluid main-profile-picture" src="<?= $this->User->pictureUrl($profileUser->picture) ?>">
	</div>
	<div class="col-sm-6 text-sm-left col-xs-12 card">
		<div class="card-block"">
			<?= h($this->User->fullName($profileUser)) ?>
			<br>
			<b><?= __('Μαθητής') ?></b>
			<br>
			<b><?= __('AM: ') ?></b> <?= h($profileUser->students[0]->AM) ?>
			<br>
			<b><?= __('Επίπεδο: ') ?></b> <?= h($this->StudentLevel->translate($profileUser->students[0]->level)) ?>
			<br>
			<?= __('Μελός από {0}', $this->Time->format($profileUser->created, 'DD/MM/YY')) ?>
			<br>
			<?= $this->Html->link($profileUser->email, h('mailto:' . $profileUser->email)) ?>
			<br>
		</div>
	</div>
</div>
<br>

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