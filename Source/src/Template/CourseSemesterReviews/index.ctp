<?php
$this->extend('/Courses/common');

$this->Title->set(__('Κριτικές μαθήματος {0}', h($course->title)));

$this->Html->script('ratings/view', ['block' => 'bottomScript']);

$hasSemester = (array_key_exists('count', $courseSemesterReviews) and $courseSemesterReviews['count'] === 0 or $latestSemester);

if ($hasSemester) {
		// get the semesters first
	$semesters = [];
	foreach($courseSemesterReviews as $index => $csr) {
		$semesters[$index] = $csr[0]->courses_semester->semester->era;
	}

	if (!array_key_exists($latestSemester->id, $semesters)) {
		$semesters[$latestSemester->id] = $latestSemester->era;
	}

	$maxSemesterId = max(array_keys($semesters));
}

?>

<h3 class="text-xs-center mb-1"><?= __('Κριτικές Μαθήματος {0}', $course->title) ?></h3>
<div class="row">
	<div class="col-xs-12 col-md-5 offset-md-6 text-xs-center mb-1">
		<?php if ($hasSemester): ?>
			<?= $this->Form->label('semester', __('Εξάμηνο')) ?>
			<?= $this->Form->select('semester', $semesters, ['default' => $maxSemesterId, 'id' => 'semester', 'data-course-id ' => $course->id, 'class'=>'form-control']) ?>
		<?php else: ?>
			<?= __('Δεν έχει γίνει εγγραφή του μαθήματος σε κάποιο εξάμηνο') ?>
		<?php endif; ?>
	</div>
	
</div>
<div id="ratings-container" class="col-xs-12">
</div>