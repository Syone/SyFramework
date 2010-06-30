
<form<?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?>>
<?php echo $ACTION_ELEMENT ?>
<?php foreach ($ELEMENTS as $element) : ?>
<?php echo $element ?>
<?php endforeach ?>
</form>
