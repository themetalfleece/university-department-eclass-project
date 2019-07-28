<?php
use Cake\Core\Configure;

$this->extend('/Secretaries/common');

$this->Title->set(__('Αρχική | {0}', h($this->User->fullName($user))));
$this->assign('body-class', 'user home');
?>
<h3 class="text-xs-center"><?= __('Στοιχεία Χρηστών - Επισκόπηση') ?></h3>
<div class="table-responsive">
	<table class="table table-bordered table-striped main-table">
		<tbody>
			<tr>
				<td>
					<?= $this->Html->link(__('Καθηγητές'), ['controller' => 'Professors', 'action' => 'index']) ?>
				</td>
			</tr>
			<tr>
				<td>
					<?= __('Υπάρχουν {0} καθηγητές, από τους οποίους οι {1} χρειάζονται επιβεβαίωση διαχειριστή', $professors['all'], $professors['unverified']) ?>	
				</td>
			</tr>
			<tr>
				<td>
					<?= $this->Html->link(__('Γραμματείς'), ['controller' => 'Secretaries', 'action' => 'index']) ?>
				</td>
			</tr>
			<tr>
				<td>
					<?= __('Υπάρχουν {0} γραμματείς, από τους οποίους οι {1} χρειάζονται επιβεβαίωση διαχειριστή', $secretaries['all'], $secretaries['unverified']) ?>	
				</td>
			</tr>
			<tr>
				<td>
					<?= $this->Html->link(__('Μαθητές'), ['controller' => 'Students', 'action' => 'index']) ?>
				</td>
			</tr>
			<tr>
				<td>
					<?= __('Υπάρχουν {0} εγγεγραμμένοι μαθητές', $students) ?>
				</td>
			</tr>
			<?php if ($ratingCount > 0): ?>
				<tr>
					<td>
						<b>
							<?= $this->Html->link(__('Υπάρχουν {0} κριτικές που χρειάζονται έγκριση', $ratingCount), ['controller' => 'CourseSemesterReviews', 'action' => 'approve']) ?>
						</b>
					</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>


