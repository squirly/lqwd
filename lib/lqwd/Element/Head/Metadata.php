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
class Metadata extends \lqwd\Element\Element {
	public static function createCharacterSet($characterSet) {
		$meta = new self("meta", false);
    $meta->addAttribute('charset', $characterSet);
    return $meta;
	}
}