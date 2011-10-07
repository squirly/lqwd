<?php
namespace lqwd\Render;

/**
 * Description of Renderer
 *
 * @todo add ability to add rendererd and interfaces
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class RenderManagerAbstract {
	private static $interfaces = array(
		'lqwd\Element\Element'		=> 'lqwd\Element\IElementRenderer',
		'lqwd\Element\Text'				=> 'lqwd\Element\ITextRenderer',
		'lqwd\Render\RenderGroup'	=> 'lqwd\Render\IRenderGroupRenderer',
	);

	private static $renderers = array(
		'HTML' => 'lqwd\Render\HTML\RenderManager',
		'qHTML' => 'lqwd\Render\qHTML\RenderManager',
	);

	protected $mode;
	protected $map;

	private function __construct() {}

	public function getRenderer(Renderable $render) {
		$ref = new \ReflectionClass($render);
		foreach ($this->map as $class => $renderer)
			if ( $ref->getName() == $class
				|| $ref->isSubclassOf($class))
				return $renderer;
		return false;
	}

	public function canRender(Renderable $render) {
		return $this->getRenderer($render)?true:false;
	}
}