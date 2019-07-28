<?php
use Cake\Core\Configure;

$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Έγκριση κριτικών χρήστη | {0}', h($this->User->fullName($user))));
?>

<h3 class="text-xs-center"><?= __('Κριτικές προς Έγκριση') ?></h3>

<?php foreach($reviews as $review): ?>

	<div class="card">
		<div class="card-block">
			<h4 class="card-title"><?= __('{0}', h($review->courses_semester->course->title)) ?></h4>
			<p class="card-text">
				<?= $this->element('Course/starCreator', ['rating' => $review->rating_stars]) ?>
				<?= h($review->rating_text) ?>
			</p>
			<div class="text-xs-center">
				<?= $this->Form->postLink(__('Έγκριση'), ['controller' => 'CourseSemesterReviews', 'action' => 'approve', $review->id], ['class'=>'btn btn-success']) ?>
				<?= $this->Form->postLink(__('Διαγραφή'), ['controller' => 'CourseSemesterReviews', 'action' => 'delete', $review->id], ['class'=>'btn btn-danger']) ?>
			</div>
		</div>
	</div>

	
<?php endforeach; ?>