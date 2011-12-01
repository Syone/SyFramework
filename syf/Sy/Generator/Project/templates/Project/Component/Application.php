<?php
namespace {PROJECT_NAME}\Component;

use Sy\Component\WebComponent,
	Sy\Component\Html\Page,
	Sy\Component\Html\Navigation;

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
		$this->body->setVar('TITLE', '{PROJECT_NAME} - Home Action');
		$home = new WebComponent();
		$home->setTemplateFile(__DIR__ . '/Application/templates/Home.html');
		$this->body->setComponent('CONTENT', $home);
	}

	/**
	 * Initialize Application
	 */
	private function init() {
		$this->setTitle('{PROJECT_NAME}');
		$this->initCss();
		$this->initJs();
		$this->initNavMenu();
	}

	/**
	 * Add CSS links
	 */
	private function initCss() {
		$this->addCssLink('./asset/css/application.css');
	}

	/**
	 * Add JS links
	 */
	private function initJs() {

	}

	/**
	 * Create navigation menu
	 */
	private function initNavMenu() {
		$menu = new Navigation();
		$menu->addItem('Home', $_SERVER['PHP_SELF']);
		$this->body->setComponent('MENU', $menu);
	}

}