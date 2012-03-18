<?php

namespace lqwd\Render\qHTML;

use \lqwd\Render\RenderGroup;
use \lqwd\Render\Renderable;

/**
 * Description of ElementRenderer
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class qHTMLElement implements \lqwd\Element\IElementRenderer {
	public static function render($tag, array $attributes, $hasChanged, RenderGroup $inner = null, $forceClose = false) {
		$return = '';
		if ($hasChanged != Renderable::NO) {
			$return += "#$tag".(isset($attributes['id'])?">".$attributes['id']:'');
			unset($attributes['id']);
			if ($hasChanged & Renderable::THIS) {
				foreach ($attributes as $name => $value) $return .= ":$name".(isset($value)?">'$value'":'');
			}
			if ($hasChanged & Renderable::INNER)
				$return .= ($inner->count() > 0
					?'|'.$inner->render().'|'
					:';');
		}
		return $return;
	}
}