<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace lqwd\Element\Head;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Doctype extends \lqwd\Element\Element {
	public static function createHTML5() {
		$doc = new self("!DOCTYPE", false);
    $doc->addAttribute('HTML');
    return $doc;
	}
}