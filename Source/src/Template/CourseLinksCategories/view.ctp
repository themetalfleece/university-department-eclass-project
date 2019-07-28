<?php
$this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

$this->Title->set(__('Προβολή Κατηγορίας Συνδέσμων | {0}', h($this->User->fullName($user))));
?>


<div class="row">
    <div class="col-lg-3 mb-1" id="actions-sidebar">
        <div class="list-group">
            <h5 class="text-xs-center"><?= __('Ενέργειες') ?></h5>
            <?= $this->Html->link(__('Επεξεργασία Κατηγορίας Συνδέσμων'), ['action' => 'edit', $courseLinksCategory->id], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Form->postLink(__('Διαγραφή Κατηγορίας Συνδέσμων'), ['action' => 'delete', $courseLinksCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseLinksCategory->id), 'class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Προβολή Κατηγοριών Συνδέσμων'), ['action' => 'index'], ['class' => 'list-group-item list-group-item-action']) ?> 
            <?= $this->Html->link(__('Προσθήκη Νέας Κατηγορίας Συνδέσμων'), ['action' => 'add'], ['class' => 'list-group-item list-group-item-action']) ?> 
        </div>
    </div>
    <div class="col-lg-9">
        <h3 class="text-xs-center"><?= __("Κατηγορία Συνδέσμων: {0}", $courseLinksCategory->category) ?></h3>
        <h5><b><?= __("Κωδικός Κατηγορίας Συνδέσμων: {0}", $courseLinksCategory->id) ?></h5>
        <div class="related">
        <h4><?= __('Συσχετιζόμενοι Σύνδεσμοι Μαθημάτων') ?></h4>
            <?php if (!empty($courseLinksCategory->course_links)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered main-table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Course Links Category Id') ?></th>
                            <th><?= __('Course Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Url') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($courseLinksCategory->course_links as $courseLinks): ?>
                            <tr>
                                <td><?= h($courseLinks->id) ?></td>
                                <td><?= h($courseLinks->course_links_category_id) ?></td>
                                <td><?= h($courseLinks->course_id) ?></td>
                                <td><?= h($courseLinks->title) ?></td>
                                <td><?= h($courseLinks->url) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'CourseLinks', 'action' => 'view', $courseLinks->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'CourseLinks', 'action' => 'edit', $courseLinks->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CourseLinks', 'action' => 'delete', $courseLinks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseLinks->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>