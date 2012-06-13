<?php if (isset($LABEL)) : ?>
<label<?php if (isset($ID)) : ?> for="<?php echo $ID ?>"<?php endif ?>><?php echo $LABEL ?></label>
<?php endif ?>
<?php if (isset($ERROR)) : ?><span class="error"><?php echo $ERROR ?></span><?php endif ?>
<<?php echo $TAG_NAME ?><?php if (isset($BLOCK_ATTRIBUTES)): foreach ($BLOCK_ATTRIBUTES as $a): ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach; endif ?>><?php foreach ($BLOCK_CONTENT as $c): echo $c['ELEMENT']; endforeach ?></<?php echo $TAG_NAME ?>>
