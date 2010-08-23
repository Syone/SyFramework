<?php if (isset($OPTIONS['label'])) : ?>
<label<?php if (isset($ATTRIBUTES['id'])) : ?> for="<?php echo $ATTRIBUTES['id'] ?>"<?php endif ?>><?php echo $OPTIONS['label'] ?></label>
<?php endif ?>
<?php if ($ERROR and isset($OPTIONS['error'])) : ?><span class="error"><?php echo $OPTIONS['error'] ?></span><?php endif ?>
<<?php echo $TAG_NAME ?><?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?>>
<?php foreach ($ELEMENTS as $element) : ?>
<?php echo $element ?>
<?php endforeach ?>
</<?php echo $TAG_NAME ?>>
