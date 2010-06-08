<!DOCTYPE html<?php if (isset($DOCTYPE)) : ?> <?php echo $DOCTYPE?><?php endif ?>>
<html<?php if (isset($XMLNS)) : ?> xmlns="<?php echo $XMLNS ?>"<?php endif ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $CHARSET ?>" />
<?php foreach ($META['http-equiv'] as $name => $content) : ?>
<meta http-equiv="<?php echo $name ?>" content="<?php echo $content ?>" />
<?php endforeach ?>
<?php foreach ($META['standard'] as $name => $content) : ?>
<meta name="<?php echo $name ?>" content="<?php echo $content ?>" />
<?php endforeach ?>
<?php if (isset($TITLE)) : ?>
<title><?php echo $TITLE ?></title>
<?php endif ?>
<?php if (isset($FAVICON_HREF)) : ?>
<link rel="<?php echo $FAVICON_REL ?>" type="<?php echo $FAVICON_TYPE ?>" href="<?php echo $FAVICON_HREF ?>" />
<?php endif ?>
<?php foreach ($CSS_LINKS as $link) : ?>
<link rel="stylesheet" href="<?php echo $link ?>" type="text/css" />
<?php endforeach ?>
<?php foreach ($JS_LINKS as $link) : ?>
<script type="text/javascript" src="<?php echo $link ?>"></script>
<?php endforeach ?>
<?php if (isset($CSS_CODE)) : ?>
<style type="text/css">
<?php echo $CSS_CODE ?>
</style>
<?php endif ?>
<?php if (isset($JS_CODE)) : ?>
<script type="text/javascript">
<?php echo $JS_CODE ?>
</script>
<?php endif ?>
</head>

<body<?php foreach ($BODY_ATTR as $name => $value) : ?> <?php echo $name . '="' . $value .'"' ?><?php endforeach ?>>
<?php echo $BODY ?>

</body>
</html>