<<?php echo $TAG_NAME ?><?php if (isset($BLOCK_ATTRIBUTES)): foreach ($BLOCK_ATTRIBUTES as $a): ?> <?php echo $a['NAME'] ?>="<?php echo $a['VALUE'] ?>"<?php endforeach; endif ?>>
<?php echo $CONTENT ?>
</<?php echo $TAG_NAME ?>>
