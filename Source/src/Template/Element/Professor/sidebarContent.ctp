<?php $this->Class->setRecordAddedCount(true); ?>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'professors.home') ?>"><a href="/"><i class="fa fa-graduation-cap"></i> <?= __('Τα μαθήματά μου') ?></a></li>
<li class="list-group-item<?= $this->Class->addIfAction('active', 'professors.register') ?>">
	<?= $this->Html->link(__('{0} Εγγραφή σε μαθήματα', '<i class="fa fa-pencil"></i>'), ['controller' => 'Professors', 'action' => 'register'], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'professors.students') ?>">
	<?= $this->Html->link(__('{0} Οι μαθητές μου', '<i class="fa fa-user"></i>'), ['controller' => 'Professors', 'action' => 'students'], ['escape' => false]) ?>
</li>

<li class="list-group-item"><a href="#"><i class="fa fa-book"></i> <?= __('Εγχειρίδια') ?></a></li>

<?php $addedCount = $this->Class->getRecordedCount(); ?>
<?php $this->Class->setRecordAddedCount(false); ?>

<?php $this->assign('user-choices-open', $addedCount) ?>