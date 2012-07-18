<?php
namespace lqwd\Element;

/**
 * Description of Text
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Text extends \lqwd\Render\Renderable {
	/**
	 * @var string
	 */
	private $text;
	/**
	 * @var bool
	 */
	protected $changed;

	public static function create($text){
		return new self($text);
	}

	protected function __construct($text) {
	 $this->text = $text;
	}

	public function hasChanged() {
		return $this->changed;
	}

	public function setText($text) {
    $this->changed = true;
		$this->text = $text;
		return $this;
	}

	public function getText() {
		return $this->text;
	}

	protected function getRenderArgs() {
		 return array($this->text, $this->changed);
		}

	public function getId() {
		return null;
	}
}