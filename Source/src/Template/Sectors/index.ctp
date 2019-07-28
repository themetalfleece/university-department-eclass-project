<?php
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Λίστα Τομέων | {0}', h($this->User->fullName($user))));
?>

<h3 class="text-xs-center mb-1"><?= __('Τομείς') ?></h3>
<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Δημιουργία Νέου Τομέα'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Courses', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?>
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Courses', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="table-responsive">
            <table class="table table-bordered table-striped main-table">
                <thead>
                    <tr>
                    <th><?= $this->Paginator->sort('id', __('Κωδικός')) ?></th>
                        <th><?= $this->Paginator->sort('sector', __('Τομέας')) ?></th>
                        <th class="actions"><?= __('Ενέργειες') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sectors as $sector): ?>
                        <tr>
                            <td class="text-xs-center"><?= $this->Number->format($sector->id) ?></td>
                            <td><?= h($sector->sector) ?></td>
                            <td class="actions text-xs-center">
                                <?= $this->Html->link(__('Προβολή'), ['action' => 'view', $sector->id]) ?>
                                <?= $this->Html->link(__('Επεξεργασία'), ['action' => 'edit', $sector->id]) ?>
                                <?= $this->Form->postLink(__('Διαγραφή'), ['action' => 'delete', $sector->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sector->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator main-table-paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('Προηγύμενο')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('Επόμενο') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    </div>
</div>