<?php

$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Προσθήκη Εξαμήνου | {0}', h($this->User->fullName($user))));

$this->Html->script('general/copy-over-semester', ['block' => 'bottomScript']);
?>
<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Προβολή Εξαμήνων'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Οδηγών Σπουδών'), ['controller' => 'StudyGuides', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Δημιουργία Νέου Οδηγού Σπουδών'), ['controller' => 'StudyGuides', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Courses', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Courses', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <?= $this->Form->create($semester, ['class'=>'form-group']) ?>
        <fieldset>
           <h3 class="text-xs-center mb-1"><?=  __("Προσθήκη Νέου Εξαμήνου") ?></h3>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <?= $this->Form->label('date_start', __('Ημερομηνία Έναρξης')); ?>
                    <div class="row container">
                        <?= $this->Form->date('date_start', [
                            'year' => ['class'=>'form-control col-xs-3'],
                            'month' => ['class'=>'form-control col-xs-6'],
                            'day' => ['class'=>'form-control col-xs-3'],
                            ]); ?>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mb-1">
                        <?= $this->Form->label('date_end', __('Ημερομηνία Λήξης')); ?>
                        <div class="row container">
                            <?= $this->Form->date('date_end', [
                                'year' => ['class'=>'form-control col-xs-3'],
                                'month' => ['class'=>'form-control col-xs-6'],
                                'day' => ['class'=>'form-control col-xs-3'],
                                ]); ?>
                        </div>
                    </div>
                </div>
            <div class="row mb-1">
                <div class="col-xs-12">
                    <?= $this->Form->label('era', __('Περίοδος')); ?>
                    <?= $this->Form->control('era', ['class'=>'form-control']); ?>
                </div>
            </div>
            <?= $this->Form->label('courses._ids', __('Μαθήματα')); ?>
            <div class="card semester-lessons-container">
                <div class="content">
                    <div class="col-xs-12">
                        <?= $this->Form->select('courses._ids', $courses, ['class'=>'form-control', 'multiple' => 'checkbox']); ?>
                    </div>
                </div>
            </div>
        </fieldset>
        
        <div class="row">
            <div class="col-xs-12 col-sm-6 text-sm-right">
                <?= $this->Form->checkbox('copy_over') ?>
                <?= $this->Form->label('copy_over', __('Αντιγραφή στο καινούργιο εξάμηνο τα μαθήματα από το εξάμηνο')) ?>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= $this->Form->select('copy_semester_id', $pastSemesters, ['class'=>'form-control']) ?>
            </div>
        </div>
        <br>
        <div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2 col-xs-12">
            <?= $this->Form->button(__('Υποβολή'), ['class'=>'btn btn-success btn-block']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>