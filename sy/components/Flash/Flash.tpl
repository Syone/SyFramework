<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="<?php echo $WIDTH ?>" height="<?php echo $HEIGHT ?>"<?php if (isset($ID)) : ?> id="<?php echo $ID ?>"<?php endif ?> type="application/x-shockwave-flash">
<param name="movie" value="<?php echo $SWF ?>" />
<?php foreach ($PARAMS as $name => $value) : ?>
<param name="<?php echo $name ?>" value="<?php echo $value ?>" />
<?php endforeach ?>
<embed<?php if (isset($NAME)) : ?> name="<?php echo $NAME ?>"<?php endif ?> width="<?php echo $WIDTH ?>" height="<?php echo $HEIGHT ?>"<?php foreach ($PARAMS as $name => $value) : ?> <?php echo $name ?>="<?php echo $value ?>"<?php endforeach ?> src="<?php echo $SWF ?>" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
</object>