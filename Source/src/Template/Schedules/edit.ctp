<?php
use Cake\Core\Configure;

    // todo extend the appropriate view here
$this->extend('/Schedules/common');
    // $this->extend(isset($user) ? '/' . $this->UserRole->pluralCamel($user) . '/common' : '/Courses/common');

$this->Title->set(__('Επεξεργασία Ώρας'));
?>

<h3 class="text-xs-center mb-1"><?= __('Επεξεργασία Ώρας του προγράμματος') ?></h3>

<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Νέα Καταχώρηση στο Πρόγραμμα'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Προγραμμάτων'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Αιθουσών'), ['controller' => 'Classrooms', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Δημιουργία Νέας Αίθουσας'), ['controller' => 'Classrooms', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Καθηγητών'), ['controller' => 'Professors', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέα Καταπάτηση Προγράμματος'), ['controller' => 'ScheduleOverrides', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Καταπατήσεων Προγράμματος'), ['controller' => 'ScheduleOverrides', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <?php
    $courseSemestersSelect = [];

    foreach($coursesSemesters as $cs) {
        $courseSemestersSelect[$cs->id] = $cs->course->title;
    }

    $professorsSelect = [];

    foreach($professors as $p) {
        $professorsSelect[$p->id] = $this->User->fullname($p->user);
    }
    ?>
    <div class="col-lg-9">
        <?= $this->Form->create($schedule, ['class'=>'form-group']) ?>
        <fieldset>
            <?= $this->Form->label('classroom_id', __('Αίθουσα:')) ?>
            <?= $this->Form->select('classroom_id', $classrooms, ['class'=>'form-control']) ?>
            <?= $this->Form->label('course_semester_id', __('Μαθήματα τρέχοντος εξαμήνου:')) ?>
            <?= $this->Form->select('course_semester_id', $courseSemestersSelect, ['class'=>'form-control']) ?>
            <?= $this->Form->label('day', __('Ημέρα της εβδομάδας:')) ?>
            <?= $this->Form->select('day', Configure::read('schedule.days'), ['class'=>'form-control']) ?>
            <div class="row">
                <div class="col-xs-12 col-md-4">
                <?= $this->Form->input('hour_start', ['label' => __('Ώρα έναρξης:'), 'hour' => ['class'=>'form-control'], 'minute' => ['class'=>'form-control']]) ?>
                </div>
                <div class="col-xs-12 col-md-4 offset-md-2">
                    <?= $this->Form->input('hour_end', ['label' => __('Ώρα λήξης:'), 'hour' => ['class'=>'form-control'], 'minute' => ['class'=>'form-control']]) ?>
                </div>
            </div>
            <?= $this->Form->label('professor_id', __('Καθηγητής:')) ?>
            <?= $this->Form->select('professor_id', $professorsSelect, ['class'=>'form-control']) ?>
            
        </fieldset>
        <div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2 col-xs-12 mt-1">
            <?= $this->Form->button(__('Υποβολή'), ['class'=>'btn btn-success btn-block']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
