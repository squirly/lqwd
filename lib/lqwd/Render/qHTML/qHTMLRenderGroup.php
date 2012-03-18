<?php
namespace lqwd\Render\qHTML;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class qHTMLRenderGroup implements \lqwd\Render\IRenderGroupRenderer {
	public static function render(array $renderables) {
		$return = "";
		foreach ($renderables as $renderable)
			if ($renderable->hasChanged())
				$return .= $renderable->render();
		return $return;
	}
}