<?php
namespace lqwd\Controller;

use \lqwd\Element\Element;

/**
 * Description of ControllerManager
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class ControllerManager {

	/** @var ControllerMapper */
	private $controllerMapper;
	/** @var lqwd\Controller\IRenderMapper */
	private $renderMapper;
	/** @var array */
	private $controllers;
	private $static = array(
		'\lqwd\Element\Element' => array('IdHelper' => '')
	);
	/**
	 * @var lqwd\Controller\IURI
	 */
	private $URI;

	public function __construct( $sessionId, array $config, array $serialize = array()) {
		$this->sessionId = $sessionId;
		$this->URI = isset($config['URI']) ? new $config['URI'] : new URI;
		$this->controllerMapper = new $config['ControllerMapper'];
		$this->renderMapper = isset($config['RenderMapper'])
			?new $config['RenderMapper'] : new \lqwd\Render\RenderMapper;
		$this->static = \array_merge($this->static, $serialize);
	}

	public function processRequest($uriString, $requestData) {
		$this->URI = URI::parse($uriString);
		$renderManager = $this->renderMapper->getRenderManager($this->URI->getExtension());
		$request = new Request($this->URI, $requestData);
		$controller = $this->getController($this->URI->getPage(), $this->URI->getExtra());
		$renderable = $controller->processRequest($request);
    foreach ($this->controllers as $pCon) {
      if ($controller !== $pCon && $pCon->alwaysRebuild())
        $pCon->processRequest($request);
    }
		return $renderable->render($renderManager);
	}

	public function __wakeup() {
		foreach ($this->static as $class => $properties)
			foreach ($properties as $property => $value)
				$class::$$property = $value;
	}

	public function __sleep() {
		foreach ($this->static as $class => $properties)
			foreach ($properties as $property => $value)
				$this->static[$class][$property] = $class::$$property;
			$this->ElementIdHelper = Element::$IdHelper;
		return array_keys(get_object_vars($this));
	}

	/**
	 *
	 * @param string $name
	 * @return Controller
	 */
	public function getController($name, $extra = array()) {
		if ( isset($this->controllers[$name]) ) return $this->controllers[$name];
		$controllerClass = $this->controllerMapper->getClass($name, $extra);
		$name = $controllerClass::CreateName($this->URI);
    $controller = new $controllerClass($name, $this);
    if ($controller->doPersist()) $this->controllers[$name] = $controller;
		return $controller;
	}
	
	public function addController($name, IController $controller) {
		$this->setController($name, $controller);
	}

	public function setController($name, IController $controller) {
		$this->controllers[$name] = $controller;
	}
	
	public function removeController($name) {
		unset($this->controllers[$name]);
	}
}