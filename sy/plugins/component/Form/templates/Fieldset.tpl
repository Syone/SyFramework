<fieldset<?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?>>
<?php if (isset($LEGEND)) : ?>
	<legend><?php echo $LEGEND ?></legend>
<?php endif ?>
<?php foreach ($ELEMENTS as $element) : ?>
<?php echo $element ?>
<?php endforeach ?>
</fieldset>
