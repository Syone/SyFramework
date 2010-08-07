<?php if (isset($OPTIONS['label'])) : ?>
<label<?php if (isset($ATTRIBUTES['id'])) : ?> for="<?php echo $ATTRIBUTES['id'] ?>"<?php endif ?>><?php echo $OPTIONS['label'] ?>
<?php if ($ERROR and isset($OPTIONS['error'])) : ?>
<strong><?php echo $OPTIONS['error'] ?></strong>
<?php endif ?>
</label>
<?php endif ?>
<?php if (is_null($CONTENT)) : ?>
<<?php echo $TAG_NAME ?><?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?> />
<?php else : ?>
<<?php echo $TAG_NAME ?><?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?>><?php echo $CONTENT ?></<?php echo $TAG_NAME ?>>
<?php endif ?>