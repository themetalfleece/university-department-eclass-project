<?php
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Δημιουργία Τομέα | {0}', h($this->User->fullName($user))));
?>

<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Προβολή Τομέων'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Courses', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Courses', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <?= $this->Form->create($sector, ['class' => 'form-group']) ?>
        <fieldset>
            <legend><?= __('Προσθήκη Τομέα') ?></legend>
            <?php
                echo $this->Form->label('sector', __('Τίτλος Τομέα'));
                echo $this->Form->input('sector', ['class'=>'form-control', 'label'=>false]);
            ?>
        </fieldset>
        <div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2 col-xs-12 mt-1">
            <?= $this->Form->button(__('Υποβολή'), ['class'=>'btn btn-success btn-block']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>