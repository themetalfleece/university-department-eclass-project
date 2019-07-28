<?php
use Cake\Core\Configure;

    // todo extend the appropriate view here
$this->extend('/Schedules/common');
    // $this->extend(isset($user) ? '/' . $this->UserRole->pluralCamel($user) . '/common' : '/Courses/common');

$this->Title->set(__('Προβολή Ώρας'));
?>

<h3 class="text-xs-center mb-1"><?= __('Προβολή Ώρας του προγράμματος') ?></h3>

<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Επεξεργασία Καταχώρησης'), ['action' => 'edit', $schedule->id], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέα Καταχώρηση στο Πρόγραμμα'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Προγραμμάτων'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Αιθουσών'), ['controller' => 'Classrooms', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Δημιουργία Νέας Αίθουσας'), ['controller' => 'Classrooms', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Καθηγητών'), ['controller' => 'Professors', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέα Καταπάτηση Προγράμματος'), ['controller' => 'ScheduleOverrides', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Καταπατήσεων Προγράμματος'), ['controller' => 'ScheduleOverrides', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <h3><?= h($schedule->id) ?></h3>
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('Classroom') ?></th>
                <td><?= $schedule->has('classroom') ? $this->Html->link($schedule->classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $schedule->classroom->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Courses Semester') ?></th>
                <td><?= $schedule->has('courses_semester') ? $this->Html->link($schedule->courses_semester->id, ['controller' => 'CoursesSemesters', 'action' => 'view', $schedule->courses_semester->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Professor') ?></th>
                <td><?= $schedule->has('professor') ? $this->Html->link($schedule->professor->title, ['controller' => 'Professors', 'action' => 'view', $schedule->professor->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($schedule->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Day') ?></th>
                <td><?= $this->Number->format($schedule->day) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Hour') ?></th>
                <td><?= h($schedule->hour) ?></td>
            </tr>
        </table>
        <div class="related">
            <h4><?= __('Related Schedule Overrides') ?></h4>
            <?php if (!empty($schedule->schedule_overrides)): ?>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('Schedule Id') ?></th>
                        <th scope="col"><?= __('Hour') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($schedule->schedule_overrides as $scheduleOverrides): ?>
                        <tr>
                            <td><?= h($scheduleOverrides->id) ?></td>
                            <td><?= h($scheduleOverrides->schedule_id) ?></td>
                            <td><?= h($scheduleOverrides->hour) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ScheduleOverrides', 'action' => 'view', $scheduleOverrides->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ScheduleOverrides', 'action' => 'edit', $scheduleOverrides->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ScheduleOverrides', 'action' => 'delete', $scheduleOverrides->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scheduleOverrides->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>