<div style="<?php echo $RESET_CSS ?> height: 30px"></div>
<div id="sy_debug_resize_bar_wrapper" style="<?php echo $RESET_CSS ?> height: 4px; display: none;"></div>
<div id="sy_debug_console" style="<?php echo $RESET_CSS ?> height: 270px; display: none;"></div>

<div style="<?php echo $RESET_CSS ?> position: fixed; bottom: 0; left: 0; width: 100%; font: 11px Verdana, Arial, sans-serif; z-index: 10000;">
	<div id="sy_debug_resize_bar" style="<?php echo $RESET_CSS ?> height: 4px; cursor: n-resize; display: none; background-color: #e8e8e8;"></div>
	<div id="sy_debug_bar" style="<?php echo $RESET_CSS ?> border-top: 1px solid #999; height: 30px; background-color: #e8e8e8; background-image: -moz-linear-gradient(-90deg, #e8e8e8, #cbcbcb);background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e8e8e8), to(#cbcbcb));">
		<a id="sy_debug_php_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555; line-height: 30px;" onclick="sy_debug.show_content('php'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle;" alt="PHP Info" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAQCAYAAAABOs/SAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkZBOUZFOEU5MTM1QzExRTBCODRDODdCMDc4MjdGNkQ1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkZBOUZFOEVBMTM1QzExRTBCODRDODdCMDc4MjdGNkQ1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RkE5RkU4RTcxMzVDMTFFMEI4NEM4N0IwNzgyN0Y2RDUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RkE5RkU4RTgxMzVDMTFFMEI4NEM4N0IwNzgyN0Y2RDUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4qKkNXAAAF20lEQVR42nxVa2wc1Rk989qdnfXG2bXX9tqOrTws51FETEKISyPTgBKqKhGIgBDh1ap/K/GHovAO/VMJ0R+VEKj8oKqIimgkRKAP0YQ6lrFIiBUHJ7ETcJysN17va3Z23rPz4ptNgihI/aSr0dw7957vfud8Z5hXX3kJlrsanDiItqSAwYE04rHV6MoKyGalhCgmtqiqe2dN1kaqNXWoKhvdct1Ypep23DQdxjBtW9csVVGNsmXWv9a00lnLNr/0TP2C19RNt6nBdW3YZh2OY8FrNhCGIXh8P0KAZRkkEuxWP8DjXy8o+xeXrg0tXW9AVkzYjg+PFlalUuC4GDTNpUMSECSpL5vIbAqC3jG3uR66VkO9em2hVlr82DLl94LAn8YP4n+ABYHbZNney1cLxQOL+QZfb9jwCYjjGBpslBcyq9tglE/A0OtYM/wgVioWaLkVLMtDTKSQSLYj2712vb1++zOlwoXfXrn0+YemXjlMNz1/C4vbvXsXHS6CF9t/ZTaZv8/ON7ZfLWgsx4uQpAQSNMS4CIbl0Gx6yKZ5HH3vNWi6htu2HwBNRZDwXBexWIyAE+B5AbwgQBTbsCo9yObWbNlMpXmiUpyvBX6zdXtu0+ZH4TOxZxpW7K1ipSm6XohsRkSgn4JcOgu1eh6Wehkib6CzaxCuU8PUyaNISinEac7RFpCSXKTSaxALC5CXp6CUv4IuzyF0C+jMJMHGOtHVuyUutaX3Xb867YRhMMn1bdh7t8e2ve+4PBPxC4ZDSrTwl7efxXJhAQzjYWnxAsZPfEQAFvp7c5ic+DfSmQzU+gpmZyZx6vN/YnTnNszNTuKTj/6KuBBAVVbwxeS/cOn8OO7YvhOGI6IrNxwJ6b6VwuwE78N6NmA6WeYW6TxPyivCaYZ4+OBv0LNuHxIxF8f+dginp46jL5dG9O2Bxw4hjA9BXTmJP7/5MiyjArlSQC8l9tCTb6BhMPipfApv/+kFXF88g47BB2AYOjbe/ksszP33EOv6wk6W+LsVEU9K9dqNJOJduJqvQDNJVgzT4m5+7iKSSQmmm0C5qqJcLra+7e7uweLiJfTk1mG5bJHodNpzQ7tCTIIfBERzgFg8iWxu4+1sGPjf3TYIQuphFvlrcyQoHgODazHYl4RRPYVzZ7/Ez3btQq0mI9c7AJZrgyQyqKwsQKJEwpCBoigYGt6CjrSEgS4XE8ePkDeI6BkYgWla312OoeBNQ50OguB+4AY8z3molgvUsx6OvPM7SsZHsbiEO3fcjdGxR/DJsSewe89+UjMPKe7hev4icj290FS1tf/Ep0cxffo/qNfKLb0c/PXz0JsZSkxHVFnXtSjZyxd506q/odRL93d09rVAeMZBqZjHxk23YWTHL+B5HtrTPZDah7EiO3j0qeeQ7dmAsqpDoIPu2fM0qb0f38xPISrd2L0PU3dJZEJt6OweItB2SkpveUFU5vPTH6IhF15nR7e2H/ftpcN1uUQLEhxjGUpDw/DmHcj074XUuQs21hGfBso1H7H0KKp6O4nTQ01pwhfvgM+vJXVPIZWSsOEn+5HMjoFtG0GpHmsJShB4xKmnr1w6ibNTR/5AhfkH98C++1CsWONL+aJG7fTzXHeK6+/vx+CGu1BVPFDDU5n8SFut4fsugQYRT613z3Opn310dcSxddsYnLCL+DRbe1hyOyGWIHNxcO70B+6ZiXdfpP2HW5R6fqRYlg4M/7i8ND+pq+nf967ZtqesSDfB+JYaIyOPzP2HwVF962oTUse98OndNiyqnBhJCLbVwJX5CczNfPyZUsu/RJNTP/Lq6AYsw51WldJeRSnfI0mpp5PJ9N5kKtOTkFaRBcZb4iCXoSOZm1q82Q+UkGVb8L0mHFuDUiugWJgtF/MznzbkpXfpi8/+70/ihtGz0WO8aZvjtqF3ypXFrTQ5ynHCiBATB+jZwXHUS5QCtSKV2gkcR9dtoyGbupI3jJUZS69NNR1zJgj9CssJRJf7o0p9K8AA7bjVGh51630AAAAASUVORK5CYII=" />
			PHP <?php echo phpversion() ?>
		</a>
		<a id="sy_debug_var_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('var'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Vars" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAATtJREFUeNqcU0Gqg0AMjZ/eQbEH0IUewIV4BXEjeD9dCvYGUlB056IU3Rf0Ci6c/hc6g/rr7+cHwkySl8xLZkZL05QORKz22jtAkiR0OkigIAjofD7T4/GgsizFLlcV/JLJAKOi4zjsME1zs8KPOHDrw7RXCwLBv0qWZZyLHMmAuq4jIcRHBW4taga3241c1+U9+r5erwrk+76kzri1gIEAII5jdcorWZMKW8aAA17OgRkYhkHLsvza9zoO/OYWQHmeZwYdFZIxKPDrGWhVVTGdKIrY6Xke1XWtrgo26EPyPN+8BTVEy7LU6bquUxiGPxigCHB939P+IZFt2x+vUOL2t8DSNA2D7vc7FUWxSYQNP/bAvXsH2jiO4nK5qMC3za1M08T2MAys+79wOvpxbdt+/I0ckL39V54CDAChFuDJX64gowAAAABJRU5ErkJggg==" />
			Vars
		</a>
		<a id="sy_debug_log_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('log'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Logs" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAABKElEQVR42sSTPa6CQBSFv3lRrCRYACvQxMLCBhsTK5fAGtiAPaGfDbgGNmBCS0PFAqhsoSGSWE1yrTDvxd+E4t1qkrnn3HPPnFEiwpD6YWCNPjUcj0fquhYAz/MUQBRFzwniOH6cMBrJfD4HoKoq6UleKkiS5H7WWstut+N0OmHbNrZt92rURw+01rJerzmfzyyXSy6XC77vf2ei1lpWqxVN02CMwRhDEARUVcXHFfrJbdsyHo8BcByHsiwxxqjfBj4omE6nstlsuF6vWJaFZVl4nkdZlhwOB/U2B1mWSRiGFEWB67pMJhNc16Uoipfgpx6EYUie58xmM/I8fwsGUH2UsywTgMViAUCapnRdp9498x+COI5lu93eL/b7vfomyurfP9NggtsAfaVzbTWryOIAAAAASUVORK5CYII=" />
			Logs <span style="color:red"><?php echo $NB_ERROR ?></span>
		</a>
		<a id="sy_debug_time_content_title" href="#" style="<?php echo $RESET_CSS ?> text-decoration: none; background-color: transparent; color: #555;" onclick="sy_debug.show_content('time'); return false;">
			<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Times" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAABSElEQVR42pyTwZHCMAxFXxxKUAXuIA3gFnJxERxohAt9QAM5EhpwB6rAJdjJXmKThIWdWc1oJvbo/y8p383tdmMfMcYEtKurLCKHfZ33nsMOmAFjraXrunofQmhVdQYmEVkTvwhijPMaOI5jLXLO0XUdIQSjqrOINBuCGGMu4AL03leC+/1eiQBUNZdOzFJjCth7X8GXy6WSee8Zx7F0WHCYGGOy1la1aZpqrs/zPNcaa21ZNAZoi3rf9+ScawL1O6VE3/frLtrNEgFSSm+/9Hq9AnA+n/ktvhKcTqev5GWEHELAOccwDKSUPuYwDDjnCCEAZAAjIgdV3Sh9yhKqSnFmGWEKIRjnHI/HA4Dj8VgBz+ez+mBRnzY7EJFi1WqWvRMXSxf19m2JItKoalZVY62toDXw61sonSwzJlX98zUCNGuH/Sd+BgBGROvHb4RJ6gAAAABJRU5ErkJggg==" />
			<?php echo $MAX_TIME ?>
		</a>
		<img style="<?php echo $RESET_CSS ?> float: none; margin-left: 10px; vertical-align: middle" alt="Memory" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAAAmElEQVR42sSTuwoEIQxFr7JtOgf0n+z9Rhsr/0nB0jKiW00xs7Myj4VNFQj3cAKJGGPgSUk8rNfaeO8vqTjnxAYAAMuynAqXUj4NAKDWen8FKSWstadCIYRjg9YaUkrTsDHm2GAFtNamgP18A2BmKKWmAGaeG+ScpwCt9XdA7x299ylgP//dJQIAEYGI7gNijJcNxN+/8T0A1+E5NmcLfJkAAAAASUVORK5CYII=" />
		<span style="line-height: 30px; color: #555;" title="Peak of memory allocated by PHP"><?php echo memory_get_peak_usage(true) / 1024 ?> KB</span>

		<img id="sy_debug_close_button" style="<?php echo $RESET_CSS ?> float: right; padding-top: 7px; padding-right: 5px; cursor: pointer; display: none; margin-left: 10px; vertical-align: middle" onclick="sy_debug.hide_console()" title="Minimize" alt="minimize" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTM5jWRgMAAAAVdEVYdENyZWF0aW9uIFRpbWUAMi8xNy8wOCCcqlgAAAQRdEVYdFhNTDpjb20uYWRvYmUueG1wADw/eHBhY2tldCBiZWdpbj0iICAgIiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDQuMS1jMDM0IDQ2LjI3Mjk3NiwgU2F0IEphbiAyNyAyMDA3IDIyOjExOjQxICAgICAgICAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp4YXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iPgogICAgICAgICA8eGFwOkNyZWF0b3JUb29sPkFkb2JlIEZpcmV3b3JrcyBDUzM8L3hhcDpDcmVhdG9yVG9vbD4KICAgICAgICAgPHhhcDpDcmVhdGVEYXRlPjIwMDgtMDItMTdUMDI6MzY6NDVaPC94YXA6Q3JlYXRlRGF0ZT4KICAgICAgICAgPHhhcDpNb2RpZnlEYXRlPjIwMDgtMDMtMjRUMTk6MDA6NDJaPC94YXA6TW9kaWZ5RGF0ZT4KICAgICAgPC9yZGY6RGVzY3JpcHRpb24+CiAgICAgIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiCiAgICAgICAgICAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyI+CiAgICAgICAgIDxkYzpmb3JtYXQ+aW1hZ2UvcG5nPC9kYzpmb3JtYXQ+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDUdUmQAAACdSURBVDiN3dKxDYNADIXh36c07MESDEBHJDawR7vb4KSkuwFuCfag41JESCQhJAoFUty5eJ9l2VJKYU+5Xen/AE7LJoRwAboPmauqnlcBoOv7fjMdY3wYIMszigje+9K2LQDTNAHg3H3TlBKqKpsAgPe+NE3DOI4AVFVFzhkzk+e/WQVmpK5rAIZhwMwE4GtgRoC34Rfglzr+kY4HbthSQqXTR/5kAAAAAElFTkSuQmCC" />
	</div>
	<div id="sy_debug_console_content" style="<?php echo $RESET_CSS ?> height: 270px; border-top: 1px solid #999; background-color: #FFF; display: none;">
		<div id="sy_debug_php_content" style="<?php echo $RESET_CSS ?> height: 100%">
			<iframe src="<?php echo $_SERVER['PHP_SELF'] ?>?<?php echo htmlentities($_SERVER['QUERY_STRING']) ?>&amp;phpinfo&amp;sy_debug_log=off" style="width: 100%; height: 100%; border: 0;">
			<p>Your browser does not support iframes.</p>
			</iframe>
		</div>

		<div id="sy_debug_var_content" style="<?php echo $RESET_CSS ?> height: 100%; overflow: auto;">
			<?php foreach ($VARS_ARRAY as $title => $vars) : ?>
				<?php if (!empty($vars)) : ?>
					<h2 style="<?php echo $RESET_CSS ?> font-size: 14px; color: black; margin: 10px;"><?php echo $title ?></h2>
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
								<pre style="margin: 0"><?php echo htmlentities(print_r($v, true)) ?></pre>
								<?php else : ?>
								<?php echo htmlentities($v) ?>
								<?php endif ?>
							</td>
						</tr>
						<?php endforeach ?>
					</table>
				<?php endif ?>
			<?php endforeach ?>

			<h2 style="font-size: 14px; color: black; margin: 10px;">Included Files</h2>
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

		<div id="sy_debug_log_content" style="<?php echo $RESET_CSS ?> height: 100%; overflow: auto; position: relative;">
			<img onclick="sy_debug.get('log_filter_div').style.display = 'block';" style="<?php echo $RESET_CSS ?> position: absolute; top: 2px; left: 3px; cursor: pointer;" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAFdQTFRFJUOELE+cK02YK06ZLE+bIz97JkSFLVGeIz99Iz98JkWHLVGfJUODKkyWKUqRK02XKUuTKkyVJUKBKUqQKEiNJkWIKEiOJEF/J0eLJ0aKJkSG////AAAAHPtAaAAAAB10Uk5T/////////////////////////////////////wBZhudqAAAAeUlEQVR42lzO4RKCQAgE4LXyrNOyrEtj7/2fMyBxJvm33+wAqO/n7f64jofjqWm6vsfy+hd8doLiwpAO4kJyFYgLfUyAlFU8ewcDknY0rpsxDZBcyLiFSSVlbtcxzyYsIQYqlBBcztahhKD9CULQ7gR1E/tnqV8BBgBIlxB0vx1OiAAAAABJRU5ErkJggg==" />
			<div id="sy_debug_log_filter_div" style="<?php echo $RESET_CSS ?> display: none; position: absolute; padding: 3px; background-color: #CCC; border-bottom: 1px solid #AAA; border-right: 1px solid #AAA;">
				<img class="sy_debug_filter_checked" onclick="sy_debug.log_filter(this, 'green')" style="<?php echo $RESET_CSS ?> cursor: pointer; float: none; border: 1px solid #375D81; background-color: #ABC8E2; padding: 2px; vertical-align: middle;" alt="Green" src="data:image/png;base64,<?php echo $FLAGS[Sy\Debug\Log::NOTICE] ?>" />
				<img class="sy_debug_filter_checked" onclick="sy_debug.log_filter(this, 'orange')" style="<?php echo $RESET_CSS ?> cursor: pointer; float: none; margin-left: 10px; border: 1px solid #375D81; background-color: #ABC8E2; padding: 2px; vertical-align: middle;" alt="Orange" src="data:image/png;base64,<?php echo $FLAGS[Sy\Debug\Log::WARN] ?>" />
				<img class="sy_debug_filter_checked" onclick="sy_debug.log_filter(this, 'red')" style="<?php echo $RESET_CSS ?> cursor: pointer; float: none; margin-left: 10px; border: 1px solid #375D81; background-color: #ABC8E2; padding: 2px; vertical-align: middle;" alt="Red" src="data:image/png;base64,<?php echo $FLAGS[Sy\Debug\Log::ERR] ?>" />
				<img onclick="sy_debug.get('log_filter_div').style.display = 'none';" style="<?php echo $RESET_CSS ?> cursor: pointer;" alt="Close" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABx0RVh0U29mdHdhcmUAQWRvYmUgRmlyZXdvcmtzIENTM5jWRgMAAAAVdEVYdENyZWF0aW9uIFRpbWUAMi8xNy8wOCCcqlgAAAQRdEVYdFhNTDpjb20uYWRvYmUueG1wADw/eHBhY2tldCBiZWdpbj0iICAgIiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDQuMS1jMDM0IDQ2LjI3Mjk3NiwgU2F0IEphbiAyNyAyMDA3IDIyOjExOjQxICAgICAgICAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp4YXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iPgogICAgICAgICA8eGFwOkNyZWF0b3JUb29sPkFkb2JlIEZpcmV3b3JrcyBDUzM8L3hhcDpDcmVhdG9yVG9vbD4KICAgICAgICAgPHhhcDpDcmVhdGVEYXRlPjIwMDgtMDItMTdUMDI6MzY6NDVaPC94YXA6Q3JlYXRlRGF0ZT4KICAgICAgICAgPHhhcDpNb2RpZnlEYXRlPjIwMDgtMDMtMjRUMTk6MDA6NDJaPC94YXA6TW9kaWZ5RGF0ZT4KICAgICAgPC9yZGY6RGVzY3JpcHRpb24+CiAgICAgIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiCiAgICAgICAgICAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyI+CiAgICAgICAgIDxkYzpmb3JtYXQ+aW1hZ2UvcG5nPC9kYzpmb3JtYXQ+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDUdUmQAAAB9SURBVDiN1VNBDoAgDCuGB+GL9hT2lb1IfzQvSgCZYPBiEw5raLM24FQVM1im1F8Y+Hxg5gBg62hWZt7TpKrpxBi1h/NO0jQjiMgQBxgdEFEhEBEQUdPAN9nKxBKbG7yBaXCtXccZMqgzP5mYJY5wwL3EUDySNkI+uP9/pgNQQGCwjv058wAAAABJRU5ErkJggg==" />
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
				<?php foreach ($DEBUGGER->getLogs() as $log) : ?>
				<tr class="sy_debug_log_row_<?php echo $COLOR_NAMES[$log->getLevel()] ?>" style="<?php echo $RESET_CSS ?>">
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>">
						<img style="<?php echo $RESET_CSS ?>" alt="<?php echo $log->getType() ?>" src="data:image/png;base64,<?php echo $FLAGS[$log->getLevel()] ?>" />
						<?php echo $log->getLevelName() ?>
					</td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $log->getType() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><span title="<?php echo $log->getFile() ?>"><?php echo basename($log->getFile()) ?></span></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>; text-align: right;"><?php echo $log->getLine() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $log->getClass() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $COLORS[$log->getLevel()] ?>"><?php echo $log->getFunction() ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: <?php echo $S_COLORS[$log->getLevel()] ?>"><pre style="<?php echo $RESET_CSS ?> font: 11px Verdana, Arial, sans-serif;"><?php echo htmlspecialchars($log->getMessage()) ?></pre></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>

		<div id="sy_debug_time_content" style="<?php echo $RESET_CSS ?> height: 100%; overflow: auto;">
			<table style="<?php echo $TABLE_RESET_CSS ?> width: 100%;">
				<tr style="<?php echo $TR_HEAD_CSS ?>">
					<th style="<?php echo $TH_CSS ?>">Time id</th>
					<th style="<?php echo $TH_CSS ?> width: 100px;">Time (ms)</th>
				</tr>
				<?php foreach ($DEBUGGER->getTimes() as $title => $time) : ?>
				<tr style="<?php echo $RESET_CSS ?>">
					<td style="<?php echo $TD_CSS ?> background-color: #DDE4EB"><?php echo $title ?></td>
					<td style="<?php echo $TD_CSS ?> background-color: #EDF3FE; text-align: right; padding-right: 10px;"><?php echo round($time * 1000, 2) ?></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	var sy_debug = {

		_prefix: 'sy_debug_',

		_suffix: '_<?php echo \crc32('http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'])) ?>',

		get: function(id) {
			return document.getElementById(this._prefix + id);
		},

		start_resize: function(e) {
			document.onmousemove = sy_debug.resize;
			document.onmouseup = sy_debug.end_resize;
		},

		resize: function(e) {
			var posy = 0;
			if (!e) var e = window.event;
			posy = e.clientY;
			if (posy <= 0) return;
			var  h = document.documentElement.clientHeight;
			var new_height = h - posy - 34;
			sy_debug.get('console_content').style.height = new_height + 'px';
			sy_debug.get('console').style.height = new_height + 'px';
		},

		end_resize: function(e) {
			document.onmousemove = null;
			document.onmouseup = null;
			sy_debug.set_last_height(sy_debug.get('console').style.height);
		},

		log_filter: function(element, color) {
			var checked = (element.className === 'sy_debug_filter_checked');
			var div = this.get('log_content');
			var rows = div.getElementsByTagName('tr');
			var display = checked ? 'none' : 'table-row';
			if (checked) {
				element.style.backgroundColor = '#CCC';
				element.style.borderColor = '#DDD';
				element.className = 'sy_debug_filter_unchecked';
			} else {
				element.style.backgroundColor = '#ABC8E2';
				element.style.borderColor = '#375D81';
				element.className = 'sy_debug_filter_checked';
			}
			for (var i = 0; i < rows.length; ++i) {
				if (rows[i].className === 'sy_debug_log_row_' + color)
					rows[i].style.display = display;
			}
		},

		show_console: function() {
			this.get('resize_bar').style.display = 'block';
			this.get('resize_bar_wrapper').style.display = 'block';
			this.get('console_content').style.display = 'block';
			this.get('console').style.display = 'block';
			this.get('close_button').style.display = 'block';
		},

		hide_console: function() {
			this.hide_all_content();
			this.get('resize_bar').style.display = 'none';
			this.get('resize_bar_wrapper').style.display = 'none';
			this.get('console_content').style.display = 'none';
			this.get('console').style.display = 'none';
			this.get('close_button').style.display = 'none';
			this.clear_state();
		},

		hide_all_content: function() {
			this.get('php_content_title').style.color = '#555';
			this.get('var_content_title').style.color = '#555';
			this.get('log_content_title').style.color = '#555';
			this.get('time_content_title').style.color = '#555';
			this.get('php_content').style.display = 'none';
			this.get('var_content').style.display = 'none';
			this.get('log_content').style.display = 'none';
			this.get('time_content').style.display = 'none';
		},

		show_content: function(type) {
			if (type !== null) {
				this.hide_all_content();
				this.get(type + '_content').style.display = 'block';
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
			this.get('console').style.height = this.get_last_height();
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

	(function(){
		if (sy_debug.check_local_storage() && localStorage.getItem(sy_debug._prefix + 'last_height' + sy_debug._suffix) === null) {
			sy_debug.set_last_height(sy_debug.get('console').style.height);
		}

		sy_debug.restore_last_state();

		sy_debug.get('resize_bar').onmousedown = sy_debug.start_resize;
	})();
</script>
