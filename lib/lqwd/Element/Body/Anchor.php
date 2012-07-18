<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace lqwd\Element\Body;

use lqwd\Element\Text;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Anchor extends \lqwd\Element\Element {
	const A_HREF = 'href';

  /** @var \lqwdElement\Body\Anchor */
	public static function createWithText($href, $text) {
		return self::create($href)->setInner(Text::create($text));
	}

	public static function create($href) {
		$element = new self('a');
		return $element->addAttribute(self::A_HREF, $href);
	}

  public function setHref($href) {
    $this->addAttribute(self::A_HREF, $href);
  }
}