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
		$flag = array(
			'green'  => 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAG2SURBVHjanJJPSwJRFMXPhGPNjP9B0UIFtXDhRtpJbSQX7WvVB+hjVIsgty6F1gW1kcA2LSLC3YDhohYtFARFUNCYERWb7ntTETaQeeEMw5s3v3fueVcwDAO5q9wOgC3SJilJSsCsV9ILSSU9ku4wUwIDZC+zRiAQgKZpkGUZLpcLiqzg3XjHaDRCv99Hp9NBJBIRPG4P3B4338fKxh52ux3pdBqqqkIUxW+6w+GA3+9HLBZDPp/HZDI5puVTUpyUIe0usY1OpxPzFB10NJ1Ox+TwOZVKnbdarT3uQJKkP3/2er0Ih8P42UIwGAR3QNS5ALPl8/lMQLfbXQjwHSL1gnq9jkajwW9iOBxCEAR+G8xmNBq1BPR6PdPB2gAIPvWx/aSxxXUCyLquy+12e71arZ6USiXL0+m7OQdq8dBY3djEzUURDwdJgYXK5kBWZB5woVAwQqEQmwMk4gkM3gbcca1WM1sYj8ew2Vc4tVwuWx2232w2d0mZSqWS/JzOCumWA1jPoqSYfZ31rADXn/pVPANN17EszTdMlgCdkhdXlMUBrIWvDBYCUIj3xZND9nr/X8CHAAMArOyfOoL0KqQAAAAASUVORK5CYII=',
			'orange' => 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAHXSURBVHjanJLdSyJRGMafCbVxJsnNlG31Yk1dorICL4JYgiKCWGIvtv6G/oXuyoui226DLncLrCAIghDqIuwDjIWIwtUmtgxKtwybmRpsp3dmiqSEygee4XDOe37vxxlGVVUcRpgeAF/JIXID2Q9DSfIBOU5eJ0fxTIwG+DPLqLy7B5wSBWtzgq1pBrgW3BRsuBHzkLJ7ENNRBFqDDKq7AXsXnQefAMnFetX/neBxH2BxA9YvOgB80FjTXmTYh6YmhOnOGJkC0UHuq9AoFnsQbxHLVY3c/TcprKNt/2P7+PTfM++ASTsw8d5XLzudQH0jxRW18MGzCb2Cwt3r2V2ul3u2Wq8ByGeEN1VQSnoLF8e7OE9E8W8fyF1lIIpnNN4YeHsd7J4QHL5euEoA8lnBqEDOKTiOLWF7249sRgnIUoGTxVsumz4KJLfmw1u/hkpmvzzZNSpwOL7h0+cQ4hun6P/hThY9o7YeXQh3juzsAB7fNVzVwLnwGyeJGUiXggFQFAUmC6tTIz/T9NW8WpxsMJVCXyoldGBlsuHh74yRl3WALMswW3kjckItVe3cg19In4EoSai02lCOdIAkijCzfPkArYXHGZQFoCGuTYX1p1p7L+BegAEAbQueCxYYEccAAAAASUVORK5CYII=',
			'red'    => 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAG8SURBVHjanJJNSwJRFIbfydFxRqcPDUGtVRaJrXInbYJatK9duyD/gjtrUT9CaN2mXYs2LQKjRTTRrpARhBJk0AhGx5LR27nXokih8sA7c+fcM889H1dijAHZ9TUAK6Q0aZGUQN9M0gPJIF2SzvHDJA7o7qwyKRKB9PgIeL2QxseBUAhMUYBeD8y2wSwLHlmWEIsB0SgwNSUAMn+4Ph+U5WWgXCaP/EXXNGBiQryNXA6pTGYPpnlAmqPtDGljjAcyHvgHY91u3u10OiwQuPcsLR2VS6VNcRxT1V9/1nUdKul7CdrMDEQGruv+CfDT/NPTfcBrvf4rIBgMDvWLElrUfdU04TQaeK3VQGVSByX4qIH+eBxaIjE0A36wANgeht7LM27DCpL31jy5qtz/1mzG7Wp1G9fX+VQyOQBwnp7698AoZFlsIY3T4wJ23zSJj47fAzFrWt8dHrIwfU/OzkJPpWBThi+VCho3N/0MeMqyzy+oRrE4rNQty7I2SBkYxuLH7bwinQlAu92GVw2IyHSZDQOcfGjAxBRajgNF1TGKCYDTasHrD4wO4CV89mAkADXxorCf5cuL/wLeBRgAvMqbUZE/RYEAAAAASUVORK5CYII=',
		);
		$flags = array(
			Log::EMERG  => $flag['red'],
			Log::ALERT  => $flag['red'],
			Log::CRIT   => $flag['red'],
			Log::ERR    => $flag['red'],
			Log::WARN   => $flag['orange'],
			Log::NOTICE => $flag['green'],
			Log::INFO   => $flag['green'],
			Log::DEBUG  => $flag['green'],
		);
		$this->setVar('FLAGS', $flags);
	}

}