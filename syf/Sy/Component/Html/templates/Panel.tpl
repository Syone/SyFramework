<div style="display: table; width: <?php echo $WIDTH ?><?php if (isset($HEIGHT)): ?>; height: <?php echo $HEIGHT ?><?php endif ?>">
<?php if (isset($NORTH)): ?>
<div style="display: table-row">
<div style="display: table-cell<?php if (isset($NORTH_HEIGHT)): ?>; height: <?php echo $NORTH_HEIGHT ?><?php endif ?>">
<?php echo $NORTH ?>

</div>
</div>
<?php endif ?>
<div style="display: table-row">
<div style="display: table-cell">
<div style="display: table; width: 100%; height: 100%">
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
</div>
</div>
<?php if (isset($SOUTH)): ?>
<div style="display: table-row">
<div style="display: table-cell<?php if (isset($SOUTH_HEIGHT)): ?>; height: <?php echo $SOUTH_HEIGHT ?><?php endif ?>">
<?php echo $SOUTH ?>

</div>
</div>
<?php endif ?>
</div>
