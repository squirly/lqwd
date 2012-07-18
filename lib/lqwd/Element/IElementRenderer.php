<?php
namespace lqwd\Element;

/**
 * Description of IElementRenderer
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
interface IElementRenderer {
  public static function render($tag, array $attributes, $hasChanged, \lqwd\Render\Renderable $inner, $close);}