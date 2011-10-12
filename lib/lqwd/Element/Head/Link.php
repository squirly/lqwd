<?php

namespace lqwd\Element\Head;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Link extends \lqwd\Element\Element {
  const A_HREF = 'href';

	public static function create($relationship, $type, $path, $id = null) {
    $link = new self('link', $id);
		$link->addAttributes(array(
				self::A_RELATIONSHIP => $relationship,
				self::A_TYPE => $type,
				self::A_HREF => $path,
		));
    return $link;
	}
}