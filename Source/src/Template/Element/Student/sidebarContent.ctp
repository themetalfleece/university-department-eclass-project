<?php $this->Class->setRecordAddedCount(true); ?>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'students.home') ?>"><a href="/"><i class="fa fa-graduation-cap"></i> <?= __('Τα μαθήματά μου') ?></a></li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'courses.register') ?>">
	<?= $this->Html->link(__('{0} Εγγραφή σε μαθήματα', '<i class="fa fa-pencil"></i>'), ['controller' => 'Courses', 'action' => 'register'], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'schedules.student') ?>">
	<?= $this->Html->link(__('{0} Το πρόγραμμά μου', '<i class="fa fa-list-ol"></i>'), ['controller' => 'Schedules', 'action' => 'student'], ['escape' => false]) ?>
</li>

<li class="list-group-item"><a href="#"><i class="fa fa-book"></i> <?= __('Εγχειρίδια') ?></a></li>

<?php $addedCount = $this->Class->getRecordedCount(); ?>
<?php $this->Class->setRecordAddedCount(false); ?>

<?php $this->assign('user-choices-open', $addedCount) ?>