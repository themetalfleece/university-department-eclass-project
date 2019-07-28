<?php
if (isset($user)) {
	$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');
	$this->Title->set(__('Λίστα Μαθήμάτων | {0}', h($this->User->fullName($user))));	
} else {
	$this->extend('/Common/pages');

	$this->Title->set(__('Μαθήματα'));
}
$showActions = isset($user) and in_array($user['role'], ['admin', 'secretary']);
?>

<h2 class="text-xs-center mb-2"><?= __('Μαθήματα') ?></h2>

<?php if ($showActions): ?>
<div class="text-xs-center text-sm-left">
	<?= $this->Html->link(__('Προσθήκη Μαθήματος'), ['controller' => 'Courses', 'action' => 'add'], ['class'=>'btn btn-primary']) ?>
</div>
<?php endif; ?>

<div class="table-responsive mt-2">
	<table class="table table-striped table-bordered main-table">
		<thead>
			<tr>
				<th><?= $this->Paginator->sort('Courses.title', __('Τίτλος')) ?></th>
				<th><?= $this->Paginator->sort('Courses.code', __('Κωδικός')) ?></th>
				<th><?= __('Κατάσταση') ?></th>
				<th><?= $this->Paginator->sort('Courses.type', __('Τύπος')) ?></th>
<?php if ($showActions): ?>
				<th><?= __('Διαγραφή') ?></th>
<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($courses as $course): ?>
				<tr>
					<td><?= $this->Html->link($course->title, ['controller' => 'Courses', 'action' => 'view', $course->code]) ?></td>
					<td class="text-xs-center"><?= h($course->code) ?></td>
					<td>
						<?php if ($course->students_count == 0): ?>
							<?= __('0 εγγεγραμμένοι μαθητές') ?>
						<?php else: ?>
							<?= __('{0} εγγεγραμμένοι μαθητές / {1} παρακολουθούν', $course->students_count, $course->attending_students_count) ?>
						<?php endif ?>
					</td>
					<td><?= h($this->CourseType->translate($course->type)) ?></td>
<?php if ($showActions): ?>
					<td class="text-xs-center"> <?= $this->Html->link('<i class="fa fa-times remove-course"></i>', ['controller' => 'Courses', 'action' => 'delete', $course->code], ['confirm' => __('Είστε σίγουροι ότι θέλετε να διαγράψετε αυτό το μάθημα;'), 'escape'=>false]) ?></td>
<?php endif; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>