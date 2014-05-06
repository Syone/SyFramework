<div style="<?php echo $RESET_CSS ?> height: 30px"></div>
<div id="sy_debug_resize_bar_wrapper" style="<?php echo $RESET_CSS ?> height: 4px; display: none;"></div>
<div id="sy_debug_console" style="<?php echo $RESET_CSS ?> height: 270px; display: none;"></div>

<div style="<?php echo $RESET_CSS ?> position: fixed; bottom: 0; left: 0; width: 100%; font-size: 11px; z-index: 10000;">
	<div id="sy_debug_resize_bar" style="<?php echo $RESET_CSS ?> height: 4px; cursor: n-resize; display: none; background-color: #e8e8e8;"></div>
	<div id="sy_debug_bar" style="<?php echo $RESET_CSS ?> border-top: 1px solid #999; height: 30px; background-color: #e8e8e8; background-image: -moz-linear-gradient(-90deg, #e8e8e8, #cbcbcb);background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e8e8e8), to(#cbcbcb));">
		<?php if ($PHP_INFO): ?>
		<a id="sy_debug_php_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('php'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle;" alt="PHP Info" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAASCAYAAAA6yNxSAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3gUGCR8XSDO3hQAAAhlJREFUSMfN1UuIz1EUB/CPYcZ4hJnk/Wg8FiYjeQ4WQjILxVjIqzBSFjK2lMLCwkKSoSyVpQ1lI6Xs2BiDCfNoKMbKYzEzzMvm/Ov2a2b+/2kUp3797rnnnHvP43vO5R/TuAL1irAIy1CBeShHaci78Q2f0Y5WdGBgLM5NxC7cxCt0YbDArztsGlCTOFoQTcYZvMlzyT7sRn8BDr1FPabku3wrGgs4sDP0d4wiK4NowrbhMHAAd1EcfCOuRzr7MQmbcBLPsQWLsT6ythqn0IJrUbKBsNuMOpSgD8dwL3VkLX5nvL0SsjVRx6XB1+NOrNdhOxYEfxU3kjNrsCT4uuTsXmxIHXg4RLr2h6wjAdZsLERtyD6E7HHw5+Mi+BSyLsxCGXqS8x/l2msaqofAw0vMwfxk71ek8R1mJpG/j//ysJsbrZqjnmjbkmSvGjOKhgFjJ9qwMnDyA5fxHTvxFZVJe72IfzmaURV8zu4njo40d7IleBr7JRHN1OBP4EmsTyf6FZiO+8PYHYnsDWZLMCEULsXQKU7SL9BaGSivirR14Ha0rED6hYi+LfaOY0XYrcLGTMB9uJjNwsGkE3Igax1ln+8Ju/YRdHpxOHfp+MSB13gW7VMUEe/N6OSj9sBNbZJdmTsO4UG+UXwuaaO/8TXjbCGjOKXSwEVDPCzdo3yMmnAr32M0lue4LMZs+hx/iTK04GOM8P+b/gDLk9tSArG7EwAAAABJRU5ErkJggg==" />
			PHP <?php echo phpversion() ?>
		</a>
		<?php endif ?>
		<a id="sy_debug_var_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('var'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Vars" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAAAZiS0dEAAAAAAAA+UO7fwAAAAlwSFlzAAAAJAAAACQA8LeAtAAAARpJREFUOMul0z8vBFEUBfDfCqVCJyqVDyBRCrZSSBSiQki28BFkFILEn1IjEaJBo9lOIyJWotAplCIhGhQ+gATF3mF2zdpN3OTmvXvPmTNvzrtTSJLEf6KtCf4Z2bLAGLr/4HdispHAKMo4wxQuMtglJnCCY0ynQHuGdI0bDOCo7s2DkXAXgr9O8Iat2L8jQW/kYvRgDY+NPCjFuoRNPERuYDmwmTwPUreLUR/kGJj2ihl+w2v8aLH3LVCIrEQ9l8NNe+cZfs0twDaGsBr1fhBLGQ/28k4AXViIfUcY94JnrEcPVtCTJzCCfjxhXu0gVVSH5xZ9GE+B7CeUMYsr3GPXz38wHOup6kTu5AnAob/jNftwnkB9FJrgvgB+/DfYUE8G/QAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxMy0xMC0xNlQxNjo0MTo0MiswMjowMCl8miEAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTMtMTAtMTZUMTY6NDE6NDIrMDI6MDBYISKdAAAAVnRFWHRzdmc6YmFzZS11cmkAZmlsZTovLy92YXIvd3d3L19fcGljb2wvZ2VuZXJhdG9yLzEuMi9jb21tb24vbWVkaWEvc3ZnL2ljb25zL3NldHRpbmdzLnN2Z5Uvf2cAAAAASUVORK5CYII=" />
			Vars
		</a>
		<?php if ($WEB_LOGGER): ?>
		<a id="sy_debug_log_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('log'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Logs" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAAAZiS0dEAAAAAAAA+UO7fwAAAAlwSFlzAAAAJAAAACQA8LeAtAAAAIFJREFUOMuVksEOgCAIQJ+tg31xetJu9dV1scYcJnCRMd8DNkLOGWfs7b0AVidcgdLyDagegYR588UxdlHq0SKowKnUDyDNBP3YEq6zFabwn8AEjwRmWBO4YE0QlT/XCO4FO5BaN9k58RPyEk/aeXYrYRUg9p+CmiBYoZHgdnBfswdRfxmnjYm+yQAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxMy0xMC0xNlQxNjozOTo0MCswMjowMIQP3n8AAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTMtMTAtMTZUMTY6Mzk6NDArMDI6MDD1UmbDAAAAUnRFWHRzdmc6YmFzZS11cmkAZmlsZTovLy92YXIvd3d3L19fcGljb2wvZ2VuZXJhdG9yLzEuMi9jb21tb24vbWVkaWEvc3ZnL2ljb25zL2VkaXQuc3ZnsO5IoQAAAABJRU5ErkJggg==" />
			Logs <span style="<?php echo $RESET_CSS ?> color:red"><?php echo $NB_ERROR ?></span>
		</a>
		<?php endif ?>
		<?php if ($FILE_LOGGER): ?>
		<a id="sy_debug_file_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('file'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="LogFile" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAAAZiS0dEAAAAAAAA+UO7fwAAAAlwSFlzAAAAJAAAACQA8LeAtAAAAG5JREFUOMvVk0EKgDAMBCcievB5Xv1InqT4QMGDXhRKNSbUg7gQUlgYNgkVVd3wNQEDsOZGdXR5KIAOGIHGAnjqgRaYc6MOAhbLiAAkeV/2FR3BVJrAu4Z4AKFA/0ggUUBRgtdn/B5w7iDypW+1A0qzDF4lgBeoAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDEzLTEwLTE2VDE2OjM5OjExKzAyOjAwapjbrwAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxMy0xMC0xNlQxNjozOToxMSswMjowMBvFYxMAAABbdEVYdHN2ZzpiYXNlLXVyaQBmaWxlOi8vL3Zhci93d3cvX19waWNvbC9nZW5lcmF0b3IvMS4yL2NvbW1vbi9tZWRpYS9zdmcvaWNvbnMvZG9jdW1lbnRfdGV4dC5zdmex/dxHAAAAAElFTkSuQmCC" />
			Log File
		</a>
		<?php endif ?>
		<?php if ($QUERY_LOGGER): ?>
		<a id="sy_debug_query_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('query'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Query" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAAAZiS0dEAAAAAAAA+UO7fwAAAAlwSFlzAAAAJAAAACQA8LeAtAAAANFJREFUOMvt07FKgmEUxvFfpoMllBGNLtIgONdadAlNNnQNBjV8a2BDW3cgingXtRZ1AW1FmxBiu4OD56MvCewbAx944bw87/nDOTzvWpIkQg2c4xA17PipMT7wiB5eoRjmBW4z999URR3HuMIl7gphdpY0L6qIG0gBZUxzAKbYyI4A+7GDo9jBLrbC+8Jn7OABfbwtAt5xHefPKuR5vAL8B0ApR996WqRBGuIZXTxhZP77JuFvooImDtDCIAs4wwlOo97Dtu8oT8zjPMIL2riHGUIsIe15w1tGAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDEzLTEwLTE2VDE2OjQxOjMxKzAyOjAwElGJpQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxMy0xMC0xNlQxNjo0MTozMSswMjowMGMMMRkAAABWdEVYdHN2ZzpiYXNlLXVyaQBmaWxlOi8vL3Zhci93d3cvX19waWNvbC9nZW5lcmF0b3IvMS4yL2NvbW1vbi9tZWRpYS9zdmcvaWNvbnMvZGF0YWJhc2Uuc3ZnZ+RBuAAAAABJRU5ErkJggg==" />
			<?php echo $NB_QUERY ?>
		</a>
		<?php endif ?>
		<?php if ($TIME_RECORD): ?>
		<a id="sy_debug_time_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('time'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Times" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAAAZiS0dEAAAAAAAA+UO7fwAAAAlwSFlzAAAAJAAAACQA8LeAtAAAAVNJREFUOMud08tKXEEUBdDVpehcAoIimWsnGnz8gWRgzCc4iJIEWnRiBv0TKnngg0wlcxNBzAcokdBkoMm4QfATNPE1qHPl0pho3FCcqrpn7zr31K5KvV7XgiqmMY7u2DvGV3zEYTm5vTTvwCJeo61F9EEIz+EDFvAHUon8BTWcYxWj6IoxhnVchMjn4FxX8C5KPsIkGrF/GbGC/RDZxFMsoZbwCDM4wUSJfBO+4xlO8Qr9Kcgpyv7hdjSwFn2aSVE6bNyBXOBTxPGEvlj8/AfhstQPOIj4MEWD7o2EZswHbvheaRkFqhGbSXYYTP3HwUXuTpLv9ly+jcE7kJ/gBc6wnqIh79GJrUj4G4Zlx3ZgGb8KK7/BDnqxhxWMhGinbOs17KIH26gXTSQ/jEn5obTJD2pfducJvuFl5L/F8/iFawH4jVkMRXmHJYED2fuPMR8Hgit0AEgsWjPhPAAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxMy0xMC0xNlQxNjo0MDowNyswMjowMBDM0EIAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTMtMTAtMTZUMTY6NDA6MDYrMDI6MDDH5mNKAAAAU3RFWHRzdmc6YmFzZS11cmkAZmlsZTovLy92YXIvd3d3L19fcGljb2wvZ2VuZXJhdG9yLzEuMi9jb21tb24vbWVkaWEvc3ZnL2ljb25zL2Nsb2NrLnN2Z4Ev4tsAAAAASUVORK5CYII=" />
			<?php echo $MAX_TIME ?>
		</a>
		<?php endif ?>
		<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Memory" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAAAZiS0dEAAAAAAAA+UO7fwAAAAlwSFlzAAAAJAAAACQA8LeAtAAAAD9JREFUOMtjrKysZKAEMEHp/5QagAv8J2Q4IQModsHgMgBreAwtL9DPAIKJZ3B5gQXN6Qw4+LjYjDADGMl1AQAuKQyG7nn/ggAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxMy0xMC0xNlQxNjo0MTo0MSswMjowMBiUgLwAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTMtMTAtMTZUMTY6NDE6NDErMDI6MDBpyTgAAAAAWHRFWHRzdmc6YmFzZS11cmkAZmlsZTovLy92YXIvd3d3L19fcGljb2wvZ2VuZXJhdG9yLzEuMi9jb21tb24vbWVkaWEvc3ZnL2ljb25zL3N0YXRpc3RpY3Muc3ZnNgO8GAAAAABJRU5ErkJggg==" />
		<span style="<?php echo $RESET_CSS ?> line-height: 30px; color: #555;" title="Peak of memory allocated by PHP"><?php echo memory_get_peak_usage(true) / 1024 ?> KB</span>

		<button onclick="sy_debug.hide_bar()" title="Close" style="margin-right: 7px; float: right; font-size: 20px; color: #777; line-height: 29px; text-shadow: 0 1px 0 #FFFFFF; opacity: 1; background: none repeat scroll 0 0 rgba(0, 0, 0, 0); border: 0 none; cursor: pointer; padding: 0;">&times;</button>
		<button id="sy_debug_close_button" onclick="sy_debug.hide_console()" title="Minimize" style="display: none; margin-right: 7px; float: right; font-size: 20px; color: #777; line-height: 29px; text-shadow: 0 1px 0 #FFFFFF; opacity: 1; background: none repeat scroll 0 0 rgba(0, 0, 0, 0); border: 0 none; cursor: pointer; padding: 0;">&minus;</button>
	</div>
	<div id="sy_debug_console_content" style="<?php echo $RESET_CSS ?> height: 270px; border-top: 1px solid #999; background-color: #FFF; display: none;">
		<?php if ($PHP_INFO): ?>
		<div id="sy_debug_php_content" style="<?php echo $RESET_CSS ?> height: 100%">
			<iframe src="<?php echo $_SERVER['PHP_SELF'] ?>?phpinfo&amp;sy_debug_log=off" style="width: 100%; height: 100%; border: 0;">
			<p>Your browser does not support iframes.</p>
			</iframe>
		</div>
		<?php endif ?>

		<div id="sy_debug_var_content" style="<?php echo $RESET_CSS ?> height: 100%; overflow: auto;">
			<?php foreach ($VARS_ARRAY as $title => $vars) : ?>
				<?php if (!empty($vars)) : ?>
					<h2 style="<?php echo $RESET_CSS ?> font-size: 14px; margin: 10px; line-height: 20px;"><?php echo $title ?></h2>
					<table style="<?php echo $TABLE_RESET_CSS ?> width: 100%;">
						<tr style="<?php echo $TR_HEAD_CSS ?>">
							<th style="<?php echo $TH_CSS ?> width: 200px;">Name</th>
							<th style="<?php echo $TH_CSS ?>">Value</th>
						</tr>
						<?php foreach ($vars as $k => $v) : ?>
						<tr style="<?php echo $RESET_CSS ?>">
							<td style="<?php echo $TD_CSS ?> background-color: #DDE4EB; font-weight: bold;"><?php echo $k ?></td>
							<td style="<?php echo $TD_CSS ?> background-color: #EDF3FE">
								<?php if (is_array($v) or is_object($v)) : ?>
								<pre style="<?php echo $RESET_CSS ?>"><?php echo htmlentities(print_r($v, true), ENT_QUOTES, $CHARSET) ?></pre>
								<?php else : ?>
								<?php echo htmlentities($v, ENT_QUOTES, $CHARSET) ?>
								<?php endif ?>
							</td>
						</tr>
						<?php endforeach ?>
					</table>
				<?php endif ?>
			<?php endforeach ?>

			<h2 style="<?php echo $RESET_CSS ?> font-size: 14px; margin: 10px; line-height: 20px;">Included Files</h2>
			<table style="<?php echo $TABLE_RESET_CSS ?> width: 100%;">
				<tr style="<?php echo $TR_HEAD_CSS ?>">
					<th style="<?php echo $TH_CSS ?> min-width: 300px;">Filename</th>
				</tr>
				<?php foreach ($FILES as $file) : ?>
				<tr style="<?php echo $RESET_CSS ?>">
					<td style="<?php echo $TD_CSS ?> background-color: #EDF3FE"><?php echo $file ?></td>
				</tr>
				<?php endforeach ?>
			</table>
			<br />
		</div>

		<?php if ($WEB_LOGGER): ?>
		<div id="sy_debug_log_content" style="<?php echo $RESET_CSS ?> height: 100%; overflow: auto; position: relative;">
			<img onclick="sy_debug.get('log_filter_div').style.display = 'block';" style="<?php echo $RESET_CSS ?> position: absolute; top: 2px; left: 3px; cursor: pointer;" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAFdQTFRFJUOELE+cK02YK06ZLE+bIz97JkSFLVGeIz99Iz98JkWHLVGfJUODKkyWKUqRK02XKUuTKkyVJUKBKUqQKEiNJkWIKEiOJEF/J0eLJ0aKJkSG////AAAAHPtAaAAAAB10Uk5T/////////////////////////////////////wBZhudqAAAAeUlEQVR42lzO4RKCQAgE4LXyrNOyrEtj7/2fMyBxJvm33+wAqO/n7f64jofjqWm6vsfy+hd8doLiwpAO4kJyFYgLfUyAlFU8ewcDknY0rpsxDZBcyLiFSSVlbtcxzyYsIQYqlBBcztahhKD9CULQ7gR1E/tnqV8BBgBIlxB0vx1OiAAAAABJRU5ErkJggg==" />
			<div id="sy_debug_log_filter_div" style="<?php echo $RESET_CSS ?> display: none; position: absolute; padding: 3px; background-color: #CCC; border-bottom: 1px solid #AAA; border-right: 1px solid #AAA;">
				<button onclick="sy_debug.get('log_filter_div').style.display = 'none';" title="Close" style="margin-left: 5px; float: right; font-size: 16px; font-weight: bold; color: #777; line-height: 16px; text-shadow: 0 1px 0 #FFFFFF; opacity: 1; background: none repeat scroll 0 0 rgba(0, 0, 0, 0); border: 0 none; cursor: pointer; padding: 0;">&times;</button>
				<img class="sy_debug_filter_checked" onclick="sy_debug.log_filter(this, 'green')" style="<?php echo $RESET_CSS ?> cursor: pointer; float: none; border: 1px solid #375D81; background-color: #ABC8E2; padding: 2px; vertical-align: middle;" alt="Green" src="data:image/png;base64,<?php echo $FLAGS[Sy\Debug\Log::NOTICE] ?>" />
				<img class="sy_debug_filter_checked" onclick="sy_debug.log_filter(this, 'orange')" style="<?php echo $RESET_CSS ?> cursor: pointer; float: none; margin-left: 10px; border: 1px solid #375D81; background-color: #ABC8E2; padding: 2px; vertical-align: middle;" alt="Orange" src="data:image/png;base64,<?php echo $FLAGS[Sy\Debug\Log::WARN] ?>" />
				<img class="sy_debug_filter_checked" onclick="sy_debug.log_filter(this, 'red')" style="<?php echo $RESET_CSS ?> cursor: pointer; float: none; margin-left: 10px; border: 1px solid #375D81; background-color: #ABC8E2; padding: 2px; vertical-align: middle;" alt="Red" src="data:image/png;base64,<?php echo $FLAGS[Sy\Debug\Log::ERR] ?>" />
			</div>
			<table style="<?php echo $TABLE_RESET_CSS ?> width: 100%;">
				<tr style="<?php echo $TR_HEAD_CSS ?>">
					<th style="<?php echo $TH_CSS ?> min-width: 90px;">Level</th>
					<th style="<?php echo $TH_CSS ?>">Type</th>
					<th style="<?php echo $TH_CSS ?>">File</th>
					<th style="<?php echo $TH_CSS ?> width: 40px;">Line</th>
					<th style="<?php echo $TH_CSS ?>">Class</th>
					<th style="<?php echo $TH_CSS ?>">Function</th>
					<th style="<?php echo $TH_CSS ?> min-width: 300px;">Message</th>
				</tr>
				<?php foreach ($LOGS as $log) : ?>
				<tr class="sy_debug_log_row_<?php echo $COLOR_NAMES[$log->getLevel()] ?>" style="<?php echo $RESET_CSS ?>">
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>">
						<img style="<?php echo $RESET_CSS ?>" alt="<?php echo $log->getType() ?>" src="data:image/png;base64,<?php echo $FLAGS[$log->getLevel()] ?>" />
						<?php echo $log->getLevelName() ?>
					</td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $log->getType() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><span style="<?php echo $RESET_CSS ?>" title="<?php echo $log->getFile() ?>"><?php echo basename($log->getFile()) ?></span></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>; text-align: right;"><?php echo $log->getLine() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $log->getClass() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $log->getFunction() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $S_COLORS[$log->getLevel()] ?>"><pre style="<?php echo $RESET_CSS ?>"><?php echo htmlentities($log->getMessage(), ENT_QUOTES, $CHARSET) ?></pre></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
		<?php endif ?>

		<?php if ($FILE_LOGGER): ?>
		<div id="sy_debug_file_content" style="<?php echo $RESET_CSS ?> height: 100%; position: relative;">
			<div style="<?php echo $RESET_CSS ?> position: absolute; top: 0; left: 0; background-color: #fff; padding-top: 2px; padding-left: 3px;">
				<img onclick="document.getElementById('file_frame').src = '<?php echo $_SERVER['PHP_SELF'] ?>?<?php echo htmlentities($_SERVER['QUERY_STRING'], ENT_QUOTES, $CHARSET) ?>&amp;sy_debug_log_file&amp;sy_debug_log=off';" style="<?php echo $RESET_CSS ?> cursor: pointer;" title="Refresh" alt="Refresh" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAI/SURBVDjLjZPbS9NhHMYH+zNidtCSQrqwQtY5y2QtT2QGrTZf13TkoYFlzsWa/tzcoR3cSc2xYUlGJfzAaIRltY0N12H5I+jaOxG8De+evhtdOP1hu3hv3sPzPO/z4SsBIPnfuvG8cbBlWiEVO5OUItA0VS8oxi9EdhXo+6yV3V3UGHRvVXHNfNv6zRfNuBZVoiFcB/3LdnQ8U+Gk+bhPVKB3qUOuf6/muaQR/qwDkZ9BRFdCmMr5EPz6BN7lMYylLGgNNaKqt3K0SKDnQ7us690t3rNsxeyvaUz+8OJpzo/QNzd8WTtcaQ7WlBmPvxhx1V2Pg7oDziIBimwwf3qAGWESkVwQ7owNujk1ztvk+cg4NnAUTT4FrrjqUKHdF9jxBfXr1rgjaSk4OlMcLrnOrJ7latxbL1V2lgvlbG9MtMTrMw1r1PImtfyn1n5q47TlBLf90n5NmalMtUdKZoyQMkLKlIGLjMyYhFpmlz3nGEVmFJlRZNaf7pIaEndM24XIjCOzjX9mm2S2JsqdkMYIqbB1j5C6yWzVk7YRFTsGFu7l+4nveExIA9aMCcOJh6DIoMigyOh+o4UryRWQOtIjaJtoziM1FD0mpE4uZcTc72gBaUyYKEI6khgqINXO3saR7kM8IZUVCRDS0Ucf+xFbCReQhr97MZ51wpWxYnhpCD3zOrT4lTisr+AJqVx0Fiiyr4/vhP4VyyMFIUWNqRrV96vWKXKckBoIqWzXYcoPDrUslDJoopuEVEpIB0sR+AuErIiZ6OqMKAAAAABJRU5ErkJggg%3D%3D" />
				<img onclick="document.getElementById('file_frame').src = '<?php echo $_SERVER['PHP_SELF'] ?>?<?php echo htmlentities($_SERVER['QUERY_STRING'], ENT_QUOTES, $CHARSET) ?>&amp;sy_debug_log_file&amp;sy_debug_log_clear&amp;sy_debug_log=off';" style="<?php echo $RESET_CSS ?> cursor: pointer;" title="Clear" alt="Clear" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAIhSURBVDjLlZPrThNRFIWJicmJz6BWiYbIkYDEG0JbBiitDQgm0PuFXqSAtKXtpE2hNuoPTXwSnwtExd6w0pl2OtPlrphKLSXhx07OZM769qy19wwAGLhM1ddC184+d18QMzoq3lfsD3LZ7Y3XbE5DL6Atzuyilc5Ciyd7IHVfgNcDYTQ2tvDr5crn6uLSvX+Av2Lk36FFpSVENDe3OxDZu8apO5rROJDLo30+Nlvj5RnTlVNAKs1aCVFr7b4BPn6Cls21AWgEQlz2+Dl1h7IdA+i97A/geP65WhbmrnZZ0GIJpr6OqZqYAd5/gJpKox4Mg7pD2YoC2b0/54rJQuJZdm6Izcgma4TW1WZ0h+y8BfbyJMwBmSxkjw+VObNanp5h/adwGhaTXF4NWbLj9gEONyCmUZmd10pGgf1/vwcgOT3tUQE0DdicwIod2EmSbwsKE1P8QoDkcHPJ5YESjgBJkYQpIEZ2KEB51Y6y3ojvY+P8XEDN7uKS0w0ltA7QGCWHCxSWWpwyaCeLy0BkA7UXyyg8fIzDoWHeBaDN4tQdSvAVdU1Aok+nsNTipIEVnkywo/FHatVkBoIhnFisOBoZxcGtQd4B0GYJNZsDSiAEadUBCkstPtN3Avs2Msa+Dt9XfxoFSNYF/Bh9gP0bOqHLAm2WUF1YQskwrVFYPWkf3h1iXwbvqGfFPSGW9Eah8HSS9fuZDnS32f71m8KFY7xs/QZyu6TH2+2+FAAAAABJRU5ErkJggg%3D%3D" />
			</div>
			<iframe id="file_frame" src="<?php echo $_SERVER['PHP_SELF'] ?>?sy_debug_log_file&amp;sy_debug_log=off" style="width: 100%; height: 100%; border: 0;">
			<p>Your browser does not support iframes.</p>
			</iframe>
		</div>
		<?php endif ?>

		<?php if ($QUERY_LOGGER): ?>
		<div id="sy_debug_query_content" style="<?php echo $RESET_CSS ?> height: 100%; overflow: auto; position: relative;">
			<table style="<?php echo $TABLE_RESET_CSS ?> width: 100%;">
				<tr style="<?php echo $TR_HEAD_CSS ?>">
					<th style="<?php echo $TH_CSS ?>">#</th>
					<th style="<?php echo $TH_CSS ?>">File</th>
					<th style="<?php echo $TH_CSS ?> width: 40px;">Line</th>
					<th style="<?php echo $TH_CSS ?>">Class</th>
					<th style="<?php echo $TH_CSS ?>">Function</th>
					<th style="<?php echo $TH_CSS ?> min-width: 300px;">Message</th>
				</tr>
				<?php foreach ($QUERY_LOGS as $i => $log) : ?>
				<tr style="<?php echo $RESET_CSS ?>">
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $i + 1 ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><span style="<?php echo $RESET_CSS ?>" title="<?php echo $log->getFile() ?>"><?php echo basename($log->getFile()) ?></span></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>; text-align: right;"><?php echo $log->getLine() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $log->getClass() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $log->getFunction() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $S_COLORS[$log->getLevel()] ?>"><pre style="<?php echo $RESET_CSS ?>"><?php echo htmlentities($log->getMessage(), ENT_QUOTES, $CHARSET) ?></pre></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
		<?php endif ?>

		<?php if ($TIME_RECORD): ?>
		<div id="sy_debug_time_content" style="<?php echo $RESET_CSS ?> height: 100%; overflow: auto;">
			<table style="<?php echo $TABLE_RESET_CSS ?> width: 100%;">
				<tr style="<?php echo $TR_HEAD_CSS ?>">
					<th style="<?php echo $TH_CSS ?>">Time id</th>
					<th style="<?php echo $TH_CSS ?> width: 100px;">Time (ms)</th>
				</tr>
				<?php foreach ($TIMES as $title => $time) : ?>
				<tr style="<?php echo $RESET_CSS ?>">
					<td style="<?php echo $TD_CSS ?> background-color: #DDE4EB"><?php echo $title ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: #EDF3FE; text-align: right; padding-right: 10px;"><?php echo round($time * 1000, 2) ?></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
		<?php endif ?>
	</div>
