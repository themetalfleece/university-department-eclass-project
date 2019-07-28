<?php $this->Class->setRecordAddedCount(true); ?>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'schedules.index') ?>">
	<?= $this->Html->link(__('{0} Πρόγραμμα', '<i class="fa fa-list-ol"></i>'), ['controller' => 'Schedules', 'action' => 'index'], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'semesters.index') ?>">
	<?= $this->Html->link(__('{0} Εξάμηνα', '<i class="fa fa-list-ol"></i>'), ['controller' => 'Semesters', 'action' => 'index'], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'studyGuides.index') ?>">
	<?= $this->Html->link(__('{0} Οδηγοί Σπουδών', '<i class="fa fa-long-arrow-right"></i>'), ['controller' => 'StudyGuides', 'action' => 'index'], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'classrooms.index') ?>">
	<?= $this->Html->link(__('{0} Αίθουσες', '<i class="fa fa-home"></i>'), ['controller' => 'Classrooms', 'action' => 'index'], ['escape' => false]) ?>
</li>

<?php $addedCount = $this->Class->getRecordedCount(); ?>
<?php $this->Class->setRecordAddedCount(false); ?>

<?php $this->assign('program-choices-open', $addedCount) ?>