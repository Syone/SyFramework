<!DOCTYPE html<?php if (isset($DOCTYPE)): ?> <?php echo $DOCTYPE?><?php endif ?>>
<html<?php foreach ($HTML_ATTR as $name => $value) : ?> <?php echo $name . '="' . $value .'"' ?><?php endforeach ?>>
<head>
<?php foreach ($META as $metaAttributes): ?>
<meta<?php foreach ($metaAttributes as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?> />
<?php endforeach ?>
<?php if (isset($TITLE)): ?>
<title><?php echo $TITLE ?></title>
<?php endif ?>
<?php if (isset($FAVICON_HREF)): ?>
<link rel="<?php echo $FAVICON_REL ?>" type="<?php echo $FAVICON_TYPE ?>" href="<?php echo $FAVICON_HREF ?>" />
<?php endif ?>
<?php foreach ($CSS_LINKS as $media => $links): ?>
<?php foreach ($links as $link): ?>
<link rel="stylesheet" type="text/css"<?php if (!empty($media)) : ?> media="<?php echo $media ?>"<?php endif; ?> href="<?php echo $link ?>" />
<?php endforeach ?>
<?php endforeach ?>
<?php foreach ($JS_LINKS as $link): ?>
<script type="text/javascript" src="<?php echo $link ?>"></script>
<?php endforeach ?>
<?php if (!empty($CSS_CODE)): ?>
<style type="text/css">
<?php echo $CSS_CODE ?>
</style>
<?php endif ?>
<?php if (!empty($JS_CODE)): ?>
<script type="text/javascript">
<?php echo $JS_CODE ?>
</script>
<?php endif ?>
</head>
<body<?php foreach ($BODY_ATTR as $name => $value) : ?> <?php echo $name . '="' . $value .'"' ?><?php endforeach ?>>
<?php echo $BODY ?>
<?php if (isset($DEBUG_BAR)) echo $DEBUG_BAR ?>
<?php foreach ($JS_LINKS_BOTTOM as $link): ?>
<script type="text/javascript" src="<?php echo $link ?>"></script>
<?php endforeach ?>
<?php if (!empty($JS_CODE_BOTTOM)): ?>
<script type="text/javascript">
<?php echo $JS_CODE_BOTTOM ?>
</script>
<?php endif ?>
</body>
</html>