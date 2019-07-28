<?php
	$options = [
		'sidebar' => [
			[
				'header' => __('Επιλογές Χρήστη'), 'optionList' => $this->element('Secretary/sidebarContent'), 'id' => 'user-choices'
			],
			[
				'header' => __('Πρόγραμμα'), 'optionList' => $this->element('Secretary/programSidebarContent'), 'id' => 'program-choices'
			]
		],
		'mobileSidebar' => [
			[
				'mobile' => true, 'header' => __('Επιλογές Χρήστη'), 'optionList' => $this->element('Secretary/sidebarContent'), 'id' => 'user-choices'
			],
			[
				'mobile' => true, 'header' => __('Πρόγραμμα'), 'optionList' => $this->element('Secretary/programSidebarContent'), 'id' => 'program-choices'
			]
		],
	];
?>
<?php foreach ($options as $type => $optionGroup): ?>
	<?php foreach ($optionGroup as $option): ?>
		<?= $this->append($type) ?>
		<?= $this->element('General/sidebarOption', $option) ?>
		<?= $this->end($type) ?>
	<?php endforeach; ?>
<?php endforeach; ?>