<?php
namespace lqwd\Element\Form;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Input extends \lqwd\Element\Element {
	public static function createText($id) {
    return self::create('Text', $id);
	}

  public static function createPassword($id) {
    return self::create('Password', $id);
	}

  public static function createHidden($id) {
    return self::create('Hidden', $id);
	}

	public static function createSubmit($id) {
    return self::create('Submit', $id);
	}

  protected static function create($type, $id) {
    $input = new self('input', $id);
    $input->setAttribute('name', $id);
    $input->setAttribute(self::A_TYPE, $type);
		return $input;
  }

  public function setValue($value) {
    return $this->setAttribute('value', $value);
  }
}