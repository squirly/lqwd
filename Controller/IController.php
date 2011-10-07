<?php
namespace lqwd\Controller;

/**
 * Description of IController
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
interface IController {
	public static function CreateName(IURI $URI);

	public function processRequest(Request $request);
}