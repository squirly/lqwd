<?php

namespace lqwd\Controller;

/**
 * Description of IURIParser
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
interface IURI {
	public static function parse($URI);
	public static function create($page, array $mode, $extra);
	public function getPage();
	public function getExtension();
	public function getExtra();
  public function build();
	public function setPage($value);
	public function setExtension($value);
	public function setExtra($value);
}