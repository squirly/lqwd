<?php
namespace lqwd\Render;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Change {
	const ADD = 'add';
	const EDIT = 'edit';
	const REMOVE = 'remove';
	public $type;
	public $id;
	public $change;
}