<?php
namespace lqwd\Element\Body;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Navigation extends Div {
	public static function create($id = null) {
		return new self('nav', $id);
	}
}