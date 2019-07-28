<?php
	$options = [
		'sidebar' => [
			'header' => __('Επιλογές Χρήστη'), 'optionList' => $this->element('Pages/sidebarContent'), 'id' => 'general-choices'
		],
		'mobileSidebar' => [
			'mobile' => true, 'header' => __('Επιλογές Χρήστη'), 'optionList' => $this->element('Pages/sidebarContent'), 'id' => 'general-choices'
		]
	];
?>
<?php foreach ($options as $type => $option): ?>
	<?= $this->append($type) ?>
	<?= $this->element('General/sidebarOption', $option) ?>
	<?= $this->end($type) ?>
<?php endforeach; ?>