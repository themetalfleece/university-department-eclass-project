<?php
use Cake\Core\Configure;

$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Λίστα Γραμματέων | {0}', h($this->User->fullName($user))));

$this->Html->script('user/confirm-by-other-user', ['block' => 'bottomScript']);
?>
<h3><?= __('Γραμματείς') ?></h3>
<div class="table-responsive mt-1">
    <table class="table table-striped table-bordered main-table">
        <thead>
            <tr>
                <th><?= __('Εικόνα') ?></th>
                <th><?= $this->Paginator->sort('User.last_name', __('Όνομα')) ?></th>
                <th><?= $this->Paginator->sort('User.email', __('Email')) ?></th>
                <th><?= $this->Paginator->sort('User.confirmed', __('Επιβεβαιωμένο email')) ?></th>
                <th><?= $this->Paginator->sort('User.user_confirmed', __('Επιβεβαιωμένος χρήστης')) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($secretaries as $secretary): ?>
                <tr>
                    <td class="text-xs-center"> <img class="rounded-circle img-fluid mini-profile-picture" src="<?=  $this->User->pictureUrl($secretary->picture) ?>"> </td>
                    <td><?= $this->Html->link($secretary->last_name . ' ' . $secretary->first_name, ['controller' => 'Secretary', 'action' => 'profile', '']) ?></td>
                    <td><?= $this->Html->link($secretary->email, h('mailto:' . $secretary->email)) ?></td>
                    <td class="text-xs-center"><?= $secretary->confirmed ? __('Ναι') : __('Όχι') ?></td>
                    <td class="text-xs-center"><?= $this->element('User/userConfirmed', ['confirmed' => $secretary->user_confirmed, 'userId' => $secretary->id]) ?></td>
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
