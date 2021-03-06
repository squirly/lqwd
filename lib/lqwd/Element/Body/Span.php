<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace lqwd\Element\Body;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Span extends \lqwd\Element\Element {
  /**
   *
   * @param <type> $tag
   * @param <type> $id
   * @return Element
   */
  public static function create($id = null) {
    return new self('span', $id);
  }

  public static function createWithText($text, $id = null) {
    return self::create($id)->setInner(\lqwd\Element\Text::create($text));
  }
}