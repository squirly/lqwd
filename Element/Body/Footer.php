<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace lqwd\Element\Body;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Footer extends Div {
	public static function create($id = null) {
		return new self('footer', $id);
	}
}