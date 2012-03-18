<?php
namespace lqwd\Render\HTML;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class HTMLRenderGroup implements \lqwd\Render\IRenderGroupRenderer {
	public static function render(array $renderables) {
		$return = "";
		foreach ($renderables as $renderable) {
			$return .= $renderable->render();
		}
		return $return;
	}
}