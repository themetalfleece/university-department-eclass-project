<?php
    
    // todo extend the appropriate view here
    $this->extend('/Courses/common');
    // $this->extend(isset($user) ? '/' . $this->UserRole->pluralCamel($user) . '/common' : '/Courses/common');

    $this->Title->set(h($course->title) . ' ' . h($course->code));
?>

<?php if ($announcements->count() === 0): ?>
	<?= __('Δεν υπάρχουν ανακοινώσεις για το μάθημα "{0}"', h($course->title)) ?>
<?php else: ?>
	<h1><?= __('{0} - Ανακοινώσεις', h($course->title)) ?></h1>
	<?php foreach($announcements as $announcement): ?>
		<?= $this->Time->format($announcement->created, 'DD/MM/YY', null, $user['timezone']) ?> <?= h($announcement->text) ?>
	<?php endforeach; ?>
<?php endif; ?>