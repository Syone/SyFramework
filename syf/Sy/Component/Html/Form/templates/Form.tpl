<form<?php if (isset($BLOCK_ATTRIBUTES)): foreach ($BLOCK_ATTRIBUTES as $a): ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach; endif ?>>
<?php if (isset($ERROR)) : ?>
<div class="<?php echo $ERROR_CLASS ?>"><?php echo $ERROR ?></div>
<?php endif ?>
<?php if (isset($SUCCESS)) : ?>
<div class="<?php echo $SUCCESS_CLASS ?>"><?php echo $SUCCESS ?></div>
<?php endif ?>
<?php if (isset($ACTION)) : ?>
<input name="<?php echo $ACTION ?>" value="submit" type="hidden" />
<?php endif ?>
<?php if (isset($BLOCK_CONTENT)): foreach ($BLOCK_CONTENT as $c): echo $c['ELEMENT']; endforeach; endif; ?>
</form>
