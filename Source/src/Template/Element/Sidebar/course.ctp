<?php
	$options = [
		'sidebar' => [
			'header' => __('Μάθημα'), 'optionList' => $this->element('Course/sidebarContent'), 'id' => 'course-choices'
		],
		'mobileSidebar' => [
			'mobile' => true, 'header' => __('Μάθημα'), 'optionList' => $this->element('Course/sidebarContent'), 'id' => 'course-choices'
		]
	];
?>

<?php if (isset($user) and $user): ?>
	<?php foreach ($options as $type => $option): ?>
		<?= $this->append($type) ?>
		<?= $this->element('General/sidebarOption', $option) ?>
		<?= $this->end($type) ?>
	<?php endforeach; ?>
<?php endif; ?>