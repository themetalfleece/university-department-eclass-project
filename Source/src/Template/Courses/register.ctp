<?php
use Cake\Core\Configure;

$this->extend('/Students/common');

$this->Title->set(__('Εγγραφή σε μαθήματα'));

$this->Html->script('course/register', ['block' => 'bottomScript']);
?>

<div class="row lessons_header">
    <div class="col-xs-12 col-sm-8">
        <h2 class="top-header"><?= __('Εγγραφή Μαθημάτων ({0})', $this->Paginator->counter('{{count}}')) ?></h2>
    </div>
    <div class="col-xs-12 col-sm-4">
        <?= $this->element('General/courseSearch') ?>
    </div>
</div>

<?php if (!empty($searchTerm)): ?>
    <p><?= __('Αναζήτηση για {0}', '<b>' . h($searchTerm) . '</b>') ?></p>
<?php endif; ?>

<div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped main-table" id="lessons-register">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('Courses.title', __('Τίτλος')) ?></th>
                    <th><?= $this->Paginator->sort('Sector.sector', __('Τομέας')) ?></th>
                    <th><?= $this->Paginator->sort('Courses.ects', __('ECTS')) ?></th>
                    <th><?= $this->Paginator->sort('Courses.code', __('Κωδικός')) ?></th>
                    <th><?= $this->Paginator->sort('Courses.level', __('Επίπεδο')) ?></th>
                    <th><?= $this->Paginator->sort('Courses.type', __('Τύπος')) ?></th>
                    <th><?= __('Παρακολούθηση') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= $this->Html->link($course->title, ['controller' => 'Courses', 'action' => 'view', h($course->code)]) ?></td>
                        <td class="text-xs-center"><?= h($course->sector->sector) ?></td>
                        <td class="text-xs-center"><?= $this->Number->format($course->ects) ?></td>
                        <td class="text-xs-center"><?= h($course->code) ?></td>
                        <td class="text-xs-center"><?= h($this->CourseLevel->translate($course->level)) ?></td>
                        <td class="text-xs-center"><?= h($this->CourseType->translate($course->type)) ?></td>
                        <td class="text-xs-center">
                            <?php if (!empty($course->courses_students)): // student is registered to this course ?>
                                <?= $this->Form->select('status', array_merge(['deregister' => __('Μη εγγεγραμμένος')], Configure::read('course.statusesTranslated')), ['default' => $course->courses_students[0]->status, 'class' => 'form-control lesson-status lesson-registered', 'data-lesson-id' => $course->id]) ?>                       
                            <?php else: ?>
                                <?= $this->Form->select('status', array_merge(['deregister' => __('Μη εγγεγραμμένος')], Configure::read('course.statusesTranslated')), ['default' => 'deregister', 'class' => 'form-control lesson-status lesson-notregistered', 'data-lesson-id' => $course->id]) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator main-table-paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>

</div>
