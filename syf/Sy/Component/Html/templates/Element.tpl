<?php if (is_null($CONTENT)) : ?>
<<?php echo $TAG_NAME ?><?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?> />
<?php else : ?>
<<?php echo $TAG_NAME ?><?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?>><?php echo $CONTENT ?></<?php echo $TAG_NAME ?>>
<?php endif ?>