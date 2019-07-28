<?php
	$options = [
		'sidebar' => [
			'header' => __('Επιλογές Admin'), 'optionList' => $this->element('Admin/sidebarContent'), 'id' => 'user-choices'
		],
		'mobileSidebar' => [
			'mobile' => true, 'header' => __('Επιλογές Admin'), 'optionList' => $this->element('Admin/sidebarContent'), 'id' => 'user-choices'
		]
	];
?>
<?php foreach ($options as $type => $option): ?>
	<?= $this->append($type) ?>
	<?= $this->element('General/sidebarOption', $option) ?>
	<?= $this->end($type) ?>
<?php endforeach; ?>