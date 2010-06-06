<?php
namespace Sy;

class Template implements ITemplate {

	private $root;

	private $content;

	private $vars;

	private $blockParsed;

	private $blockCached;

	private $actualBlock;

	private $lastBlock;

	public function  __construct() {
		$this->root = '';
		$this->content = '';
		$this->vars = array();
		$this->blockCached = array();
		$this->blockParsed = array();
		$this->actualBlock = '';
		$this->lastBlock = '';
	}

	public function getRoot() {
		return $this->root;
	}

	public function setRoot($path) {
		$this->root = rtrim($path, '/\\');
	}

	public function setMainFile($file) {
		$this->content = $this->getFileContent($file);
	}

	public function setFile($var, $file) {
		$this->content = str_replace('{' . $var . '}', $this->getFileContent($file), $this->content);
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
		$res = preg_replace("/[ \t]*<!--\s+BEGIN .+\s+-->\s*?\n?(\s*.*?\n?)\s*<!--\s+END .+\s+-->\s*?\n?/sm", "", $res);
		$res = preg_replace('/{[^ \t\r\n}]+}/', "", $res);
		return $res;
	}

	private function getFileContent($file) {
		$file = empty($this->root) ? $file : $this->root . '/' . $file;
		return file_get_contents($file);
	}

	private function loadBlock($block) {
		if (!array_key_exists($block, $this->blockCached)) {
			$reg = "/[ \t]*<!--\s+BEGIN $block\s+-->\s*?\n?(\s*.*?\n?)\s*<!--\s+END $block\s+-->\s*?\n?/sm";
			preg_match_all($reg, $this->content, $m);
			$this->content = preg_replace($reg, "{" . $block . "}", $this->content);
			$this->blockCached[$block] = $m[1][0];
			$this->blockParsed['{' . $block . '}'] = '';
			$this->lastBlock = $block;
		}
	}
}
?>
