<?php
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Λίστα Οδηγών Σπουδών | {0}', h($this->User->fullName($user))));
?>

<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Δημιουργία Νέου Οδηγού Σπουδών'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Εξαμήνων'), ['controller' => 'Semesters', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Δημιουργία Νέου Εξαμήνου'), ['controller' => 'Semesters', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Courses', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Courses', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <h3 class="text-xs-center text-sm-left mb-1"><?= __('Οδηγοί Σπουδών') ?></h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped main-table">
                <thead>
                    <tr>
                    <th><?= $this->Paginator->sort('Semesters.era', __('Περίοδος Εξαμήνου')) ?></th>
                        <th><?= $this->Paginator->sort('Semesters.date_start', __('Ημερομηνία Έναρξης')) ?></th>
                        <th><?= $this->Paginator->sort('Semesters.date_end', __('Ημερομηνία Λήξης')) ?></th>
                        <th><?= $this->Paginator->sort('level', __('Επίπεδο')) ?></th>
                        <th class="actions"><?= __('Ενέργειες') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($studyGuides as $studyGuide): ?>
                        <tr>
                            <td><?= $this->Html->link($studyGuide->semester->era, ['controller' => 'Semesters', 'action' => 'view', $studyGuide->semester->id]) ?></td>
                            <td class="text-xs-center"><?= $this->Time->format($studyGuide->semester->date_start, 'DD/MM/YY', null, $user['timezone']) ?></td>
                            <td class="text-xs-center"><?= $this->Time->format($studyGuide->semester->date_end, 'DD/MM/YY', null, $user['timezone']) ?></td>
                            <td class="text-xs-center"><?= h($this->CourseLevel->translate($studyGuide->level)) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Προβολή'), ['action' => 'view', $studyGuide->id]) ?>
                                <?= $this->Html->link(__('Επεξεργασία'), ['action' => 'edit', $studyGuide->id]) ?>
                                <?= $this->Form->postLink(__('Διαγραφή'), ['action' => 'delete', $studyGuide->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studyGuide->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator main-table-paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>