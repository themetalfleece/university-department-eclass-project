<h3><?= __('Ώρες γραφείου') ?></h3>

<?php foreach ($visitHours as $day => $values): ?>
	<?= $this->Day->translateFromInt($day) ?>
	<br>
	<?php foreach ($values as $value): ?>
		<?= __('Από {0} έως {1}', $this->Time->format($value->hour_start, 'HH:mm'), $this->Time->format($value->hour_end, 'HH:mm')) ?>
		<br>
	<?php endforeach; ?>
<?php endforeach; ?>