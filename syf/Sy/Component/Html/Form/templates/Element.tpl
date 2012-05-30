<?php if (isset($OPTIONS['label'])): ?>
<?php if ($OPTIONS['label-position'] === 'before'): ?>
<label<?php if (isset($ATTRIBUTES['id'])) : ?> for="<?php echo $ATTRIBUTES['id'] ?>"<?php endif ?><?php if (isset($OPTIONS['label-class'])) : ?> class="<?php echo $OPTIONS['label-class'] ?>"<?php endif ?>><?php echo $OPTIONS['label'] ?></label>
<?php elseif ($OPTIONS['label-position'] === 'wrap-before'): ?>
<label<?php if (isset($ATTRIBUTES['id'])) : ?> for="<?php echo $ATTRIBUTES['id'] ?>"<?php endif ?><?php if (isset($OPTIONS['label-class'])) : ?> class="<?php echo $OPTIONS['label-class'] ?>"<?php endif ?>>
<?php echo $OPTIONS['label'] ?>
<?php elseif ($OPTIONS['label-position'] === 'wrap-after'): ?>
<label<?php if (isset($ATTRIBUTES['id'])) : ?> for="<?php echo $ATTRIBUTES['id'] ?>"<?php endif ?><?php if (isset($OPTIONS['label-class'])) : ?> class="<?php echo $OPTIONS['label-class'] ?>"<?php endif ?>>
<?php endif ?>
<?php endif ?>
<?php if ($ERROR and isset($OPTIONS['error']) and $OPTIONS['error-position'] === 'before'): ?>
<span class="<?php echo $OPTIONS['error-class'] ?>"><?php echo $OPTIONS['error'] ?></span>
<?php endif ?>
<?php if (is_null($CONTENT)) : ?>
<<?php echo $TAG_NAME ?><?php if (isset($BLOCK_ATTRIBUTES)): foreach ($BLOCK_ATTRIBUTES as $a): ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach; endif ?> />
<?php else : ?>
<<?php echo $TAG_NAME ?><?php if (isset($BLOCK_ATTRIBUTES)): foreach ($BLOCK_ATTRIBUTES as $a): ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach; endif ?>><?php echo $CONTENT ?></<?php echo $TAG_NAME ?>>
<?php endif ?>
<?php if (isset($OPTIONS['label'])): ?>
<?php if ($OPTIONS['label-position'] === 'after'): ?>
<label<?php if (isset($ATTRIBUTES['id'])) : ?> for="<?php echo $ATTRIBUTES['id'] ?>"<?php endif ?>><?php echo $OPTIONS['label'] ?></label>
<?php elseif ($OPTIONS['label-position'] === 'wrap-after'): ?>
<?php echo $OPTIONS['label'] ?>
</label>
<?php elseif ($OPTIONS['label-position'] === 'wrap-before'): ?>
</label>
<?php endif ?>
<?php endif ?>
<?php if ($ERROR and isset($OPTIONS['error']) and $OPTIONS['error-position'] === 'after'): ?>
<span class="<?php echo $OPTIONS['error-class'] ?>"><?php echo $OPTIONS['error'] ?></span>
<?php endif ?>