</div>
<script type="text/javascript">
	var sy_debug = {

		_prefix: 'sy_debug_',

		_suffix: '_<?php echo \crc32('http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])) ?>',

		_localCache: {},

		get: function(id) {
			if (this._localCache[this._prefix + id] === undefined) {
				this._localCache[this._prefix + id] = document.getElementById(this._prefix + id);
			}
			return this._localCache[this._prefix + id];
		},

		start_resize: function(e) {
			document.onmousemove = sy_debug.resize;
			document.onmouseup   = sy_debug.end_resize;
		},

		resize: function(e) {
			var posy = 0;
			if (!e) {
				var e = window.event;
			}
			posy = e.clientY;
			if (posy <= 0) {
				return;
			}
			var  h = document.documentElement.clientHeight;
			var new_height = h - posy - 34;
			sy_debug.get('console_content').style.height = new_height + 'px';
			sy_debug.get('console').style.height         = new_height + 'px';
		},

		end_resize: function(e) {
			document.onmousemove = null;
			document.onmouseup   = null;
			sy_debug.set_last_height(sy_debug.get('console').style.height);
		},

		log_filter: function(element, color) {
			var checked = (element.className === 'sy_debug_filter_checked');
			var div     = this.get('log_content');
			var rows    = div.getElementsByTagName('tr');
			var display = checked ? 'none' : 'table-row';
			if (checked) {
				element.style.backgroundColor = '#CCC';
				element.style.borderColor     = '#DDD';
				element.className             = 'sy_debug_filter_unchecked';
			} else {
				element.style.backgroundColor = '#ABC8E2';
				element.style.borderColor     = '#375D81';
				element.className             = 'sy_debug_filter_checked';
			}
			for (var i = 0, length = rows.length; i < length; ++i) {
				if (rows[i].className === 'sy_debug_log_row_' + color) {
					rows[i].style.display = display;
				}
			}
		},

		show_console: function() {
			this.get('resize_bar').style.display         = 'block';
			this.get('resize_bar_wrapper').style.display = 'block';
			this.get('console_content').style.display    = 'block';
			this.get('console').style.display            = 'block';
			this.get('close_button').style.display       = 'block';
		},

		hide_bar: function() {
			this.hide_console();
			this.get('bar').style.display         = 'none';
		},

		hide_console: function() {
			this.hide_all_content();
			this.get('resize_bar').style.display         = 'none';
			this.get('resize_bar_wrapper').style.display = 'none';
			this.get('console_content').style.display    = 'none';
			this.get('console').style.display            = 'none';
			this.get('close_button').style.display       = 'none';
			this.clear_state();
		},

		hide_all_content: function() {
			<?php if ($PHP_INFO): ?>
			this.get('php_content_title').style.color = '#555';
			this.get('php_content').style.display     = 'none';
			<?php endif ?>
			<?php if ($WEB_LOGGER): ?>
			this.get('log_content_title').style.color = '#555';
			this.get('log_content').style.display     = 'none';
			<?php endif ?>
			<?php if ($FILE_LOGGER): ?>
			this.get('file_content_title').style.color = '#555';
			this.get('file_content').style.display     = 'none';
			<?php endif ?>
			<?php if ($QUERY_LOGGER): ?>
			this.get('query_content_title').style.color = '#555';
			this.get('query_content').style.display     = 'none';
			<?php endif ?>
			<?php if ($TIME_RECORD): ?>
			this.get('time_content_title').style.color = '#555';
			this.get('time_content').style.display     = 'none';
			<?php endif ?>
			this.get('var_content_title').style.color = '#555';
			this.get('var_content').style.display     = 'none';
		},

		show_content: function(type) {
			if (type !== null) {
				this.hide_all_content();
				this.get(type + '_content').style.display     = 'block';
				this.get(type + '_content_title').style.color = 'black';
				this.show_console();
				this.set_last_content(type);
			}
		},

		check_local_storage: function() {
			try {
				return 'localStorage' in window && window['localStorage'] !== null;
			}
			catch (e) {
				return false;
			}
		},

		clear_state: function() {
			if (this.check_local_storage()) {
				localStorage.removeItem(this._prefix + 'last_content' + this._suffix);
			}
		},

		restore_last_state: function() {
			this.show_content(this.get_last_content());
			this.get('console_content').style.height = this.get_last_height();
			this.get('console').style.height         = this.get_last_height();
		},

		set_last_content: function(type) {
			if (this.check_local_storage()) {
				localStorage.setItem(this._prefix + 'last_content' + this._suffix, type);
			}
		},

		get_last_content: function() {
			if (this.check_local_storage()) {
				return localStorage.getItem(this._prefix + 'last_content' + this._suffix);
			}
		},

		set_last_height: function(height) {
			if (this.check_local_storage()) {
				localStorage.setItem(this._prefix + 'last_height' + this._suffix, height);
			}
		},

		get_last_height: function() {
			if (this.check_local_storage()) {
				return localStorage.getItem(this._prefix + 'last_height' + this._suffix);
			}
		}
	};

	(function() {
		if (sy_debug.check_local_storage() && localStorage.getItem(sy_debug._prefix + 'last_height' + sy_debug._suffix) === null) {
			sy_debug.set_last_height(sy_debug.get('console').style.height);
		}

		sy_debug.restore_last_state();

		sy_debug.get('resize_bar').onmousedown = sy_debug.start_resize;
	})();
</script>
