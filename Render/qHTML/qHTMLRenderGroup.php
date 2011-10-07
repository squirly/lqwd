<?php
namespace lqwd\Render\qHTML;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class qHTMLRenderGroup implements \lqwd\Render\IRenderGroupRenderer {
	public static function render($renderables) {
		$return = "";
		foreach ($renderables as $renderable) {
			$return .= $renderable->render();
		}
		return $return;
	}
}