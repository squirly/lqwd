<?php
namespace lqwd\Configuration;

/**
 * Description of Configuration
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Configuration {
	private $URI;
	private $sessionId;
	private $controllerMapper;

	public function setURI(lqwd\Controller\IURI $uri) {
		$this->URI = $uri;
		return $this;
	}

	public function getURI() {
		return $this->URI;
	}

	public function setControllerMapper(\lqwd\Controller\IControllerMapper $mapper) {
		$this->controllerMapper = $mapper;
		return $this;
	}

	public function getControllerMapper() {
		return $this->controllerMapper;
	}

	public function setSessionId($sessionId) {
		$this->sessionId = $sessionId;
		return $this;
	}

	public function getSessionId() {
		return $this->sessionId;
	}
}
?>
