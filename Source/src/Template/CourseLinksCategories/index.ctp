<?php
$this->extend(isset($user) ? '/' . $this->UserRole->pluralCamel($user) . '/common' : '/Courses/common');

$this->Title->set(__('Κατηγορίες Συνδέσμων | {0}', h($this->User->fullName($user))));
?>
<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Προσθήκη Νέας Κατηγορίας Συνδέσμων'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?>
        </div>
    </div>
    <div class="col-lg-9">
        <h3><?= __('Κατηγορίες Συνδέσμων') ?></h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered main-table">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('Κωδικός') ?></th>
                        <th><?= $this->Paginator->sort('Τίτλος') ?></th>
                        <th class="actions"><?= __('Ενέργειες') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courseLinksCategories as $courseLinksCategory): ?>
                        <tr>
                            <td class="text-xs-center"><?= $this->Number->format($courseLinksCategory->id) ?></td>
                            <td class="text-xs-center"><?= h($courseLinksCategory->category) ?></td>
                            <td class="actions text-xs-center">
                                <?= $this->Html->link(__('Προβολή'), ['action' => 'view', $courseLinksCategory->id]) ?>
                                <?= $this->Html->link(__('Επεξεργασία'), ['action' => 'edit', $courseLinksCategory->id]) ?>
                                <?= $this->Form->postLink(__('Διαγραφή'), ['action' => 'delete', $courseLinksCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseLinksCategory->id)]) ?>
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