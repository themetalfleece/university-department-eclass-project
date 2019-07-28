<?php
	use Cake\Core\Configure;
?>
<div class="users form">
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<?= $this->Form->create(null, ['url' => ['controller' => 'Students', 'action' => 'settings']]) ?>
			<div class="form-group">
				<?= $this->Form->input('AM', ['label' => __('AM'), 'class' => 'form-control', 'type' => 'number', 'value' => $student->AM, 'placeholder' => __('Αριθμός Μητρώου')]) ?>
			</div>

			<div class="form-group">
				<?= $this->Form->label('level', __('Βαθμίδα')) ?>
				<?= $this->Form->select('level', Configure::read('student.levelsTranslated'), ['default' => $student->level, 'class' => 'form-control']) ?>
			</div>

			<?= $this->Form->button(__('Αποθήκευση'), ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end() ?>
		</div>
	</div>
</div>