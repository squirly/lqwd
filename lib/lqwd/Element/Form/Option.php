<?php
namespace lqwd\Element\Form;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Option extends \lqwd\Element\Element {
  public static function create($value, $text) {
    $option = new self('option');
    $option->setAttribute('value', $value);
    $option->addInner(\lqwd\Element\Text::create($text));
		return $option;
  }
}