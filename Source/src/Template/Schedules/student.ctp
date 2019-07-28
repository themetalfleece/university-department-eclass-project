<?php
use Cake\Core\Configure;

    // todo extend the appropriate view here
$this->extend('/Schedules/common');
    // $this->extend(isset($user) ? '/' . $this->UserRole->pluralCamel($user) . '/common' : '/Courses/common');

$this->Title->set(__('Το Πρόγραμμά Μου '));
?>

<h3 class="text-xs-center mb-1"><?= __('Το πρόγραμμά μου') ?></h3>
<div class="table-responsive">
	<table class="table table-striped table-bordered main-table">
		<thead>
			<?php foreach(Configure::read('schedule.days') as $dayNum => $day): ?>
				<th>
					<?= $day ?>
				</th>
			<?php endforeach; ?>	
		</thead>
		<tbody>
			<?php while (!empty($schedules)): ?>
				<tr>
					<?php for ($i = 0; $i < 7; $i++): ?>
						<td class="text-xs-center">
							<?php foreach($schedules as $index => $schedule): ?>
								<?php if ($schedule->day === $i): ?>
									<?= $this->Html->link($schedule->courses_semester->course->title, ['controller' => 'Courses', 'action' => 'view', $schedule->courses_semester->course->code])?>
									<br>
									<?= $this->Time->format($schedule->hour_start, 'HH:mm') ?> - <?= $this->Time->format($schedule->hour_end, 'HH:mm') ?>
									<br>
									<?php echo $schedule->classroom->name ?>
									<?php unset($schedules[$index]); break; ?>
								<?php endif; ?>
							<?php endforeach ?>
						</td>
					<?php endfor; ?>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>