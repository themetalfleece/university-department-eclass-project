<?php
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Προβολή Τομέα | {0}', h($this->User->fullName($user))));
?>


<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Επεξεργασία Τομέα'), ['action' => 'edit', $sector->id], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Form->postLink(__('Διαγραφή Τομέα'), ['action' => 'delete', $sector->id], ['class' => 'list-group-item list-group-item-action'], ['confirm' => __('Are you sure you want to delete # {0}?', $sector->id)]) ?> 
            <?= $this->Html->link(__('Προβολή Τομέων'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Δημιουργία Νέου Τομέα'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Προβολή Μαθημάτων'), ['controller' => 'Courses', 'action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Νέο Μάθημα'), ['controller' => 'Courses', 'action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?> 
        </div>
    </div>
    <div class="col-lg-9">
        <h3 class="text-xs-center"><?= __("Τομέας: {0}", $sector->sector) ?></h3>

        <h5><b><?= __("Κωδικός τομέα: {0}", $sector->id) ?></h5>
        <div class="related mt-1">
        <h4><?= __('Συσχετιζόμενα Μαθήματα') ?></h4>
            <?php if (!empty($sector->courses)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered main-table">
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
                        <?php foreach ($sector->courses as $courses): ?>
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
                                    <?= $this->Html->link(__('Προβολή'), ['controller' => 'Courses', 'action' => 'view', $courses->code]) ?>
                                    <?= $this->Html->link(__('Επεξεργασία'), ['controller' => 'Courses', 'action' => 'edit', $courses->code]) ?>
                                    <?= $this->Form->postLink(__('Διαγραφή'), ['controller' => 'Courses', 'action' => 'delete', $courses->code], ['confirm' => __('Are you sure you want to delete # {0}?', $courses->code)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>