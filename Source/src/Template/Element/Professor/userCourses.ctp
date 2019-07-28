<?php
	// this file renders the professor lessons that a specific student has taken
?>
<div class="table-responsive mt-1">
	<table class="table table-bordered table-striped main-table">
		<thead>
			<th> Τίτλος </th>
			<th> Κωδικός </th>
		</thead>
		<tbody>
			
			<?php foreach ($courses as $course): ?>
				<tr>
					<td>
						<?= $this->Html->link($course->title, ['controller' => 'Courses', 'action' => 'view', $course->code]) ?>
					</td>
					<td class="text-xs-center">
						<?= $course->code ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</tr>
</table>
</div>