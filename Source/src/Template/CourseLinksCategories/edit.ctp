<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $courseLinksCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $courseLinksCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Course Links Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Course Links'), ['controller' => 'CourseLinks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Link'), ['controller' => 'CourseLinks', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="courseLinksCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($courseLinksCategory) ?>
    <fieldset>
        <legend><?= __('Edit Course Links Category') ?></legend>
        <?php
            echo $this->Form->input('category');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
