<?php

namespace lqwd\Render\qHTML;

use \lqwd\Render\RenderGroup;

/**
 * Description of ElementRenderer
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class qHTMLElement implements \lqwd\Element\IElementRenderer {
	public static function render($tag, array $attributes, RenderGroup $inner = null) {
		$return = "#$tag";
		foreach ($attributes as $name => $value) $return .= ":$name".(isset($value)?">'$value'":'');
		return $return
			.($inner->count() > 0
				?"|".$inner->render()."|"
				:';');
	}
}