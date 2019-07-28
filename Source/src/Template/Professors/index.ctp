<?php
use Cake\Core\Configure;
if (isset($user)) {
    $this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

    $this->Title->set(__('Λίστα Καθηγητών | {0}', h($this->User->fullName($user))));

    $this->Html->script('user/confirm-by-other-user', ['block' => 'bottomScript']);    
} else {
    $this->extend('/Common/pages');

    $this->Title->set(__('Καθηγητές'));
}

$showExtraOptions = isset($user) and in_array($user['role'], ['admin', 'secretary']);

?>
<h3><?= __('Καθηγητές') ?></h3>
<div class="table-responsive mt-1">
    <table class="table table-striped table-bordered main-table">
        <thead>
            <tr>
                <th><?= __('Εικόνα') ?></th>
                <th><?= $this->Paginator->sort('User.last_name', __('Όνομα')) ?></th>
                <th><?= $this->Paginator->sort('title', __('Τίτλος')) ?></th>
                <th><?= $this->Paginator->sort('office_location', __('Τοποθεσία γραφείου')) ?></th>
<?php if ($showExtraOptions): ?>
                <th><?= $this->Paginator->sort('active', __('Ενεργός')) ?></th>
<?php endif; ?>
                <th><?= $this->Paginator->sort('User.email', __('Email')) ?></th>
<?php if ($showExtraOptions): ?>
                <th><?= $this->Paginator->sort('User.confirmed', __('Επιβεβαιωμένο email')) ?></th>
                <th><?= $this->Paginator->sort('User.user_confirmed', __('Επιβεβαιωμένος χρήστης')) ?></th>
<?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($professors as $professor): ?>
                <?php if (!$showExtraOptions and !$professor->user->user_confirmed) { continue; } ?>
                <tr>
                    <td class="text-xs-center"><img class="rounded-circle img-fluid mini-profile-picture" src="<?= $this->User->pictureUrl($professor->user->picture) ?>"></td>
                    <td><?= $this->Html->link($this->User->fullName($professor->user), ['controller' => 'Professors', 'action' => 'profile', $professor->user->identifier]) ?></td>
                    <td class="text-xs-center"><?= h($professor->title) ?></td>
                    <td><?= h($professor->office_location) ?></td>
<?php if ($showExtraOptions): ?>
                    <td class="text-xs-center"><?= $professor->active ? __('Ναι') : __('Όχι') ?></td>
<?php endif; ?>
                    <td><?= $this->Html->link($professor->user->email, h('mailto:' . $professor->user->email)) ?></td>
<?php if ($showExtraOptions): ?>
                    <td class="text-xs-center"><?= $professor->user->confirmed ? __('Ναι') : __('Όχι') ?></td>
                    <td class="text-xs-center"><?= $this->element('User/userConfirmed', ['confirmed' => $professor->user->user_confirmed, 'userId' => $professor->user->id]) ?></td>
<?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator main-table-paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('Προηγμούμενο')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Επόμενο') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
