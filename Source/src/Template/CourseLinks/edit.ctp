<?php
    use Cake\Core\Configure;

    $this->extend('/' . $this->UserRole->pluralCamel($user) . '/common');

    $this->Title->set(__('Επεξεργασία Συνδέσμου Μαθήματος | {0}', h($this->User->fullName($user))));

    $isStudent = ($user['role'] === 'student');
?>
<?= __('Σύνδεσμος του μαθήματος {0}', $this->Html->link($courseLink->course->title, ['controller' => 'Courses', 'action' => 'view', h($courseLink->course->code)])) ?>

<div>
    <?= $this->Form->create($courseLink) ?>
    <fieldset>
        <legend><?= __('Edit Course Link') ?></legend>
        <?php
            echo $this->Form->select('course_links_category_id', $courseLinksCategories);
            echo '<br>';
            echo $this->Form->select('course_id', $courses);
            echo $this->Form->input('title');
            echo $this->Form->input('url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
