<?php
namespace lqwd\Render\qHTML;

/**
 * Description of TextRenderer
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class qHTMLText implements \lqwd\Element\ITextRenderer {
    public static function render($text) {
			/**
			 * @todo Use HTML Purifier
			 */
			return \str_replace('|', '&#124;', $text);
		}
}