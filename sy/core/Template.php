<?php
namespace Sy;

class Template implements ITemplate {

	private $content;

	private $vars;

	private $blockParsed;

	private $blockCached;

	private $actualBlock;

	private $lastBlock;

	public function  __construct() {
		$this->content = '';
		$this->vars = array();
		$this->blockCached = array();
		$this->blockParsed = array();
		$this->actualBlock = '';
		$this->lastBlock = '';
	}

	public function setMainFile($file) {
		$this->content = file_get_contents($file);
	}

	public function setFile($var, $file) {
		$this->content = str_replace('{' . $var . '}', file_get_contents($file), $this->content);
	}

	public function setVar($var, $value, $append = false) {
		if ($append)
			$this->vars['{' . $var . '}'] .= $value;
		else
			$this->vars['{' . $var . '}'] = $value;
	}

	public function parseBlock($block) {
		$this->loadBlock($block);

		$tab = array_merge($this->vars, $this->blockParsed);
		$varkeys = array_keys($tab);
		$varvals = array_values($tab);

		$res = str_replace($varkeys, $varvals, $this->blockCached[$block]);

		if ($block != $this->lastBlock and $block != $this->actualBlock) {
			$this->blockParsed['{' . $block . '}'] = '';
		}

		$this->actualBlock = $block;
		$this->blockParsed['{' . $block . '}'] .= $res;
	}

	public function getRender() {
		$tab = array_merge($this->vars, $this->blockParsed);
		$varkeys = array_keys($tab);
		$varvals = array_values($tab);
		$res =  str_replace($varkeys, $varvals, $this->content);
		$res = preg_replace("/[ \t]*<!-- BEGIN ([a-zA-Z0-9\._]*)\ -->\s*?\n?(\s*.*?\n?)\s*<!-- ELSE \\1 -->\s*?\n?(\s*.*?\n?)\s*<!-- END \\1 -->\s*?\n?/sm", "$3", $res);
		$res = preg_replace("/[ \t]*<!-- BEGIN ([a-zA-Z0-9\._]*)\ -->\s*?\n?(\s*.*?\n?)\s*<!-- END \\1 -->\s*?\n?/sm", "", $res);
		$res = preg_replace('/{[^ \t\r\n}]+}/', "", $res);
		return $res;
	}

	private function loadBlock($block) {
		if (!array_key_exists($block, $this->blockCached)) {
			$reg = "/[ \t]*<!-- BEGIN $block -->\s*?\n?(\s*.*?\n?)\s*<!-- END $block -->\s*?\n?/sm";
			preg_match_all($reg, $this->content, $m);

			$blockContent = $m[1][0];
			$t = explode('<!-- ELSE ' . $block . ' -->', $blockContent);
			$blockContent = $t[0];

			$this->content = preg_replace($reg, "{" . $block . "}", $this->content);
			$this->blockCached[$block] = $blockContent;
			$this->blockParsed['{' . $block . '}'] = '';
			$this->lastBlock = $block;
		}
	}
}