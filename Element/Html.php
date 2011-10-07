<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace lqwd\Element;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Html extends Element {
	public static function create() {
		return new self('html');
	}
}