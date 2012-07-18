<?php

namespace lqwd\Render\qHTML;

use \lqwd\Render\Renderable;

/**
 * Description of ElementRenderer
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class qHTMLElement implements \lqwd\Element\IElementRenderer {
  public static function render($tag, array $attributes, $hasChanged, Renderable $inner, $close) {
    $return = '';
    $innerSeparator = $noInner = '';
    if ($hasChanged || $inner->hasChanged()) {
      $return .= "#$tag";
      foreach ($attributes as $name => $value) $return .= ":$name".(isset($value)?">'$value'":'');
      $innerSeparator = '|';
      $noInner = ';';
    }
    $return = $return
      .($inner->hasChanged()
        ? $innerSeparator.$inner->render().$innerSeparator
        : $noInner.$inner->render());
    return $return;
  }
}