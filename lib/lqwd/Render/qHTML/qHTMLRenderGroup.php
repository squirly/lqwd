<?php
namespace lqwd\Render\qHTML;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class qHTMLRenderGroup implements \lqwd\Render\IRenderGroupRenderer {
  public static function render($renderables, $added = null, $removed = null) {
    $return = "";
    foreach ($added as $renderable) {
      $id = self::getPrevious($renderable, $renderables);
      $return .= '+'.$id.$renderable->render();
      if ($id) unset($renderables[$id]);
    }
    foreach ($removed as $renderable) {
      $return .= '-'.$renderable->render();
    }
    foreach ($renderables as $renderable) {
      
      $return .= $renderable->render();
    }
    return $return;
  }
  
  private static function getPrevious($value, $renderables) {
    $found = false;
    end($renderables);
    while (!$found) {
      $found = current($renderables) == $value;
      if (prev($renderables) === false) return '';
    }
    return key($renderables);
  }
}