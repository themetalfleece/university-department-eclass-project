<div class="btn-group" id="user-menu">
	<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?= h($this->User->fullName($user)) ?>
	</button>
	<div class="dropdown-menu dropdown-menu-right">
		<?= $this->Html->link($this->UserRole->translate($user['role']), '#', ['class' => 'dropdown-item disabled']) ?>
		<?= $this->Html->link(__('Τα μαθήματά μου'), '/', ['class' => 'dropdown-item']) ?>
		<?= $this->Html->link(__('Το προφίλ μου'), ['controller' => 'Students', 'action' => 'profile', $user['identifier']], ['class' => 'dropdown-item']) ?>
		<?= $this->Html->link(__('Ρυθμίσεις'), ['controller' => 'Users', 'action' => 'settings'], ['class' => 'dropdown-item']) ?>
		<div class="dropdown-divider"></div>
		<?= $this->Html->link(__('Έξοδος'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item']) ?>
	</div>
</div>