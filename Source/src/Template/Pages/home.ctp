<?php
	$this->extend('/Common/pages');

	$this->Title->set(__('Αρχική'));

	$this->assign('body-class', 'home');

	$this->Html->script('home.js', ['block' => 'bottomScript']);
?>

<h2 class="top-header"><?= __('Πλατφόρμα Τηλεκπαίδευσης') ?></h2>

<div class="row login">
	<div class="col-lg-4 col-md-6 offset-lg-8 offset-md-6">
		<?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'Login']]) ?>
		<div class="form-group">
            <?= $this->Form->input('email', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Email'), 'autofocus' => 'autofocus']) ?>
        </div>

		<div class="form-group">
            <?= $this->Form->input('password', ['label' => false, 'class' => 'form-control', 'placeholder' => __('Κωδικός')]) ?>
        </div>

		<?= $this->Form->button(__('Είσοδος'), ['class' => 'btn btn-primary btn-block']); ?>

		<?= $this->Form->end() ?>
		<div class="clearfix">
			<a href="/users/restorePassword" class="float-xs-left"><?= __('Ανάκτηση Κωδικού') ?></a>
			<a href="/users/register" class="float-xs-right"><?= __('Εγγραφή') ?></a>
		</div>
		
	</div>
</div>

<?= __('
Σας καλωσορίζουμε στο Τμήμα Ηλεκτρολόγων Μηχανικών και Τεχνολογίας Υπολογιστών το οποίο ιδρύθηκε το 1967 ως το πρώτο Τμήμα της Πολυτεχνικής Σχολής του Πανεπιστημίου Πατρών. Το Τμήμα μας καλύπτει εκπαιδευτικά και ερευνητικά τις περιοχές Ηλεκτρικής Ενέργειας, Τηλεπικοινωνιών και Τεχνολογίας Πληροφορίας, Ηλεκτρονικής και Υπολογιστών, Συστημάτων και Αυτομάτου Ελέγχου. Σας προσκαλούμε να επισκεφθείτε τις εγκαταστάσεις μας ή να περιηγηθείτε ηλεκτρονικά στον ιστότοπό μας.
'); ?>