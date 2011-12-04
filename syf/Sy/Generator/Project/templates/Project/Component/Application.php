<?php
namespace {PROJECT_NAME}\Component;

use Sy\Component\WebComponent,
	Sy\Component\Html\Page;

class Application extends Page {

	private $body;

	/**
	 * Application constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->body = new WebComponent();
		$this->body->setTemplateFile(__DIR__ . '/Application/templates/Application.html');
		$this->init();
		$this->actionDispatch(ACTION_TRIGGER, 'home');
	}

	/**
	 * Return Application render
	 *
	 * @return string
	 */
	public function __toString() {
		$this->setBody($this->body);
		return parent::__toString();
	}

	/**
	 * Default action
	 */
	public function homeAction() {
		$this->body->setVar('PROJECT_NAME', '{PROJECT_NAME}');
	}

	/**
	 * Initialize Application
	 */
	private function init() {
		$this->setTitle('Welcome to {PROJECT_NAME}');
	}

}