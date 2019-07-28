<?php
	use Cake\Core\Configure;

	$this->extend('/Admins/common');

	$this->Title->set(__('Admin Αρχική | {0}', h($this->User->fullName($user))));
	$this->assign('body-class', 'admin user home');
?>

<?= $this->Html->link(__('Admins'), ['controller' => 'Admins', 'action' => 'index']) ?>
<p>
	<?= __('Υπάρχουν {0} admins, από τους οποίους οι {1} χρειάζονται επιβεβαίωση διαχειριστή', $admins['all'], $admins['unverified']) ?>	
</p>

<?= $this->Html->link(__('Καθηγητές'), ['controller' => 'Professors', 'action' => 'index']) ?>
<p>
	<?= __('Υπάρχουν {0} καθηγητές, από τους οποίους οι {1} χρειάζονται επιβεβαίωση διαχειριστή', $professors['all'], $professors['unverified']) ?>	
</p>

<?= $this->Html->link(__('Γραμματεία'), ['controller' => 'Secretaries', 'action' => 'index']) ?>
<p>
	<?= __('Υπάρχουν {0} γραμματείς, από τους οποίους οι {1} χρειάζονται επιβεβαίωση διαχειριστή', $secretaries['all'], $secretaries['unverified']) ?>	
</p>

<?= $this->Html->link(__('Μαθητές'), ['controller' => 'Students', 'action' => 'index']) ?>
<p>
	<?= __('Υπάρχουν {0} εγγεγραμμένοι μαθητές', $students) ?>	
</p>
