<?php

    // todo extend the appropriate view here
$this->extend('/Courses/common');

$this->Title->set(h($course->title) . ' ' . h($course->code));
?>


<h2 class="text-xs-center mb-1"><?= h($course->title) ?></h2>
<div class="table-responsive">
    <table class="table vertical-table">
        <tr>
            <th scope="row"><?= __('Κωδικός') ?></th>
            <td><?= h($course->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Τύπος') ?></th>
            <td><?= h($this->CourseType->translate($course->type)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Επίπεδο') ?></th>
            <td><?= h($this->CourseLevel->translate($course->level)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ects') ?></th>
            <td><?= $this->Number->format($course->ects) ?></td>
        </tr>
        <?php if (!empty($course->official_url)): ?>
            <tr>
                <th scope="row"><?= __('Ιστοσελίδα Μαθήματος') ?></th>
                <td><?= $this->Html->link($course->official_url, $course->official_url) ?></td>
            </tr>
        <?php endif; ?>

        <?php if (!empty($course->eclass_url)): ?>
            <tr>
                <th scope="row"><?= __('Ιστοσελίδα eclass') ?></th>
                <td><?= $this->Html->link($course->eclass_url, $course->eclass_url) ?></td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<div class="card">
    <div class="card-block">
        <h4 class="card-title"><?= __('Περιγραφή') ?></h4>
        <p class="card-text">
            <?php if (!empty($course->description)): ?>
                <?= h($course->description) ?>
            <?php else: ?>
                <?= __('Το μάθημα δεν έχει περιγραφή') ?>
            <?php endif; ?> 
        </p>
    </div>
</div>

<?php if (isset($courseSemesterProfessors) and $courseSemesterProfessors->count() > 0): ?>
    <div class="card">
        <div class="card-block">
            <h4 class="card-title"><?= __('Καθηγητές') ?></h4>
            <p class="card-text">
             <?php foreach ($courseSemesterProfessors as $courseSemesterProfessor): ?>
                <?php $user = $courseSemesterProfessor->professor->user ?>
                <?= $this->Html->link($this->User->fullName($user), ['controller' => 'Professors', 'action' => 'profile', $user->identifier]) ?>
                <br>
            <?php endforeach; ?>
        </p>
    </div>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-block">
        <h4 class="card-title"><?= __('Τελευταίες ανακοινώσεις') ?></h4>
        <p class="card-text">
            <?php if ($announcements->count() === 0): ?>
                <?= __('Δεν υπάρχουν ανακοινώσεις') ?>
            <?php else: ?>
                <?php foreach($announcements as $announcement): ?>
                    <?= $this->Time->format($announcement->created, 'DD/MM/YY', null, isset($user) ? $user['timezone'] : null) ?> - <?= h($announcement->text) ?>
                <?php endforeach; ?>
                <br>
                <?= $this->Html->link(__('Προβολή όλων'), ['controller' => 'CourseAnnouncements', 'action' => 'course', $course->code]) ?>
            <?php endif; ?>
        </p>
    </div>
</div>

<?php if ($user['role'] !== 'student'): ?>

    <div class="card">
        <div class="card-block">
            <h4 class="card-title"><?= __('Σύνδεσμοι Μαθήματος') ?></h4>
            <p class="card-text">

                <?= __('Το μάθημα έχει {0} συνδέσμους', $courseLinksCount) ?><br>
                <?= $this->Html->link(__('Προβολή των συνδέσμων του μαθήματος'), ['controller' => 'CourseLinks', 'action' => 'index', h($course->code)]) ?>
            </p>
        </div>
    </div>
<?php endif; ?>