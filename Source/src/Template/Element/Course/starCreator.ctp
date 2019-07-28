<?php
	$selectable = isset($selectable) && $selectable === true;
	$starCount = 0;
?>
<div class="star-rating<?= $this->Class->addIf('selectable', $selectable) ?>"<?= $selectable ? ' style="cursor: pointer"' : '' ?>>
<?php for ($i = 0; $i < intval($rating); $i++): $starCount++; ?>
<i class="fa fa-star fa-2x" style="color:rgb(227,207,122);"></i>
<?php endfor; ?>

<?php if ($rating - intval($rating) > 0.25): $starCount++ ?>
<i class="fa fa-star-half-o fa-2x" style="color:rgb(227,207,122);"></i>
<?php endif; ?>

<?php for ($i = 5 - $starCount; $i > 0; $i--): ?>
<i class="fa fa-star-o fa-2x" style="color:rgb(227,207,122);"></i>
<?php endfor; ?>
</div>