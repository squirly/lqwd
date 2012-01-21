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
	public static function render($tag, array $attributes, array $changes, RenderGroup $inner = null, $forceClose = false) {
		$return = '';
		$innerSeparator = "|";
		$noInner = ';';
		if ($hasChanged) {
			$return += "#$tag";
			foreach ($attributes as $name => $value) $return .= ":$name".(isset($value)?">'$value'":'');
			$innerSeparator = $noInner = '';
		}
		return $return
			.($inner->count() > 0
				?$innerSeparator.$inner->render().$innerSeparator
				:$noInner);
	}
}