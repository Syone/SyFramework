<?php
namespace Sy;

class Template implements ITemplate {

	private $content;

	private $vars;

	private $blockParsed;

	private $blockCached;

	public function  __construct() {
		$this->content = '';
		$this->vars = array();
		$this->blockCached = array();
		$this->blockParsed = array();
	}

	public function setMainFile($file) {
		$this->content = file_get_contents($file);
	}

	public function setVar($var, $value, $append = false) {
		if ($append)
			$this->vars['{' . $var . '}'] .= $value;
		else
			$this->vars['{' . $var . '}'] = $value;
	}

	public function setBlock($block) {
		if (!$this->loadBlock($block)) return;

		$data = $this->blockCached[$block];
		if (strpos($data, '<!-- BEGIN') !== false) {
            $reg = "/[ \t]*<!-- BEGIN ([a-zA-Z0-9\._]*) -->(\s*?\n?\s*.*?\n?\s*)<!-- END \\1 -->\s*?\n?/sm";
            $data = preg_replace_callback($reg, array($this, 'getBlockContent'), $data);
        }

		$varkeys = array_keys($this->vars);
		$varvals = array_values($this->vars);
		$res = str_replace($varkeys, $varvals, $data);

		$this->blockParsed[$block] .= $res;
	}

	public function getRender() {
		if (strpos($this->content, '<!-- BEGIN') !== false) {
			$reg = "/[ \t]*<!-- BEGIN ([a-zA-Z0-9\._]*) -->(\s*?\n?\s*.*?\n?\s*)<!-- END \\1 -->\s*?\n?/sm";
			$this->content = preg_replace_callback($reg, array($this, 'getBlockContent'), $this->content);
		}

		$varkeys = array_keys($this->vars);
		$varvals = array_values($this->vars);
		$res =  str_replace($varkeys, $varvals, $this->content);
		$res = preg_replace('/{[^ \t\r\n}]+}/', "", $res);
		return $res;
	}

	private function loadBlock($block) {
		if (isset($this->blockCached[$block])) return true;
		$reg = "/[ \t]*<!-- BEGIN $block -->\s*?\n?(\s*.*?\n?)\s*<!-- END $block -->\s*?\n?/sm";
		preg_match_all($reg, $this->content, $m);

		if (!isset($m[1][0])) return false;
		$blockContent = $m[1][0];
		$t = explode('<!-- ELSE ' . $block . ' -->', $blockContent);
		$blockContent = $t[0];

		$this->blockCached[$block] = $blockContent;
		$this->blockParsed[$block] = '';
		return true;
	}

	private function getBlockContent($match) {
		$block = $match[1];
		if (isset($this->blockParsed[$block])) {
			$out = $this->blockParsed[$block];
			$this->blockParsed[$block] = '';
		} else {
			$t = explode('<!-- ELSE ' . $block . ' -->', $match[2]);
			$out = isset($t[1]) ? $t[1] : '';
		}
		return $out;
	}
}