<?php
use Cake\Core\Configure;

$this->extend('/Professors/common');

$this->Title->set(__('Εγγραφή καθηγητή σε μαθήματα | {0}', h($this->User->fullName($user))));
$this->assign('body-class', 'user professor');

$this->Html->script('professor/register', ['block' => 'bottomScript']);
?>

<h3 class="text-xs-center"> Εγγραφή σε Μαθήματα για το τρέχον εξάμηνο </h3>

<?php if (!$latestCs): ?>
	<h5><?= __('Δεν υπάρχουν μαθήματα στο τελευταίο εξάμηνο') ?></h5>
<?php else: ?>
	<div class="table-responsive mt-2">
		<table class="table table-striped table-bordered main-table">
			<thead>
				<tr>
					<th>
						Εγγεγραμένος
					</th>
					<th>
						Τίτλος
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($latestCs as $cs): ?>

					<tr>
					<td class="text-xs-center">
							<?= $this->Form->checkbox('registered', ['checked' => empty($cs->course_semester_professors) ? '0' : 'checked', 'class' => 'professor-register', 'data-cs-id' => $cs->id]) ?>
						</td>
						<td>
							<?= $this->Html->link($cs->course->title, ['controller' => 'Courses', 'action' => 'view', $cs->course->code]) ?>
						</td>
					</tr>

				<?php endforeach; ?>
			</tbody>

		</div>
	</div>
<?php endif; ?>