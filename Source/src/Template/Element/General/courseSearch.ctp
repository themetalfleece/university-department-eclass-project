<?php
	$this->Html->script('user/course-search', ['block' => 'bottomScript']);
?>
<form id="search">
	<div class="input-group">
		<div id="search-wrapper">
			<input type="text" class="form-control search" placeholder="<?= __('Μάθημα...') ?>" autofocus value="<?= isset($searchTerm) ? $searchTerm : '' ?>">
			<span id="search-clear" title="<?= __('καθαρισμός') ?>" class="fa fa-times-circle"></span>
		</div>
		<span class="input-group-btn">
			<button class="btn btn-secondary" type="submit"><?= __('Αναζήτηση') ?></button>
		</span>
	</div>
</form>
