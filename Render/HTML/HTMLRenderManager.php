<?php
namespace lqwd\Render\HTML;
/**
 * Description of HTMLRenderManager
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class HTMLRenderManager extends \lqwd\Render\RenderManagerAbstract {
	public static $depth = 0;
  public static $renderPretty = true;
	public function __construct() {
		$this->mode = "HTML";
		$this->map = array(
			'lqwd\Element\Element'		=> 'lqwd\Render\HTML\HTMLElement',
			'lqwd\Element\Text'				=> 'lqwd\Render\HTML\HTMLText',
			'lqwd\Render\RenderGroup'	=> 'lqwd\Render\HTML\HTMLRenderGroup',
		);
	}
}