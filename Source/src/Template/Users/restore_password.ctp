<?php
    $this->Title->set(__('Ανάκτηση Κωδικού'));
?>
<div class="row">
    <div class="col-lg-8 col-md-12">
        <?= $this->Form->create() ?>
<?php if (isset($proceedToChange)): ?>
		<legend><?= __('Συμπληρώστε τον καινούργιο σας κωδικό:') ?></legend>

        <div class="form-group">
            <?= $this->Form->input('password', ['label' => __('Κωδικός'), 'class' => 'form-control', 'placeholder' => __('Ο καινούργιος σας κωδικός'), 'autofocus' => 'autofocus']) ?>
        </div>

        <?= $this->Form->hidden('restoreLink', ['value' => $restoreLink]) ?>

        <?= $this->Form->button(__('Αλλαγή Κωδικού'), ['class' => 'btn btn-primary']); ?>
<?php else: ?>
        <legend><?= __('Παρακαλώ συμπληρώστε το email σας για να σας αποστείλουμε το link ανάκτησης κωδικού') ?></legend>

        <div class="form-group">
            <?= $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control', 'placeholder' => __('Ο λογαριασμός ηλεκτρονικού ταχυδρομείου σας'), 'autofocus' => 'autofocus']) ?>
        </div>

        <?= $this->Form->button(__('Αποστολή email'), ['class' => 'btn btn-primary']); ?>
<?php endif; ?>
        <?= $this->Form->end() ?>
    </div>
</div>