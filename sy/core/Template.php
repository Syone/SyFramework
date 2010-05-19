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

	public function setRoot($path) {
		$this->root = rtrim($path, '/\\');
	}

	public function setTemplateFile($fileName) {
		$this->content = $this->getFileContent($fileName);
	}

	public function setFile($var, $fileName, $append = false) {
		$this->content = str_replace('{' . $var . '}', $this->getFileContent($fileName), $this->content);
	}

	public function setVar($var, $value, $append = false) {
		if ($append)
			$this->vars['{' . $var . '}'] .= $value;
		else
			$this->vars['{' . $var . '}'] = $value;
	}

	public function parseBlock($blockName) {
		$this->loadBlock($blockName);

		$tab = array_merge($this->vars, $this->blockParsed);
		$varkeys = array_keys($tab);
		$varvals = array_values($tab);

		$res = str_replace($varkeys, $varvals, $this->blockCached[$blockName]);

		if ($blockName != $this->lastBlock and $blockName != $this->actualBlock) {
			$this->blockParsed['{' . $blockName . '}'] = '';
		}

		$this->actualBlock = $blockName;
		$this->blockParsed['{' . $blockName . '}'] .= $res;
	}

	public function getRender() {
		$tab = array_merge($this->vars, $this->blockParsed);
		$varkeys = array_keys($tab);
		$varvals = array_values($tab);
		$res =  str_replace($varkeys, $varvals, $this->content);
		$res = preg_replace('/{[^ \t\r\n}]+}/', "", $res);
		$res = preg_replace("/[ \t]*<!--\s+BEGIN .+\s+-->\s*?\n?(\s*.*?\n?)\s*<!--\s+END .+\s+-->\s*?\n?/sm", "", $res);
		return $res;
	}

	private function getFileContent($fileName) {
		$file = empty($this->root) ? $fileName : $this->root . '/' . $fileName;
		return file_get_contents($file);
	}

	private function loadBlock($blockName) {
		if (!array_key_exists($blockName, $this->blockCached)) {
			$reg = "/[ \t]*<!--\s+BEGIN $blockName\s+-->\s*?\n?(\s*.*?\n?)\s*<!--\s+END $blockName\s+-->\s*?\n?/sm";
			preg_match_all($reg, $this->content, $m);
			$this->content = preg_replace($reg, "{" . $blockName . "}", $this->content);
			$this->blockCached[$blockName] = $m[1][0];
			$this->blockParsed['{' . $blockName . '}'] = '';
			$this->lastBlock = $blockName;
		}
	}
}
?>
