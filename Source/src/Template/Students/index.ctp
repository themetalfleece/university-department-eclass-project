<?php
use Cake\Core\Configure;

$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Λίστα Μαθητών | {0}', h($this->User->fullName($user))));
?>

<h3 class="text-xs-center"><?= __('Μαθητές') ?></h3>
<div class="table-responsive mt-1">
    <table class="table table-striped table-bordered main-table">
        <thead>
            <tr>
                <th><?= __('Εικόνα') ?></th>
                <th><?= $this->Paginator->sort('User.last_name', __('Όνομα')) ?></th>
                <th><?= $this->Paginator->sort('AM') ?></th>
                <th><?= $this->Paginator->sort('level', __('Επίπεδο')) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                     <td class="text-xs-center"><img class="rounded-circle img-fluid mini-profile-picture" src="<?= $this->User->pictureUrl($student->user->picture) ?>"></td>
                    <td><?= $this->Html->link($this->User->fullName($student->user), ['controller' => 'Students', 'action' => 'profile', $student->user->identifier]) ?></td>
                    <td class="text-xs-center"><?= $this->Number->format($student->AM) ?></td>
                    <td class="text-xs-center"><?= h($this->StudentLevel->translate($student->level)) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator main-table-paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('Προηγούμενο')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Επόμενο') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>