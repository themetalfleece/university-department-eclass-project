<?php
use Cake\Core\Configure;

$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Προσθήκη Οδηγού Σπουδών | {0}', h($this->User->fullName($user))));
?>

<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Προβολή Οδηγών Σπουδών'), ['controller' => 'StudyGuides', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Εξαμήνων'), ['controller' => 'Semesters', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Δημιουργία Νέου Εξαμήνου'), ['controller' => 'Semesters', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Courses', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Courses', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
<div class="col-lg-9">
            <?= $this->Form->create($studyGuide, ['class'=>'form-group']) ?>
            <fieldset>
                <h4><?= __('Επεξεργασία Οδηγού Σπουδών') ?></h4>
                <div class="row mb-1">
                    <div class="col-lg-6 col-sm-12">
                        <?= $this->Form->label('semester_id', __('Εξάμηνο')); ?>
                        <?= $this->Form->select('semester_id', $semesters, ['class'=>'form-control']); ?>
                    </div>                    
                    <div class="col-lg-6 col-sm-12">
                        <?= $this->Form->label('level', __('Επίπεδο')); ?>
                        <?= $this->Form->select('level', Configure::read('course.levelsTranslated'), ['default' => $studyGuide->level, 'class'=>'form-control']); ?>
                    </div>
                </div>

                <div class="mb-1">
                    <?= $this->Form->label('info', __('Πληροφορίες')); ?>
                    <?= $this->Form->input('info', ['class'=>'form-control', 'label'=>false]); ?>
                </div>
                <div class="mb-1">
                    <?= $this->Form->label('ruling', __('Κανονισμός')); ?>
                    <?= $this->Form->input('ruling', ['class'=>'form-control', 'label'=>false]); ?>
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
            <div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2 col-xs-12">
                <?= $this->Form->button(__('Υποβολή'), ['class'=>'btn btn-success btn-block']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
</div>