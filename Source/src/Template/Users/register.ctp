<?php
    use Cake\Core\Configure;

    $this->extend('/Common/pages');

    $this->Title->set('Δημιουργία Λογαριασμού');

    $this->Html->script('https://www.google.com/recaptcha/api.js?hl=el', ['block' => 'topScript']);
    $this->Html->script('user/register', ['block' => 'bottomScript']);
?>
<div class="users form">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <?= $this->Form->create() ?>
            <legend><?= __('Παρακαλώ συμπληρώστε τα στοιχεία για την εγγραφή σας') ?></legend>

            <div class="form-group">
                <?= $this->Form->input('first_name', ['label' => __('Όνομα'), 'class' => 'form-control', 'placeholder' => __('Το πρώτο σας όνομα'), 'autofocus' => 'autofocus']) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->input('last_name', ['label' => __('Επίθετο'), 'class' => 'form-control', 'placeholder' => __('Το επίθετό σας')]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->input('email', ['label' => __('Email'), 'class' => 'form-control', 'placeholder' => __('Ο λογαριασμός ηλεκτρονικού ταχυδρομείου σας')]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->input('password', ['label' => __('Κωδικός'), 'class' => 'form-control', 'placeholder' => __('Επιλέξτε έναν δυνατό κωδικό')]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->label('role', __('Τύπος Χρήστη')) ?>
                <?= $this->Form->select('role', Configure::read('user.rolesTranslated'), ['default' => 'student', 'class' => 'form-control', 'id' => 'user-type']) ?>
            </div>

            <div class="form-group student-specific">
                <?= $this->Form->input('AM', ['label' => __('AM'), 'class' => 'form-control', 'type' => 'number', 'placeholder' => __('Αριθμός Μητρώου')]) ?>
            </div>

            <div class="form-group student-specific">
                <?= $this->Form->label('level', __('Βαθμίδα')) ?>
                <?= $this->Form->select('level', Configure::read('student.levelsTranslated'), ['default' => 'undergraduate', 'class' => 'form-control']) ?>
            </div>

            <div class="form-group professor-specific" style="display: none">
                <?= $this->Form->label('title', __('Τίτλος')) ?>
                <?= $this->Form->select('title', Configure::read('professor.titlesTranslated'), ['default' => 'professor', 'class' => 'form-control']) ?>
            </div>

            <div class="form-group">
                <?= $this->element('General/google-recaptcha') ?>
            </div>

            <?= $this->Form->button(__('Εγγραφή'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>