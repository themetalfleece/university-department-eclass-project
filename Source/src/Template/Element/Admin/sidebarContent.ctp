<?php $this->Class->setRecordAddedCount(true); ?>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'admins.home') ?>"><a href="/"><i class="fa fa-user"></i> <?= __('Στοιχεία Χρηστών') ?></a></li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'professors.index') ?>">
	<?= $this->Html->link(__('{0} Καθηγητές', '<i class="fa fa-book"></i>'), ['controller' => 'Professors', 'action' => 'index'], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'secretaries.index') ?>">
	<?= $this->Html->link(__('{0} Γραμματείς', '<i class="fa fa-pencil"></i>'), ['controller' => 'Secretaries', 'action' => 'index'], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'students.index') ?>">
	<?= $this->Html->link(__('{0} Μαθητές', '<i class="fa fa-graduation-cap"></i>'), ['controller' => 'Students', 'action' => 'index'], ['escape' => false]) ?>
</li>

<?php $addedCount = $this->Class->getRecordedCount(); ?>
<?php $this->Class->setRecordAddedCount(false); ?>

<?php $this->assign('user-choices-open', $addedCount) ?>