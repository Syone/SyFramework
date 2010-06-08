<?php
namespace Sy;

class HylaTemplate implements ITemplate {

	private $template;

	public function  __construct() {
		$this->template = new Template();
	}

	public function setRoot($path) {
		$this->template->set_root($path);
	}

	public function setTemplateFile($fileName) {
		$this->template->set_file('main', $fileName);
	}

	public function setFile($var, $fileName, $append = false) {
		$this->template->set_file($fileName, $fileName);
		$this->template->parse($var, $fileName, $append);
	}

	public function setVar($var, $value, $append = false) {
		$this->template->set_var($var, $value, $append);
	}

	public function getRender() {
		$this->template->parse('out', 'main');
		return $this->template->get('out');
	}

}

class Template {

    private $path;
    private $file;
    private $file_content;

    private $current_file;
    private $tmp_current_file;

    private $remove_unknow_var;

    private $block_cache;
    private $block_parsed;

    private $vars;
    private $funcs;
    private $user_funcs;

    private $l10n_callback;

    function __construct($path = '.') {

        $this->path = $path;

        $this->file = null;
        $this->current_file = null;
        $this->tmp_current_file = null;

        $this->remove_unknow_var = true;

        $this->block_cache = array();
        $this->block_parsed = array();

        $this->l10n_callback = array('self', '_l10n');

        $this->vars = array();
        $this->funcs = array(
            'ucfirst'   => 'ucfirst',
            'ucwords'   => 'ucwords',
            'lower'     => 'strtolower',
            'upper'     => 'strtoupper',
            'trim'      => 'trim',
            'rtrim'     => 'rtrim',
            'ltrim'     => 'ltrim',
            'escape'    => 'htmlspecialchars',
            'cycle'     => array('self', '_func_cycle'),
            'include'   => array('self', '_getFileContent'),
            'l10n'      => &$this->l10n_callback,
        );

        $this->user_funcs = array();
    }

    /**
     *  Import new file
     *  @param  string  $name   File handler
     *  @param  string  $name   Filename
     *  @param  string  $path   Path
     */
    public function importFile($name, $file = null, $path = null) {
        $ret = null;
        $path = $path ? $path : $this->path;
        $file = ($file) ? $file : $name;
        if (!file_exists($path.'/'.$file)) {
            self::error('File « %s » not found !', $path . '/' . $file);
        } else {
            $this->file[$name] = self::_getFileContent($path.'/'.$file);
            $ret = $name;

            // Now, current file is this new file
            $this->current_file = $ret;
        }
        return $ret;
    }

    /**
     *  Set current file
     *  @param mixed    $file   New current file
     */
    public function setCurrentFile($file) {
        $ret = false;
        if (array_key_exists($file, $this->file)) {
            $this->current_file = $file;
        }
        return $ret;
    }

    /**
     *  Set multiple vars
     *  @param  array   $vars   Variable array
     */
    public function setVars(array $vars) {
        foreach ($vars as $key => $val) {
            $this->setVar($key, $val);
        }
    }

    /**
     *  Set var
     *  @param  string  $name   Variable name
     *  @param  string  $value  Variable value
     */
    public function setVar($name, $value) {
        if (is_array($value) || is_object($value)) {
            foreach ($value as $key => $val) {
                if (is_array($val)) {
                    $this->setVar($name . '.' . $key, $val);
                } else
                $this->vars[$name . '.' . $key] = $val;
            }
        } else {
            $this->vars[$name] = $value;
        }
    }

    /**
     *  Remove unknow var ?
     *  @param  bool    $bool   Yes or no
     */
    public function removeUnknowVar($bool) {
        return ($this->remove_unknow_var = $bool);
    }

    /**
     *  Set l10n callback function
     *  @param  string  $function   Function
     */
    public function setL10nCallback($function) {
        $ret = false;
        if (is_callable($function)) {
            $this->l10n_callback = $function;
            $ret = true;
        }
        return $ret;
    }

    /**
     *  Get block content
     *  @param  string  $block_name Block name
     *  @paran  bool    ¢parsed     Parse block ?
     */
    public function get($block_name = null, $parsed = true) {
        return ($parsed) ? $this->render($block_name, false) : $this->_loadBlock($block_name);
    }

