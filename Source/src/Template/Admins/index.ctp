<?php
    use Cake\Core\Configure;

    $this->extend('/Admins/common');

    $this->Title->set(__('Λίστα Admins | {0}', h($this->User->fullName($user))));

    $this->Html->script('user/confirm-by-other-user', ['block' => 'bottomScript']);
?>
<div class="admins index large-9 medium-8 columns content">
    <h3><?= __('Professors') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= __('Εικόνα') ?></th>
                <th scope="col"><?= $this->Paginator->sort('User.last_name', __('Όνομα')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('User.email', __('Email')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('User.confirmed', __('Email επιβεβαιωμένο')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('User.user_confirmed', __('Χρήστης επιβεβαιωμένος')) ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
            <tr>
                <td><img src="<?= $this->User->pictureUrl($admin->picture) ?>"></td>
                <td><?= h($admin->last_name . ' ' . $admin->first_name) ?></td>
                <td><?= $this->Html->link($admin->email, h('mailto:' . $admin->email)) ?></td>
                <td><?= $admin->confirmed ? __('Ναι') : __('Όχι') ?></td>
                <td><?= $this->element('User/userConfirmed', ['confirmed' => $admin->user_confirmed, 'userId' => $admin->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
