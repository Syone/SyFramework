<?php if (isset($OPTIONS['label'])) : ?>
	<label><?php echo $OPTIONS['label'] ?></label>
<?php endif ?>
	<input<?php foreach ($ATTRIBUTES as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?> />
