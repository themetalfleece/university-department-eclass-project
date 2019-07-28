<?php
use Cake\Core\Configure;

$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Προσθήκη μαθήματος | {0}', h($this->User->fullName($user))));
?>

<h3 class="text-xs-center mb-1"><?= __('Προσθήκη Μαθήματος') ?></h3>
<div class="container">
    <?= $this->Form->create($course, ['class'=>'form-group']) ?>

    <?= $this->Form->label('title', __('Τίτλος:')) ?>
    <?= $this->Form->input('title', ['class'=>'form-control', 'label'=>false]) ?>

    <?= $this->Form->label('code', __('Κωδικός:')) ?>
    <?= $this->Form->input('code', ['class'=>'form-control', 'label'=>false]) ?>

    <?= $this->Form->label('description', __('Περιγραφή:')) ?>
    <?= $this->Form->input('description', ['class'=>'form-control', 'label'=>false]) ?>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?= $this->Form->label('ects', __('Ects:')) ?>
            <?= $this->Form->input('ects', ['class'=>'form-control', 'label'=>false]) ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?= $this->Form->label('semester', __('Εξάμηνο:')) ?>
            <?= $this->Form->input('semester', ['type' => 'number', 'value' => 1, 'min' => 1, 'max' => 10, 'class'=>'form-control', 'label'=>false]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?= $this->Form->label('type', __('Τύπος')) ?>
            <?= $this->Form->select('type', Configure::read('course.typesTranslated'), ['class'=>'form-control']) ?>
        </div>
        <div class="col-xs-12 col-md-6">
           <?= $this->Form->label('level', __('Επίπεδο')) ?>
           <?= $this->Form->select('level', Configure::read('course.levelsTranslated'), ['class'=>'form-control']) ?>
        </div>
    </div>


    <?= $this->Form->label('official_url', __('Έπίσημη ιστοσελίδα:')) ?>
    <?= $this->Form->input('official_url', ['class'=>'form-control', 'label'=>false]) ?>
    <?= $this->Form->label('eclass_url', __('Ιστοσελίδα eclass:')) ?>
    <?= $this->Form->input('eclass_url', ['class'=>'form-control', 'label'=>false]) ?>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?= $this->Form->label('exam_means', __('Τρόπος Εξέτασης:')) ?>
            <?= $this->Form->input('exam_means', ['class'=>'form-control', 'label'=>false]) ?>
        </div>
        <div class="col-xs-12 col-md-6">
         <?= $this->Form->label('gravity', __('Βαρύτητα:')) ?>
         <?= $this->Form->input('gravity', ['class'=>'form-control', 'label'=>false]) ?>
        </div>
    </div>
    

    

<?php
$sectorsWithIds = [];
foreach ($sectors as $sector) {
    $sectorsWithIds[$sector->id] = $sector->sector;
}
?>
<?= $this->Form->label('sector_id', __('Τομέας:')) ?>
<?= $this->Form->select('sector_id', $sectorsWithIds, ['class'=>'form-control']) ?> 
<br>

<div class="col-md-4 offset-md-4 col-sm-8 offset-sm-2 col-xs-12 mt-1">
    <?= $this->Form->button(__('Υποβολή'), ['class'=>'btn btn-success btn-block']) ?>
</div>
<?= $this->Form->end() ?>
</div>