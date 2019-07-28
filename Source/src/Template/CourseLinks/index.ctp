<?php
    use Cake\Core\Configure;

    $this->extend('/Courses/common');

    $this->Title->set(__('Λίστα Μαθητών | {0}', h($this->User->fullName($user))));

    $isStudent = ($user['role'] === 'student');
?>

<h1><?= __('{0} - Σύνδεσμοι', h($course->title)) ?></h1>

<?php foreach ($categories as $categoryTitle => $content): ?>

<h2><?= h($categoryTitle) ?></h2>

<?php if (!$isStudent): ?>
    <?= $this->Html->link(__('Διαγραφή όλων'), ['controller' => 'CourseLinks', 'action' => 'deleteAll', $content[0]->id, $course->id], ['confirm' => __('Είστε σίγουροι ότι θέλετε να διαγράψετε όλους τους συνδέσμους από αυτή τη κατηγορία σε αυτό το μάθημα;')]) ?>
    <br>
<?php endif; ?>

    <?php foreach ($content as $innerContent): ?>
        <?php $link = $innerContent['_matchingData']['CourseLinks']; ?>

<?= h($link->title) ?> - <?= h($link->url) ?>

        <?php if (!$isStudent): ?>
<?= $this->Html->link(__('Επεξεργασία'), ['controller' => 'CourseLinks', 'action' => 'edit', $link->id]) ?> 
<?= $this->Html->link(__('Διαγραφή'), ['controller' => 'CourseLinks', 'action' => 'delete', $link->id], ['confirm' => __('Είστε σίγουροι ότι θέλετε να διαγράψετε τον σύνδεσμο "{0}";', h($link->title))]) ?>
        <?php endif; ?>
<br>

    <?php endforeach; ?>
    <?php if (!$isStudent): ?>
<a href="#"><?= __('Προσθήκη') ?></a> <!-- todo -->
    <?php endif; ?>
<?php endforeach; ?>