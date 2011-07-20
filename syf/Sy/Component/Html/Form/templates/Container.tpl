<<?php echo $TAG_NAME ?><?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?>>
<?php foreach ($ELEMENTS as $element) : ?>
<?php echo $element ?>
<?php endforeach ?>
<?php echo $CONTENT ?>
</<?php echo $TAG_NAME ?>>
