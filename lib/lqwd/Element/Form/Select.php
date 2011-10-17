<?php
namespace lqwd\Element\Form;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Select extends \lqwd\Element\Element {
  public static function create($id) {
    $input = new self('select', $id);
    $input->setAttribute('name', $id);
		return $input;
  }

  public function addOption(Option $option) {
    $this->addInner($option);
  }
}