<?php
use Cake\Core\Configure;

$this->extend('/Professors/common');

$this->Title->set(__('Αρχική | {0}', h($this->User->fullName($user))));
$this->assign('body-class', 'user professor home');
?>

<h3><?= __('Τα μαθήματά μου') ?></h3>
<div class="row m-1">
		<div class="list-group">
			<?php foreach ($professorCourses as $professorCourse): ?>
				<?php $course = $professorCourse->courses_semester->course; ?>
				<?= $this->Html->link($course->title, ['controller' => 'Courses', 'action' => 'view', h($course->code)], ['class' => 'list-group-item list-group-item-action']) ?>
			<?php endforeach; ?>
		</div>
</div>