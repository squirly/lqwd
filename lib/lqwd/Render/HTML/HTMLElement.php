<?php

namespace lqwd\Render\HTML;

use \lqwd\Render\RenderGroup;

/**
 * Description of ElementRenderer
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class HTMLElement implements \lqwd\Element\IElementRenderer {
	public static function render($tag, array $attributes, $hasChanged, RenderGroup $inner = null, $forceClose = false) {
    $rends = $inner->getRenderables();
		return self::generateOpeningTag($tag, $attributes)
          .($inner->count() > 0 || $forceClose
            ? self::generateInner($inner).($inner->count() == 1 && \reset($rends) instanceof \lqwd\Element\Text
                ? self::getTab(false, false)
                : self::getTab(false)).
              self::generateClose($tag)
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
    return $inner->count() > 0
      ? $inner->render()
      : '';
  }

  private static function generateClose($tag) {
    return "</$tag>";
  }
}