    /**
     *  Render block
     *  @param  string  $block_name Block name
     */
    public function render($block_name = null, $render = true) {

        // Load block content...
        $data = $this->_loadBlock($block_name, $block_path);

        // A-t-on un block contenu ?
        if (strpos($data, '<!-- BEGIN') !== false) {
            $reg = "/<!-- BEGIN ([a-zA-Z0-9\._]*) -->(\s*?\n?\s*.*?\n?\s*)<!-- END \\1 -->/sm";
            $data = preg_replace_callback($reg, array('self', '_pregGetBlockContent'), $data);
        }

        // Variable replace
        if ($data && $this->vars) {
            $this->_prepareReplaceArray($search, $replace);

            // Replace var
            $data = str_replace($search, $replace, $data);

            // Run function on var
            // ToDo: optimize [$|_]
            $data = preg_replace('/\{([\$|_|\!|#])([^}]+)(\[a-Z|]?)\}/e', "\$this->_parseFuncVar('$2', '$1')", $data);
        }

        // Get content and add it !
        if ($render) {
            if (!array_key_exists($block_path, $this->block_parsed) || $this->block_parsed[$block_path] == -1) {
                $this->block_parsed[$block_path] = null;
            }

            $this->block_parsed[$block_path] .= $data;
            $data = $this->block_parsed[$block_path];
        }

        return $data;
    }

    /**
     *  Register a user function tpl
     *  @param  string  $name   Name
     *  @param  string  $func   Function
     */
    public function registerFunction($name, $func) {
        $ret = false;
        if (is_callable($func)) {
            $this->user_funcs[$name] = $func;
            $ret = true;
        }
        return $ret;
    }

    /**
     *  Get the available function in tpl
     *  @param  bool    $user_func  With user function if true
     */
    public function getFunctionList($user_func = false) {
        return array_keys(($user_func) ? array_merge($this->funcs, $this->user_funcs) : $this->funcs);
    }

    /**
     *  Get file content
     *  @param string $file  File
     */
    private static function _getFileContent($file) {

        $file = self::_skipQuote($file);

        $content = null;
        if (!file_exists($file)) {
            self::error('File « %s » not found !', $file);
        } else {
            $content = file_get_contents($file);
            $content = preg_replace('/\{\!include\:([^}]+)(\[a-Z|]?)\}/e', "self::_getFileContent('$1')", $content);
        }

        return $content;
    }

    /**
     *  Resolve path block
     *  Block can be in other file, in this case, use the selector «:»
     *  Example :
     *      - Access to toto block in current file :
     *          « toto »
     *      - Access to bar block in foo.tpl :
     *          « foo.tpl:bar »
     *  @param  string  $path           Path to resolve
     *  @param  string  &$file          Reference to file variable
     *  @param  string  &$block_name    Reference to block name
     *  @param  string  &$block_path    Reference to block path
     */
    private function _resolveBlock($path, &$file, &$block_name, &$block_path = null) {
        if (($pos = strpos($path, ':')) === false) {
            $file = $this->current_file;
        } else {
            // File
            $file = substr($path, 0, $pos);
            $block_name = substr($path, $pos + 1);
        }
        
        $block_path = $file . ':' . $block_name;
    }

    /**
     *  Load block content
     */
    private function _loadBlock($block_name, &$block_path = null) {

        // Test file...
        $this->_resolveBlock($block_name, $file, $block_name, $block_path);

        $this->tmp_current_file = $file;

        if (!array_key_exists($block_path, $this->block_cache)) {
            if ($block_name) {
                $reg = "/[ \t]*<!-- BEGIN " . preg_quote($block_name) . " -->\s*?\n?(\s*.*?\n?)\s*<!-- E(LSE|ND) "
                                            . preg_quote($block_name) . " -->\s*?\n?/sm";
                if (!preg_match_all($reg, $this->file[$file], $match, PREG_SET_ORDER)) {
                    self::error('Invalid « %s » block : not found !', $block_name);
                    return null;
                }

                $data = &$match[0][1];
            } else {
                $data = &$this->file[$file];
                $block_name = '.';
            }
        } else {
            $data = $this->block_cache[$block_path];
        }

        $this->block_cache[$block_path] = $data;

        return $data;
    }

