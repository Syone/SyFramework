<?php echo $DOCTYPE ?>
<html<?php if (isset($XMLNS)) echo $XMLNS ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if (isset($DESCRIPTION)) : ?>
<meta name="description" content="<?php echo $DESCRIPTION ?>" />
<?php endif ?>
<?php if (isset($TITLE)) : ?>
<title><?php echo $TITLE ?></title>
<?php endif ?>
<?php if (isset($FAVICON)) : ?>
<link rel="icon" type="image/png" href="{FAVICON}" />
<?php endif ?>
<?php echo $CSS_LINKS ?>
<?php echo $JS_LINKS ?>
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

<body>
<?php echo $BODY ?>
</body>
</html>
