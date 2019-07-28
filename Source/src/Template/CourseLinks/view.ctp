<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Course Link'), ['action' => 'edit', $courseLink->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Course Link'), ['action' => 'delete', $courseLink->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseLink->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Course Links'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Link'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Links Categories'), ['controller' => 'CourseLinksCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Links Category'), ['controller' => 'CourseLinksCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['controller' => 'Courses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['controller' => 'Courses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="courseLinks view large-9 medium-8 columns content">
    <h3><?= h($courseLink->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Course Links Category') ?></th>
            <td><?= $courseLink->has('course_links_category') ? $this->Html->link($courseLink->course_links_category->id, ['controller' => 'CourseLinksCategories', 'action' => 'view', $courseLink->course_links_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course') ?></th>
            <td><?= $courseLink->has('course') ? $this->Html->link($courseLink->course->title, ['controller' => 'Courses', 'action' => 'view', $courseLink->course->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($courseLink->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($courseLink->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Url') ?></h4>
        <?= $this->Text->autoParagraph(h($courseLink->url)); ?>
    </div>
</div>
