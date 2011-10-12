<?php

namespace lqwd\Element\Head;

use lqwd\Element\Text;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Script extends \lqwd\Element\Element {

	public static function createWithUri($name, $type, $path) {
		return self::create($name, $type)
			->addAttribute('src', $path)
			->addInner(Text::create(''));
	}

	public static function createWithText($name, $type, $script) {
		return self::create($name, $type)
			->addInner(Text::create($script));
	}

	private static function create($name, $type)
	{
		$instance = new self('script');
		return $instance->addAttribute('type', $type);
	}
}