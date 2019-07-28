<?php
use Cake\Core\Configure;
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Επεξεργασία αίθουσας {0} | {1}', h($classroom->name), h($this->User->fullName($user))));
?>

<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Προσθήκη Αίθουσας'), ['controller' => 'Classrooms', 'action' => 'add'], ['class'=>'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Αιθουσών'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Schedules', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Schedules', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <?= $this->Form->create($classroom, ['class' => 'form-group']) ?>
        <fieldset>
        <legend><?= __('Επεξεργασία Αίθουσας') ?></legend>
            <?= $this->Form->label('name', __('Όνομα Αίθουσας')); ?>
            <?= $this->Form->input('name', ['class'=>'form-control', 'label'=>false]) ?>
            <?= $this->Form->label('type', __('Τύπος')); ?>
            <?= $this->Form->select('type', Configure::read('classroom.typesTranslated'), ['default' => 'theater', 'class' => 'form-control', 'label'=>false])
            ?>
        </fieldset>
         <div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2 col-xs-12 mt-1">
            <?= $this->Form->button(__('Υποβολή'), ['class'=>'btn btn-success btn-block']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>