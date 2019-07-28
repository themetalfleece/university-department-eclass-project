<?php
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Προβολή Οδηγού Σπουδών | {0}', h($this->User->fullName($user))));
?>

<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Form->postLink(__('Διαγραφή Οδηγού Σπουδών'), ['action' => 'delete', $studyGuide->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studyGuide->id), 'class'=>'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Προβολή Οδηγών Σπουδών'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Δημιουργία Νέου Οδηγού Σπουδών'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Προβολή Εξαμήνων'), ['controller' => 'Semesters', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Δημιουργία Νέου Εξαμήνου'), ['controller' => 'Semesters', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Courses', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Courses', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?> 
        </div>
    </div>
    <div class="col-lg-9">
        <h3 class="text-xs-center mb-1"><?=  __('Προβολή Οδηγού Σπουδών με κωδικό {0}', $studyGuide->id) ?></h3>

        <div class="card">
            <div class="card-block">

                <b><?= __('Εξάμηνο: ') ?></b>
                <?= $studyGuide->has('semester') ? $this->Html->link($studyGuide->semester->era, ['controller' => 'Semesters', 'action' => 'view', $studyGuide->semester->id]) : '' ?>
                <br>
                <b><?= __('Επίπεδο: ') ?></b> <?= h($this->CourseLevel->translate($studyGuide->level)) ?>
            </div>
        </div>

        <h4><?= __('Πληροφορίες') ?></h4>
        <div class="card">
            <div class="card-block">
                <?= $this->Text->autoParagraph(h($studyGuide->info)); ?>
            </div>
        </div>

        <h4><?= __('Κανονισμός') ?></h4>
        <div class="card">
            <div class="card-block">
                <?= $this->Text->autoParagraph(h($studyGuide->ruling)); ?>
            </div>
        </div>

        <div class="related">
        <h4><?= __('Σχετικά Μαθήματα') ?></h4>
            <?php if (!empty($studyGuide->courses)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped main-table">
                        <tr>
                            <th><?= __('Κωδικός ΒΔ') ?></th>
                            <th><?= __('Τίτλος') ?></th>
                            <th><?= __('Κωδικός Μαθήματος') ?></th>
                            <th><?= __('Περιγραφή') ?></th>
                            <th><?= __('Τύπος') ?></th>
                            <th><?= __('Επίπεδο') ?></th>
                            <th><?= __('Εξάμηνο') ?></th>
                            <th><?= __('Ιστοσελίδα Μαθήματος') ?></th>
                            <th><?= __('Ιστοσελίδα eclass') ?></th>
                            <th><?= __('Ects') ?></th>
                            <th><?= __('Τρόπος Εξέτασης') ?></th>
                            <th><?= __('Βαρύτητα') ?></th>
                            <th><?= __('Τομέας') ?></th>
                            <th class="actions"><?= __('Ενέργειες') ?></th>
                        </tr>
                        <?php foreach ($studyGuide->courses as $courses): ?>
                            <tr>
                                <td class="text-xs-center"><?= h($courses->id) ?></td>
                                <td><?= h($courses->title) ?></td>
                                <td class="text-xs-center"><?= h($courses->code) ?></td>
                                <td><?= h($courses->description) ?></td>
                                <td class="text-xs-center"><?= h($this->CourseType->translate($courses->type)) ?></td>
                                <td class="text-xs-center"><?= h($this->CourseLevel->translate($courses->level)) ?></td>
                                <td class="text-xs-center"><?= h($courses->semester) ?></td>
                                <td><?= $this->Html->Link(h($courses->eclass_url), h($courses->official_url), ['target' => '_blank']) ?></td>
                                <td><?= $this->Html->Link(h($courses->eclass_url), h($courses->eclass_url), ['target' => '_blank']) ?></td>
                                <td class="text-xs-center"><?= h($courses->ects) ?></td>
                                <td class="text-xs-center"><?= h($this->ExamMeans->translate($courses->exam_means)) ?></td>
                                <td class="text-xs-center"><?= h($courses->gravity) ?></td>
                                <td class="text-xs-center"><?= h($courses->sector_id) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('Προβολή'), ['controller' => 'Courses', 'action' => 'view', $courses->id]) ?>
                                    <?= $this->Html->link(__('Επεξεργασία'), ['controller' => 'Courses', 'action' => 'edit', $courses->id]) ?>
                                    <?= $this->Form->postLink(__('Διαγραφή'), ['controller' => 'Courses', 'action' => 'delete', $courses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courses->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>