<?php if (isset($NORTH)) : ?>
<div style="width: <?php echo $WIDTH ?>">
<?php echo $NORTH ?>
</div>
<?php endif ?>
<div style="display: table; width: <?php echo $WIDTH ?>;">
<div style="display: table-row">
<?php if (isset($WEST)) : ?>
<div style="display: table-cell">
<?php echo $WEST ?>
</div>
<?php endif ?>
<?php if (isset($CENTER)) : ?>
<div style="display: table-cell">
<?php echo $CENTER ?>
</div>
<?php endif ?>
<?php if (isset($EAST)) : ?>
<div style="display: table-cell">
<?php echo $EAST ?>
</div>
<?php endif ?>
</div>
</div>
<?php if (isset($SOUTH)) : ?>
<div style="width: <?php echo $WIDTH ?>">
<?php echo $SOUTH ?>
</div>
<?php endif ?>