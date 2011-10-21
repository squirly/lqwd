<?php
namespace lqwd\Element;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Form extends Element {
  const A_ACTION = 'action';
  const A_METHOD = 'method';

  const METHOD_GET = 'get';
  const METHOD_POST = 'post';

	public static function createGet($action = null, $id = null) {
    return self::create(self::METHOD_GET, $action, $id);
  }

	public static function createPost($action = null, $id = null) {
    return self::create(self::METHOD_POST, $action, $id);
  }

	protected static function create($method, $action = null, $id = null) {
    $form = new self('form', $id);
    $form->addAttribute(self::A_METHOD, $method);
    if (null !== $action) $form->addAttribute(self::A_ACTION, $action);
		return $form;
  }
}