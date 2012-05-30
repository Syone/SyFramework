<form<?php if (isset($BLOCK_ATTRIBUTES)): foreach ($BLOCK_ATTRIBUTES as $a): ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach; endif ?>>
<?php if ($ERROR and isset($OPTIONS['error'])) : ?>
<div class="<?php echo $OPTIONS['error-class'] ?>"><?php echo $OPTIONS['error'] ?></div>
<?php endif ?>
<?php if ($SUCCESS and isset($OPTIONS['success'])) : ?>
<div class="<?php echo $OPTIONS['success-class'] ?>"><?php echo $OPTIONS['success'] ?></div>
<?php endif ?>
<?php if (isset($ACTION)) : ?>
<input name="<?php echo $ACTION ?>" value="submit" type="hidden" />
<?php endif ?>
<?php echo $CONTENT ?>
</form>
