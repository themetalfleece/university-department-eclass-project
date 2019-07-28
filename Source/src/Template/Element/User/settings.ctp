<?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'settings'], 'enctype' => 'multipart/form-data']) ?>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group profile-picture-container">
            <img id="profile-picture" class="rounded-circle img-fluid main-profile-picture" src="<?= $this->User->pictureUrl($user['picture']) ?>"><br>
            <?= $this->Form->button(__('Αλλαγή'), ['class' => 'btn btn-primary', 'id' => 'change-image', 'type' => 'button']) ?><span id="image-filename"></span>
            <?= $this->Form->input('image', ['label' => false, 'type' => 'file', 'class' => 'hidden-xs-up', 'id' => 'user-image-input', 'accept' => '.jpeg,.jpg,.png']) ?>
        </div>
    </div>
</div>
<hr>
<div class="row col-xs-12 text-xs-center mb-1">
    <h3><?= __('Επικοινωνία') ?></h3>
</div>

<!-- the template to use when adding new phones/emails and the user wants to remove them -->
<a href="#" class="remove" id="remove-entity-template"><?= __('Διαγραφή') ?></a>

<div class="row">
    <div class="col-lg-6 col-xs-12 mb-1">
        <h5 class="text-xs-center"><?= __('Τηλέφωνα') ?></h5>
        <ul id="phone-list" class="list-group">
            <?php $counter = 0; ?>
            <?php foreach($settingsUser->user_phones as $user_phone): ?>
                <li class="list-group-item justify-content-between">
                    <?= $this->Html->link($user_phone->phone, 'tel:' . h($user_phone->phone)) ?>
                    <a href="#" class="remove phone pull-right" data-id="<?= $user_phone->id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <?= $this->Form->input('user_phones.' . $counter . '.id', ['type' => 'hidden', 'value' => h($user_phone->id)]) ?>
                    <?= $this->Form->input('user_phones.' . $counter . '.phone', ['type' => 'hidden', 'value' => h($user_phone->phone)]) ?>
                </li>
                <?php $counter++; ?>
            <?php endforeach; ?>
        </ul>
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" id="add-phone-input" placeholder="<?= __('Νέο τηλέφωνο...') ?>">
                    <span class="input-group-btn">
                        <?= $this->Form->button(__('Προσθήκη'), ['class' => 'btn btn-primary', 'id' => 'add-phone', 'type' => 'button']) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12 mb-1">
        <h5 class="text-xs-center"><?= __('Emails') ?></h5>
        <ul id="email-list" class="list-group">
            <?php foreach($settingsUser->user_emails as $user_email): ?>
                <li class="list-group-item justify-content-between">
                    <?= $this->Html->link($user_email->email, 'mailto:' . h($user_email->email)) ?>
                    <a href="#" class="remove email pull-right" data-id="<?= $user_email->id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <?= $this->Form->input('user_emails.' . $counter . '.id', ['type' => 'hidden', 'value' => h($user_email->id)]) ?>
                    <?= $this->Form->input('user_emails.' . $counter . '.email', ['type' => 'hidden', 'value' => h($user_email->email)]) ?>
                </li>
            <?php endforeach; ?>
        <ul id="email-list">
<?php foreach($settingsUser->user_emails as $user_email): ?>
            <li>
                <?= $this->Html->link($user_email->email, 'mailto:' . h($user_email->email)) ?>
                <a href="#" class="remove email" data-id="<?= $user_email->id ?>"><?= __('Διαγραφή') ?></a>
                <?= $this->Form->input('user_emails.' . $counter . '.id', ['type' => 'hidden', 'value' => h($user_email->id)]) ?>
                <?= $this->Form->input('user_emails.' . $counter . '.email', ['type' => 'hidden', 'value' => h($user_email->email)]) ?>
            </li>
<?php endforeach; ?>
        </ul>
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="email" class="form-control" id="add-email-input" placeholder="<?= __('Νέο email...') ?>">
                    <span class="input-group-btn">
                        <?= $this->Form->button(__('Προσθήκη'), ['class' => 'btn btn-primary', 'id' => 'add-email', 'type' => 'button']) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-1">
    <div class="col-xs-12">
        <div class="form-group">
            <h5 class="text-xs-center m-0 p-0">
                <?= $this->Form->label('timezone', __('Ζώνη Ώρας')) ?>
            </h5>
            <?= $this->Form->select('timezone', array_combine(\DateTimeZone::listIdentifiers(), \DateTimeZone::listIdentifiers()), ['default' => $settingsUser['timezone'], 'class' => 'form-control']) ?>
        </div>
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2 col-xs-12">
        <?= $this->Form->button(__('Αποθήκευση'), ['class' => 'btn btn-success btn-lg btn-block']); ?>
    </div>
</div>

<?= $this->Form->end() ?>