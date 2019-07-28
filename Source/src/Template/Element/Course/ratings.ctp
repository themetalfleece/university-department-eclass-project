<div class="text-xs-center">
	<div class="card">
		<div class="card-block">
			<h4 class="card-title"><?=__('Βαθμολογία: {0}', $this->Number->precision($avg, 2)) ?></h4>
			<p class="card-text">
				<?= $this->element('Course/starCreator', ['rating' => $avg]) ?>
			</p>
		</div>
	</div>

	<?php if (empty($userRating)): ?>
		<h3><?= __('Προσθήκη κριτικής') ?></h3>


		<?= $this->element('Course/starCreator', ['rating' => 0, 'selectable' => true]) ?>
		<?= $this->Form->create(null, ['url' => ['controller' => 'CourseSemesterReviews', 'action' => 'add'], 'class'=>'form-group']) ?>
		<?= $this->Form->hidden('course_semester_id', ['value' => $csId]) ?>
		<?= $this->Form->textarea('rating_text', ['class'=>'form-control']) ?>
		<?= $this->Form->hidden('rating_stars', ['id' => 'rating-stars']) ?>
		<div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2 col-xs-12 mt-1">
			<?= $this->Form->button(__('Υποβολή'), ['class'=>'btn btn-success btn-block']) ?>
		</div>
		<?= $this->Form->end() ?>
	<?php else: ?>
		<?php if ($userRating->approved): ?>
			<?= __('Η δική σας κριτική ήταν {0} αστέρια:', $userRating->rating_stars) ?>

			<div class="card text-xs-center pt-1">
				<?= $this->element('Course/starCreator', ['rating' => $userRating->rating_stars]) ?>
				<p>
					<?= h($userRating->rating_text) ?>			
				</p>
			</div>
		<?php else: ?>
			<?= __('Έχετε κάνει κριτική στο μάθημα αλλά αναμένει έγκριση') ?><br>
		<?php endif ?>
	<?php endif ?>

	Κριτικές:
	<?php foreach ($ratings as $rating): ?>
		<div class="card pt-1">
			<?= $this->element('Course/starCreator', ['rating' => $rating->rating_stars]) ?>
			<p>
				<?= h($rating->rating_text) ?>			
			</p>
		</div>
	<?php endforeach ?>
</div>