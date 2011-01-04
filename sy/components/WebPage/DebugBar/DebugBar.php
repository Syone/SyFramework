<?php
namespace Sy;

class DebugBar extends WebComponent {

	public function __construct() {
		parent::__construct();
		$this->setTemplateFile(__DIR__ . '/DebugBar.tpl', 'php');
		$this->init();
	}

	private function init() {
		// PHP Info
		if (!is_null($this->get('phpinfo'))) {
			phpinfo(INFO_GENERAL | INFO_CREDITS | INFO_CONFIGURATION | INFO_MODULES | INFO_ENVIRONMENT | INFO_LICENSE);
			exit();
		}

		// PHP Variables
		$constants = get_defined_constants(true);
		$vars_array['User Constants']      = $constants['user'];
		$vars_array['$_REQUEST Variables'] = $_REQUEST;
		$vars_array['$_GET Variables']     = $_GET;
		$vars_array['$_POST Variables']    = $_POST;
		$vars_array['$_COOKIE Variables']  = $_COOKIE;
		if (session_id ()) $vars_array['$_SESSION Variables'] = $_SESSION;
		$vars_array['$_FILES Variables']   = $_FILES;
		$vars_array['$_SERVER Variables']  = $_SERVER;
		$vars_array['$_ENV Variables']     = $_ENV;
		$this->setVar('VARS_ARRAY', $vars_array);

		// Files
		$this->setVar('FILES', get_included_files());

		// Debugger
		$debugger = Debugger::getInstance();
		$this->setVar('DEBUGGER', $debugger);
		$nb = $debugger->getNbError();
		switch ($nb) {
			case 0:
				$nbError = '';
				break;
			case 1:
				$nbError = $nb . ' error';
				break;
			default:
				$nbError = $nb . ' errors';
				break;
		}
		$this->setVar('NB_ERROR',  $nbError);

		// Logs
		$colors = array(
			Log::EMERG  => '#F00',
			Log::ALERT  => '#F00',
			Log::CRIT   => '#F00',
			Log::ERR    => '#F00',
			Log::WARN   => '#F80',
			Log::NOTICE => '#FF0',
			Log::INFO   => '#FF0',
			Log::DEBUG  => '#FF0',
		);
		$this->setVar('COLORS', $colors);
	}

}