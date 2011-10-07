<?php
namespace lqwd\Controller;

/**
 * Description of Controller
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
abstract class Controller implements IController {
	/**
	 * @var ControllerManager
	 */
	private $ControllerManager;
	/**
	 * @var Controller
	 */
	private $controllers;
	/**
	 * @var lqwd\Render\Renderable
	 */
	protected $renderable;

	public final function __construct($pageName, ControllerManager $cm) {
		$this->ControllerManager = $cm;
		$this->renderable = $this->createRenderable();
	}

	protected abstract function createRenderable();

	/**
	 *
	 * @return ControllerManager
	 */
	protected function getControllerManager() {
		return $this->ControllerManager;
	}

	/**
	 *
	 * @return lqwd\Render\Renderable
	 */
	public function getRenderable() {
		return $this->renderable;
	}
}