<?php $this->Class->setRecordAddedCount(true); ?>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'pages.display.home') ?>"><a href="/"><i class="fa fa-home"></i> <?= __('Αρχική') ?></a></li>
<li class="list-group-item<?= $this->Class->addIfAction('active', 'users.register') ?>"><a href="/users/register"><i class="fa fa-pencil"></i> <?= __('Εγγραφή') ?></a></li>
<li class="list-group-item<?= $this->Class->addIfAction('active', 'courses.index') ?>""><a href="/courses/index"><i class="fa fa-graduation-cap"></i> <?= __('Μαθήματα') ?></a></li>
<li class="list-group-item<?= $this->Class->addIfAction('active', 'professors.index') ?>""><a href="/professors/index"><i class="fa fa-user"></i> <?= __('Καθηγητές') ?></a></li>
<li class="list-group-item"><a href="#"><i class="fa fa-user"></i> <?= __('Εγχειρίδια') ?></a></li>

<?php $addedCount = $this->Class->getRecordedCount(); ?>
<?php $this->Class->setRecordAddedCount(false); ?>

<?php $this->assign('general-choices-open', $addedCount) ?>