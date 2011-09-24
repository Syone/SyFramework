<form<?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?>>
<?php if ($ERROR and isset($OPTIONS['error'])) : ?>
<div class="error"><?php echo $OPTIONS['error'] ?></div>
<?php endif ?>
<?php if ($SUCCESS and isset($OPTIONS['success'])) : ?>
<div class="success"><?php echo $OPTIONS['success'] ?></div>
<?php endif ?>
<?php foreach ($ELEMENTS as $element) : ?>
<?php echo $element ?>
<?php endforeach ?>
</form>
