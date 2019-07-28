<?php
use Cake\Core\Configure;

$this->extend('/Professors/common');

$this->Title->set(__('Οι μαθητές μου | {0}', h($this->User->fullName($user))));
$this->assign('body-class', 'user professor');

$this->Html->script('professor/students.js', ['block' => 'bottomScript']);
?>

<?= __('Κάντε κλικ πάνω σε κάποιον μαθητή σας για να δείτε ποια μαθήματά σας έχει') ?>

<br>
<div class="table-responsive mt-1">
	<table class="table table-bordered table-striped main-table">
		<thead>
			<tr>
				<th><?= $this->Paginator->sort('user', __('Ονοματεπώνυμο')) ?></th>
				<th><?= $this->Paginator->sort('AM', __('ΑΜ')) ?></th>
				<th><?= $this->Paginator->sort('level', __('Επίπεδο')) ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($students as $student): ?>
				<tr>
					<td>
						<?= $this->Html->link($this->User->fullName($student->user), '#', ['class' => 'student-with-courses', 'data-id' => $student->id]) ?>
					</td>
					<td class="text-xs-center">
						<?= $student->AM ?>
					</td>
					<td class="text-xs-center">
						<?= $this->StudentLevel->translate($student->level) ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<div class="modal fade" id="user-courses-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="user-courses-modal-header"></h5>
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body" id="user-courses-modal-body">
				<div id="user-courses-modal-content">
				</div>
				<div id="user-courses-modal-loading">
					<?= $this->Html->image('loading.gif', ['class' => 'img-fluid']) ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('Κλείσιμο') ?></button>
			</div>
		</div>
	</div>
</div>