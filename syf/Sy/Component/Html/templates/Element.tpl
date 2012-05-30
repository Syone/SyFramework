<?php if (is_null($CONTENT)): ?>
<<?php echo $TAG_NAME ?><?php if (isset($ATTRIBUTES)): ?><?php foreach ($ATTRIBUTES as $a) : ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach ?><?php endif ?> />
<?php else: ?>
<<?php echo $TAG_NAME ?><?php if (isset($ATTRIBUTES)): ?><?php foreach ($ATTRIBUTES as $a) : ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach ?><?php endif ?>><?php echo $CONTENT ?></<?php echo $TAG_NAME ?>>
<?php endif ?>