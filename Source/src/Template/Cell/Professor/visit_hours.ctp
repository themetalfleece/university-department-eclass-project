<h3><?= __('Ώρες γραφείου') ?></h3>
<?php if (count($visitHours) === 0): ?>
	<p class="mt-3 text-xs-center"><?= __('Ο καθηγητής δεν έχει ορίσει ώρες γραφείου') ?></p>
<?php endif; ?>
<?php foreach ($visitHours as $day => $values): ?>
	<b><?= $this->Day->translateFromInt($day) ?></b>
	<br>
	<?php foreach ($values as $value): ?>
		<?= __('Από {0} έως {1}', $this->Time->format($value->hour_start, 'HH:mm'), $this->Time->format($value->hour_end, 'HH:mm')) ?>
		<br>
	<?php endforeach; ?>
<?php endforeach; ?>