<?php
namespace lqwd\Element;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Body extends Element {
	public static function create() {
		return new self('body');
	}
}