<?php
namespace lqwd\Controller;

/**
 * Description of Request
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Request {

	const GET = 'get';
	const POST = 'post';
	const FILE = 'file';

	/**
	 *
	 * @var \lqwd\URI\IURI
	 */
	private $URI;
	/**
	 *
	 * @var array
	 */
	private $data;

	public function __construct(\lqwd\Controller\IURI $URI, array $data = array()) {
		$this->URI = $URI;
		$this->data = $data;
	}

	public function getUri() {
		return $this->URI;
	}

	public function getRequest($mode, array $empty) {
    $keys = \array_fill_keys($empty, null);
		return \array_merge(
      $keys,
      \array_intersect_key($this->data[$mode], $keys)
    );
	}
}