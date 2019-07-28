<?php
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Αίθουσα {0} | {1}', h($classroom->name), h($this->User->fullName($user))));
?>
<h3 class="text-xs-center"><?= __('Αίθουσα {0}', h($classroom->name)) ?></h3>
<h5 class="text-xs-center"><?= h($this->ClassroomType->translate($classroom->type)) ?></h5>
<div class="row mt-1">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Επεξεργασία Αίθουσας'), ['action' => 'edit', $classroom->id], ['class'=>'list-group-item list-group-item-action']) ?> 
            <?= $this->Form->postLink(__('Διαγραφή Αίθουσας'), ['action' => 'delete', $classroom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classroom->id), 'class'=>'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Προβολή Αιθουσών'), ['action' => 'index'], ['class'=>'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Δημιουργία Νέας Αίθουσας'), ['action' => 'add'], ['class'=>'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Προβολή Προγραμμάτων'), ['controller' => 'Schedules', 'action' => 'index'], ['class'=>'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Νέα Καταχώρηση Προγράμματος'), ['controller' => 'Schedules', 'action' => 'add'], ['class'=>'list-group-item list-group-item-action']) ?> 
        </div>
    </div>
    <div class="col-lg-9">
        <div class="related">
            <h4 class="text-xs-center mt-1"><?= __('Συσχετιζόμενα Μαθήματα') ?></h4>
            <?php if (!empty($classroom->schedules)): ?>
                <div class="table-responsive mt-1">
                    <table class="table table-striped table-bordered main-table">
                        <tr>
                            <th><?= __('Μάθημα') ?></th>
                            <th><?= __('Μέρα') ?></th>
                            <th><?= __('Ώρα Έναρξης') ?></th>
                            <th><?= __('Ώρα Λήξης') ?></th>
                            <th><?= __('Καθηγητής') ?></th>
                            <th class="actions"><?= __('Δράσεις') ?></th>
                        </tr>
                        <?php foreach ($classroom->schedules as $schedules): ?>
                            <tr>
                                <td><?= $this->Html->link($schedules->courses_semester->course->title, ['controller' => 'Courses', 'action' => 'view', $schedules->courses_semester->course->code]) ?></td>
                                <td><?= h($this->Day->translateFromInt($schedules->day)) ?></td>
                                <td class="text-xs-center"><?= $this->Time->format($schedules->hour_start, 'HH:mm') ?></td>
                                <td class="text-xs-center"><?= $this->Time->format($schedules->hour_end, 'HH:mm') ?></td>
                                <td><?= $this->Html->link($this->User->fullName($schedules->professor->user), ['controller' => 'Professors', 'action' => 'profile', $schedules->professor->user->identifier]) ?></td>
                                <td class="actions text-xs-center">
                                    <?= $this->Html->link(__('Προβολή'), ['controller' => 'Schedules', 'action' => 'view', $schedules->id]) ?>
                                    <?= $this->Html->link(__('Επεξεργασία'), ['controller' => 'Schedules', 'action' => 'edit', $schedules->id]) ?>
                                    <?= $this->Form->postLink(__('Διαγραφή'), ['controller' => 'Schedules', 'action' => 'delete', $schedules->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schedules->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
            <?php if (!empty($courseSemesterClassrooms)): ?>

                <h4 class="text-xs-center mt-1"><?= __('Χρήσεις αίθουσας') ?></h4>

                <div class="table-responsive mt-1">
                    <table class="table table-striped table-bordered main-table">
                        <tr>
                            <th><?= __('Μάθημα') ?></th>
                            <th><?= __('Εξάμηνο') ?></th>
                        </tr>
                        <?php foreach($courseSemesterClassrooms as $c): ?>
                            <tr>
                                <?php
                                $currentCourse = $c->courses_semester->course;
                                $currentSemester = $c->courses_semester->semester;
                                ?>
                                <td> <?= $this->Html->link($currentCourse->title, ['controller' => 'Courses', 'action' => 'view', $currentCourse->code]) ?></td>
                                <td class="text-xs-center"> <?= $this->Html->link($currentSemester->era, ['controller' => 'Semesters', 'action' => 'view', $currentSemester->id]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>