    /**
     *  Parse func var
     *  @param  string  $str    Variable with func
     *  @param  int     $pos    Offset while start func
     */
    private function _parseFuncVar($val, $type) {

        // Split on |
        $val = preg_split("/([a-zA-Z0-9]+:'.+?'|[^\|]+)\||$/", $val, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        switch ($type) {
            // Variable
            case '$':
                $name = $val[0];
                (count($val >= 2) ? array_shift($val) : null);
                $funcs = $val;

                // Variable exists ?
                if (!array_key_exists($name, $this->vars)) {
                    return ($this->remove_unknow_var) ? null : '{$' . $val . '}';
                }

                $name = $this->vars[$name];
                break;
            // L10n
            case '_':
                $name = $val[0];
                (count($val >= 2) ? array_shift($val) : null);
                $funcs = $val;

                $name = call_user_func($this->l10n_callback, $name);
                break;
            // Function
            case '!':
                $name = null;
                $funcs = $val;
                break;
            // Comment
            case '#':
                $name = null;
                $funcs = null;
                break;
        }

        if ($funcs) {
            $parameter = $name;
            foreach ($funcs as $func) {

                // Parameter ??
                if ($pos = strpos($func, ':')) {
                    $function = substr($func, 0, $pos);
                    $parameter = self::_extractParam(substr($func, $pos + 1), $name, $parameter);
                } else {
                    $function = $func;
                }

                $parameter = $this->_runFunc($function, $parameter);
            }
        } else {
            $parameter = $name;
        }

        return $parameter;
    }

    /**
     *  Extract parameter from string
     */
    private function _extractParam($str, $original = null, $alternate = null) {

        $param = null;

        // Explode on ,
        if (preg_match_all("/'([^']|('(?!,|$))?)*\'|[^,\r\n]+/", $str, $param)) {
            $param = $param[0];
            foreach ($param as &$f) {
                switch ($f) {
                    // $0 is the first variable
                    case '$0':  $f = $alternate; break;
                    // $1 is the return var from last function
                    case '$1':  $f = $original;  break;
                    default:
                        $f = self::_skipQuote($f);
                        break;
                }
            }
        }

        return $param;
    }

    private function _skipQuote($str) {
        // Delete quote
        $str = trim($str);
        if ($str[0] == "'" && $str[strlen($str) - 1] == "'") {
            $str = substr($str, 1, strlen($str) - 2);
        }
        return stripslashes($str);
    }

    /**
     *  Run internal function
     *  @param  string  $name   Function name
     *  @param  array   $param  Parameter
     */
    private function _runFunc($name, $param = null) {
        $var = null;
        $ok = false;

        // Valid callback function ?
        foreach(array($this->funcs, $this->user_funcs) as $funcs) {
            if (array_key_exists($name, $funcs) && is_callable($funcs[$name])) {
                $param = !is_array($param) ? array($param) : $param;
                $var = call_user_func_array($funcs[$name], $param);
                $ok = true;
                break;
            }
        }

        if (!$ok) {
            self::error('Invalid « %s » function !', $name);
        }

        return $var;
    }

    /**
     *  Callback function for get content block
     *  @param  array   $match  Preg search content
     */
    private function _pregGetBlockContent($match) {

        $out = null;
        $else = false;
        $block_name = $match[1];

        $block_path = $this->tmp_current_file . ':' . $block_name;

        // Block exits ?
        if (array_key_exists($block_path, $this->block_parsed)) {

            if ($this->block_parsed[$block_path] == -1) {
                $else = true;
            } else {
                $out = $this->block_parsed[$block_path];
            }

        } else {
            $else = true;
        }

        // Get else block content
        if ($else && ($pos = strpos($match[2], '<!-- ELSE '.$block_name.' -->')) !== false) {
            $out = substr($match[2], $pos + strlen('<!-- ELSE '.$block_name.' -->'));
        }

        $this->block_parsed[$block_path] = -1;
        return $out;
    }

    /**
     *  Prepare var array
     *  @param  array   $search     Search array
     *  @param  array   $replace    Replace array
     */
    private function _prepareReplaceArray(&$search, &$replace) {

        $i = 0;
        $search = array();
        $replace = array();

        if ($this->vars) {
            foreach ($this->vars as $key => $val) {
                $search[] = '{$'.$key.'}';
                $replace[] = $val;
                $i++;
            }
        }

        return $i;
    }

    /**
     *  L10n default function
     *  Call setL10nCallback method to define your l10n function...
     *  @param  string  $str    String
     */
    private static function _l10n($str) {
        return $str;
    }

    /**
     *  Cycle function
     */
    private static function _func_cycle($even, $odd, $cycle = 2) {
        static $a = array();
        $key = $even . ' - ' . $odd;
        if (!array_key_exists($key, $a)) {
            $a[$key] = 0;
        }
        return (++$a[$key] % $cycle) ? $even : $odd;
    }

    /**
     *  Print error
     */
    private static function error() {
        $param = func_get_args();
        echo '<strong>' . __CLASS__ . ' error : </strong>' . call_user_func_array('sprintf', $param) . "<br />\n";
    }
}

