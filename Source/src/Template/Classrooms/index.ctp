<?php
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Αίθουσες διδασκαλίας | {0}', h($this->User->fullName($user))));
?>
<h3 class="text-xs-center"><?= __('Αίθουσες') ?></h3>
<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Προσθήκη Αίθουσας'), ['controller' => 'Classrooms', 'action' => 'add'], ['class'=>'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Schedules', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Schedules', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="table-responsive mt-1">
            <table class="table table-striped table-bordered main-table">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Όνομα') ?></th>
                        <th><?= $this->Paginator->sort('Τύπος') ?></th>
                        <th class="actions"><?= __('Ενέργειες') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($classrooms as $classroom): ?>
                        <tr>
                            <td><?= $this->Html->link($classroom->name, ['controller' => 'Classrooms', 'action' => 'view', $classroom->id]) ?></td>
                            <td class="text-xs-center"><?= h($this->ClassroomType->translate($classroom->type)) ?></td>
                            <td class="actions text-xs-center">
                                <?= $this->Html->link(__('Προβολή'), ['controller' => 'Classrooms', 'action' => 'view', $classroom->id]) ?>
                                <?= $this->Html->link(__('Επεξεργασία'), ['controller' => 'Classrooms', 'action' => 'edit', $classroom->id]) ?>
                                <?= $this->Form->postLink(__('Διαγραφή'), ['action' => 'delete', $classroom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classroom->id)]) ?>
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