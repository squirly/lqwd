<?php

namespace lqwd\Render\HTML;

use \lqwd\Render\Renderable;

/**
 * Description of ElementRenderer
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class HTMLElement implements \lqwd\Element\IElementRenderer {
	public static function render($tag, array $attributes, $hasChanged, Renderable $inner, $close) {
		return self::generateOpeningTag($tag, $attributes)
          .($close
            ? self::generateInner($inner).self::getTab(false).self::generateClose($tag)
            : self::getTab(false, false)
          );
	}

  private static function generateOpeningTag($tag, $attributes) {
    return self::getTab()
      ."<$tag".self::generateAttributes($attributes).'>';
  }

  private static function generateAttributes($attributes) {
    $return = '';
    foreach ($attributes as $name => $value) $return .= " $name".(isset($value)?"='$value'":'');
    return $return;
  }

  private static function getTab($increment = true, $show = true) {
    if (!HTMLRenderManager::$renderPretty) return '';
    if ($increment) HTMLRenderManager::$depth++;
    $return = $show
      ? "\n".\str_repeat("  ", HTMLRenderManager::$depth)
      : '';
    if (!$increment) HTMLRenderManager::$depth--;
    return $return;
  }

  private static function generateInner($inner) {
    return $inner->render();
  }

  private static function generateClose($tag) {
    return "</$tag>";
  }
}