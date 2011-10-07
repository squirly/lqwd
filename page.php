<?php

require_once 'lib/server.inc';
require_once 'lib/session.php';
require_once 'database/page.php';

abstract class Page {

	public static $val = 'test';
	private $pageData;
	protected $post;
	protected $get;
	private $css = array('/css/layout.css');
	private $javascript = array();
	protected $subURI;

	public function passData($data) {
		$this->pageData = $data;
	}

	public function passPost($post) {
		$this->post = $post;
	}

	public function passGet($get) {
		$this->get = $get;
	}

	public function addCSS($path) {
		$this->css[] = $path;
	}

	public function addJavascript($path) {
		$this->javascript[] = $path;
	}

	public static function parseURI($URI) {

	}

	public static function getPageType($URI) {
		$uri = self::parseURI($URI);
		if ($data = db_Page::loadFromSitePath($uri['base'])) {
			require "page/" . $data->getFilePath() . '.php';
			$class = $data->getClass();
			$page = new $class($uri['extra']);
			$page->passData($data);
		} else {

			$uid = mysql_fetch_array(mysql_query("SELECT `id` from `user` WHERE `login`='" . $uri['base'] . "';"));
			if (isset($uid[0])) {
				require "page/profile.php";
				$page = new Profile($uri['extra'], $uid[0]);
				$page->passData(db_Page::loadFromSiteClass('Profile'));
			}
		}
		if (!isset($page)) {
			require "page/404.php";
			$page = new Error404('');
			$page->passData(db_Page::loadFromSiteClass('Error404'));
		}
		return $page;
	}

	function getNavLinkWidth($pagewidth) {
		return $pagewidth / $this->countNavLinks($session) - 10;
	}

	function countNavLinks() {
		$get = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `page` " .
					"LEFT JOIN `navsessionpage` ON (`page`.`id`=`navsessionpage`.`pid`) " .
					"WHERE `sid`=" . Session::$id . ";"));
		return $get[0];
	}

	public function getHead() {
		require 'render/all/head.php';
	}

	function renderBody() {
		include '/server/render/all/body.php';
	}

	function __construct($pageSubURI) {
		$this->subURI = $pageSubURI;
	}
	abstract function buildPage();
}