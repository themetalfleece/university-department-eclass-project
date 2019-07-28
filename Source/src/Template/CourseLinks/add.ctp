<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Course Links'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Course Links Categories'), ['controller' => 'CourseLinksCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Links Category'), ['controller' => 'CourseLinksCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="courseLinks form large-9 medium-8 columns content">
    <?= $this->Form->create($courseLink) ?>
    <fieldset>
        <legend><?= __('Add Course Link') ?></legend>
        <?php
            echo $this->Form->input('course_links_category_id', ['options' => $courseLinksCategories]);
            echo $this->Form->input('course_id', ['options' => $courses]);
            echo $this->Form->input('title');
            echo $this->Form->input('url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
