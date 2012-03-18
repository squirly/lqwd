<?php
namespace lqwd\Render;

/**
 * Description of Renderer
 *
 * @todo add ability to add rendererd and interfaces
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
abstract class Renderable {
	protected $new = true;
	private static $renderer;

	abstract public function getId();

	public function render(RenderManagerAbstract $renderer = null) {
		self::$renderer = ($renderer === null
			?self::$renderer
			:$renderer);
		if (! isset(self::$renderer) ) throw new \Exception('No render manager has been set.');
		$result = call_user_func_array(
			array(self::$renderer->getRenderer($this), 'render'),
			$this->getRenderArgs()
		);
		return $result;
	}

	abstract protected function getRenderArgs();

	public function isNew() {
		return $this->new;
	}

	const NO = 0;
	const THIS = 1;
	const INNER = 2;
	const BOTH = 3;
	abstract public function hasChanged();
}