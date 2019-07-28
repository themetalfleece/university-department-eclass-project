<?php
use Cake\Core\Configure;

$this->extend('/Students/common');

$this->Title->set(__('Αρχική | {0}', h($this->User->fullName($user))));
$this->assign('body-class', 'user home');

$this->Html->script('user/home', ['block' => 'bottomScript']);
?>

<div class="row lessons_header">
	<div class="col-xs-12 col-sm-8">
		<h2 class="top-header"><?= __('Τα μαθήματά μου ({0})', $this->Paginator->counter('{{count}}')) ?></h2>
	</div>
	<div class="col-xs-12 col-sm-4">
		<?= $this->element('General/courseSearch') ?>
	</div>
</div>

<?php if ($searchTerm === false && $this->Paginator->counter('{{count}}') === '0'): ?>
	<?= __('Δεν έχετε δηλώσει μαθήματα. Μπορείτε να δηλώσετε {0}.', $this->Html->link(__('εδώ'), ['controller' => 'Courses', 'action' => 'register'])) ?>

<?php else: ?>
	<?php if (!empty($searchTerm)): ?>
		<p><?= __ ('Αναζήτηση για {0}', '<b>' . h($searchTerm) . '</b>') ?></p>
	<?php endif; ?>
	<?php if ($this->Paginator->counter('{{pages}}') !== '1'): ?>

		<div class="paginator main-table-paginator">
			<ul class="pagination">
				<?= $this->Paginator->first('<<') ?>
				<?= $this->Paginator->prev('<') ?>
				<?= $this->Paginator->numbers() ?>
				<?= $this->Paginator->next('>') ?>
				<?= $this->Paginator->last('>>') ?>
			</ul></div>
		<?php endif; ?>
		<div class="table-responsive">
			<table class="table table-bordered table-striped main-table" id="user-lessons">
				<thead>
					<tr>
						<th><?= $this->Paginator->sort('Courses.title', __('Μάθημα')) ?></th>
						<th><?= $this->Paginator->sort($courseStatusField, __('Κατάσταση')) ?></th>
						<th><?= $this->Paginator->sort('Courses.type', __('Τύπος')) ?></th>
						<th><?= $this->Paginator->sort('Courses.ects', __('ECTS')) ?></th>
						<th><?= $this->Paginator->sort('Courses.level', __('Επίπεδο')) ?></th>
						<th><?= $this->Paginator->sort('CoursesStudents.created', __('Ημερομηνία Εγγραφής')) ?></th>
						<th><?= __('Απεγγραφή') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($userCourses as $userCourse): ?>
						<?php if ($userCourse->status === 'attending'): ?>
							<tr class="lesson-attending">
							<?php elseif ($userCourse->status === 'registered'): ?>
								<tr class="lesson-registered">
								<?php else: ?>
									<tr class="lesson-passed">
									<?php endif; ?>
									<td><?= $this->Html->link($userCourse->course->title, ['controller' => 'Courses', 'action' => 'view', $userCourse->course->code]) ?><br></td>
									<td class="text-xs-center"><?= $this->Form->select('status', Configure::read('course.statusesTranslated'), ['default' => $userCourse->status, 'class' => 'form-control lesson-status', 'data-userlesson-id' => $userCourse->id]) ?></td>
									<td class="text-xs-center"><?= h($this->CourseType->translate($userCourse->course->type)) ?></td>
									<td class="text-xs-center"><?= $userCourse->course->ects ?></td>
									<td class="text-xs-center"><?= h($this->CourseLevel->translate($userCourse->course->level)) ?></td>
									<td class="text-xs-center"><?= $this->Time->format($userCourse->created, 'DD/MM/YY', null, $user['timezone']) ?></td>
									<td class="text-xs-center"><i class="fa fa-times remove-course" title="<?= __('Απεγγραφή από {0}', $userCourse->course->title) ?>" data-userlesson-id="<?= $userCourse->course->id ?>"></i></td>
									
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>


			<?php endif; ?>
