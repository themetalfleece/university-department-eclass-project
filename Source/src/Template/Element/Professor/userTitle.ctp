<?php
	// this file just renders the user title so as to be clickable, on the top of the modal dialog showing the professor lessons that a specific student has taken
?>

<h5><?= __('Τα μαθήματά σας που έχει πάρει ο μαθητής {0}', $this->Html->link($this->User->fullName($user), ['controller' => 'Students', 'action' => 'profile', $user->identifier])) ?></h5>