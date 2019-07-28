<?php

    // todo extend the appropriate view here
$this->extend('/Schedules/common');
    // $this->extend(isset($user) ? '/' . $this->UserRole->pluralCamel($user) . '/common' : '/Courses/common');

$this->Title->set(__('Πρόγραμμα Εξαμήνων'));
?>

<h3 class="text-xs-center mb-1"><?= __('Πρόγραμμα Εξαμήνου') ?></h3>
<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Νέα Καταχώρηση στο Πρόγραμμα'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Αιθουσών'), ['controller' => 'Classrooms', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Δημιουργία Νέας Αίθουσας'), ['controller' => 'Classrooms', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Καθηγητών'), ['controller' => 'Professors', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέα Καταπάτηση Προγράμματος'), ['controller' => 'ScheduleOverrides', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Καταπατήσεων Προγράμματος'), ['controller' => 'ScheduleOverrides', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="table-responsive">
            <table class="table table-bordered table-striped main-table">
                <thead>
                    <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('classroom_id', __('Αίθουσα')) ?></th>
                        <th><?= $this->Paginator->sort('Semesters.era', __('Εξάμηνο')) ?></th>
                        <th><?= $this->Paginator->sort('Courses.title', __('Μάθημα')) ?></th>
                        <th><?= $this->Paginator->sort('day', __('Ημέρα')) ?></th>
                        <th><?= $this->Paginator->sort('hour_start', __('Ώρα έναρξης')) ?></th>
                        <th><?= $this->Paginator->sort('hour_end', __('Ώρα λήξης')) ?></th>
                        <th><?= $this->Paginator->sort('professor_id', __('Καθηγητής')) ?></th>
                        <th class="actions"><?= __('Ενέργειες') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedules as $schedule): ?>
                        <tr>
                            <td class="text-xs-center"><?= $this->Number->format($schedule->id) ?></td>
                            <td class="text-xs-center"><?= $schedule->has('classroom') ? $this->Html->link($schedule->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $schedule->classroom->id]) : '' ?></td>
                            <td class="text-xs-center"><?= $schedule->has('courses_semester') ? $this->Html->link($schedule->courses_semester->semester->era, ['controller' => 'Semesters', 'action' => 'view', $schedule->courses_semester->semester->id]) : '' ?></td>
                            <td><?= $schedule->has('courses_semester') ? $this->Html->link($schedule->courses_semester->course->title, ['controller' => 'Courses', 'action' => 'view', $schedule->courses_semester->course->code]) : '' ?></td>
                            <td class="text-xs-center"><?= $this->Day->translateFromInt($schedule->day) ?></td>
                            <td class="text-xs-center"><?= $this->Time->format($schedule->hour_start, 'HH:mm') ?></td>
                            <td class="text-xs-center"><?= $this->Time->format($schedule->hour_end, 'HH:mm') ?></td>
                            <td><?= $schedule->has('professor') ? $this->Html->link($this->User->fullName($schedule->professor->user), ['controller' => 'Professors', 'action' => 'profile', $schedule->professor->user->identifier]) : '' ?></td>
                            <td class="actions text-xs-center">
                                <?= $this->Html->link(__('Προβολή'), ['action' => 'view', $schedule->id]) ?>
                                <?= $this->Html->link(__('Επεξεργασία'), ['action' => 'edit', $schedule->id]) ?>
                                <?= $this->Form->postLink(__('Διαγραφή'), ['action' => 'delete', $schedule->id], ['confirm' => __('Είστε σίγουροι πώς θέλετενα διαγράψετε αυτή την ώρα; ({0} στις {1} με {2})', $this->Day->translateFromInt($schedule->day), $this->Time->format($schedule->hour_start, 'HH:mm'), $this->Time->format($schedule->hour_end, 'HH:mm'))]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator main-table-paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('Προηγούμενο')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Επόμενο') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>