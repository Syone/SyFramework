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
		$varsArray['User Constants']      = $constants['user'];
		$varsArray['$_REQUEST Variables'] = $_REQUEST;
		$varsArray['$_GET Variables']     = $_GET;
		$varsArray['$_POST Variables']    = $_POST;
		$varsArray['$_COOKIE Variables']  = $_COOKIE;
		if (session_id ()) $varsArray['$_SESSION Variables'] = $_SESSION;
		$varsArray['$_FILES Variables']   = $_FILES;
		$varsArray['$_SERVER Variables']  = $_SERVER;
		$this->setVar('VARS_ARRAY', $varsArray);

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