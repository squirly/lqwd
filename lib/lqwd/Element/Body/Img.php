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
class Img extends \lqwd\Element\Element {
	public static function create($url, $alt) {
		$instance = new self('img');
		return $instance->setAttribute('src', $url)->setAttribute('alt', $alt);
	}
}