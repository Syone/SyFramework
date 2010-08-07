
<form<?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?>>
<?php if ($ERROR and isset($OPTIONS['error'])) : ?>
<div class="error"><?php echo $OPTIONS['error'] ?></div>
<?php endif ?>
<?php if ($INFO and isset($OPTIONS['info'])) : ?>
<div class="info"><?php echo $OPTIONS['info'] ?></div>
<?php endif ?>
<?php if (empty($ATTRIBUTES['action'])) : ?>
<input type="hidden" name="<?php echo $ACTION ?>" value="submit" />
<?php endif ?>
<?php foreach ($ELEMENTS as $element) : ?>
<?php echo $element ?>
<?php endforeach ?>
</form>
