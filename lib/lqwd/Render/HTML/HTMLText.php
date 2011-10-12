<?php
namespace lqwd\Render\HTML;

/**
 * Description of TextRenderer
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class HTMLText implements \lqwd\Element\ITextRenderer {
    public static  function render($text) {
			return $text;
		}
}