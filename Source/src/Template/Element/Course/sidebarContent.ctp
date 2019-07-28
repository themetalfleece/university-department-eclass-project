<?php $this->Class->setRecordAddedCount(true); ?>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'courses.view') ?>">
	<?= $this->Html->link(__('{0} Πληροφορίες', '<i class="fa fa-info"></i>'), ['controller' => 'Courses', 'action' => 'view', $course->code], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'courseAnnouncements.course') ?>">
	<?= $this->Html->link(__('{0} Ανακοινώσεις', '<i class="fa fa-bullhorn"></i>'), ['controller' => 'Announcements', 'action' => 'course', $course->code], ['escape' => false]) ?>
</li>

<li class="list-group-item"><a href="#"><i class="fa fa-university"></i> <?= __('Εργασίες') ?></a></li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'courselinks.index') ?>">
	<?= $this->Html->link(__('{0} Σύνδεσμοι', '<i class="fa fa-link"></i>'), ['controller' => 'CourseLinks', 'action' => 'index', $course->code], ['escape' => false]) ?>
</li>

<li class="list-group-item<?= $this->Class->addIfAction('active', 'courseSemesterReviews.index') ?>">
	<?= $this->Html->link(__('{0} Κριτικές', '<i class="fa fa-star"></i>'), ['controller' => 'CourseSemesterReviews', 'action' => 'index', $course->id], ['escape' => false]) ?>
</li>

<?php $addedCount = $this->Class->getRecordedCount(); ?>
<?php $this->Class->setRecordAddedCount(false); ?>

<?php $this->assign('course-choices-open', $addedCount) ?>