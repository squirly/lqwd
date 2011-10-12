<?php
namespace lqwd\Element\Form;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Label extends \lqwd\Element\Element {
  const A_FOR = 'for';

  private $text;

  public static function createFor($text, $for) {
    $label = self::create($text);
    $label->setAttribute(self::A_FOR, $for);
    return $label;
  }


	public static function create($text) {
    $label = new self('label');
    $label->addInner($label->text = \lqwd\Element\Text::create($text));
		return $label;
	}

  public function setText($text) {
    $this->text->setText($text);
  }
}