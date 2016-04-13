<?php if (isset($BLOCK_CONTENT)): ?>
<<?php echo $TAG_NAME ?><?php if (isset($BLOCK_ATTRIBUTES)): foreach ($BLOCK_ATTRIBUTES as $a): ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach; endif ?>><?php foreach ($BLOCK_CONTENT as $c): echo $c['ELEMENT']; endforeach ?></<?php echo $TAG_NAME ?>>
<?php else: ?>
<<?php echo $TAG_NAME ?><?php if (isset($BLOCK_ATTRIBUTES)): foreach ($BLOCK_ATTRIBUTES as $a): ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach; endif ?> />
<?php endif ?>