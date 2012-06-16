<!DOCTYPE html<?php if (isset($DOCTYPE)): ?> <?php echo $DOCTYPE?><?php endif ?>>
<html<?php if (isset($HTML_ATTR)): foreach ($HTML_ATTR as $html): ?> <?php echo $html['NAME'] ?>="<?php echo $html['VALUE'] ?>"<?php endforeach; endif ?>>
<head>
<?php if (isset($META)): ?>
<?php foreach ($META as $meta): ?>
<?php echo $meta['META_ELEMENT'] ?>
<?php endforeach ?>
<?php endif ?>
<?php if (isset($TITLE)): ?>
<title><?php echo $TITLE ?></title>
<?php endif ?>
<?php if (isset($FAVICON_HREF)): ?>
<link rel="<?php echo $FAVICON_REL ?>" type="<?php echo $FAVICON_TYPE ?>" href="<?php echo $FAVICON_HREF ?>" />
<?php endif ?>
<?php if (isset($CSS_LINKS)): ?>
<?php foreach ($CSS_LINKS as $css): ?>
<link rel="stylesheet" type="text/css"<?php if (!empty($css['MEDIA'])) : ?> media="<?php echo $css['MEDIA'] ?>"<?php endif; ?> href="<?php echo $css['LINK'] ?>" />
<?php endforeach ?>
<?php endif ?>
<?php if (isset($JS_LINKS)): ?>
<?php foreach ($JS_LINKS as $link): ?>
<script type="text/javascript" src="<?php echo $link['JS_LINK'] ?>"></script>
<?php endforeach ?>
<?php endif ?>
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
<body<?php if (isset($BODY_ATTR)): foreach ($BODY_ATTR as $body): ?> <?php echo $body['NAME'] ?>="<?php echo $body['VALUE'] ?>"<?php endforeach; endif ?>>
<?php echo $BODY ?>
<?php if (isset($DEBUG_BAR)) echo $DEBUG_BAR ?>
<?php if (isset($JS_LINKS_BOTTOM)): ?>
<?php foreach ($JS_LINKS_BOTTOM as $link): ?>
<script type="text/javascript" src="<?php echo $link['JS_LINK'] ?>"></script>
<?php endforeach ?>
<?php endif ?>
<?php if (!empty($JS_CODE_BOTTOM)): ?>
<script type="text/javascript">
<?php echo $JS_CODE_BOTTOM ?>
</script>
<?php endif ?>
</body>
</html>