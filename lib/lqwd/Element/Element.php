<?php

namespace lqwd\Element;

use
	\lqwd\Render\Renderable,
	\lqwd\Render\Renderer;

/**
 * Description of Element
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
abstract class Element extends Renderable {
	public static $IdHelper=0;

	/* Common attribute names */
	const A_CLASS = 'class';
	const A_ID = 'id';
	const A_RELATIONSHIP = 'rel';
	const A_TYPE = 'type';

	/**
	 * @var string
	 */
	protected $tag;
	/**
	 * @var bool
	 */
	protected $noId = false;
	/**
	 * @var array
	 */
	private $attributes = array();
	/**
	 * @var lqwd\Render\RenderGroup
	 */
	private $inner;
	/**
	 * @var lqwd\Element\Changes
	 */
	private $changes;
  /**
	 * @var bool
	 */
  protected $forceCloseTag = false;

	final protected function __construct($tag, $id = null) {
		$this->tag = $tag;
		if ($id === false) $this->noId = true;
		else $this->attributes[self::A_ID] = $id ?: ++self::$IdHelper;
		$this->attributes[self::A_CLASS] = array();
		$this->inner = new \lqwd\Render\RenderGroup;
	}

	public function hasChanged() {
		return $this->changes;
	}

	/**
	 *
	 * @param string $name The name of the attribute
	 * @param mixed $value The value to set the attribute to
	 * @return Element Fluent
	 */
	public function addAttribute($name, $value = null) {
		if ($name == self::A_ID) return $this;
		$this->attributes[\strtolower($name)] = $value;
		return $this;
	}
	
	public function addAttributes(array $attributes) {
		foreach ($attributes as $name => $value) {
			$this->addAttribute($name, $value);
		}
		return $this;
	}
	
	public function setAttribute($name, $value = null) {
		return $this->addAttribute($name, $value);
	}

	public function addClass($class) {
		$this->attributes[self::A_CLASS][$class] = '';
		return $this;
	}

	public function removeClass($class) {
		unset($this->attributes[self::A_CLASS][$class]);
		return $this;
	}

	public function addInner(Renderable $renderable) {
		$this->inner->add($renderable);
		return $this;
	}

	public function removeInner(Renderable $renderable) {
		$this->inner->remove($renderable);
		return $this;
	}

	public function clearInner() {
		$this->inner->clear();
		return $this;
	}

	/**
	 *
	 * @return lqwd\Render\RenderGroup
	 */
	public function getInner() {
		return $this->inner;
	}

	protected function getRenderArgs() {
		$this->changed = false;
		$attributes = $this->attributes;
		if ($this->noId) unset($attributes[self::A_ID]);
		$attributes[self::A_CLASS] = implode(' ', array_keys((array)$attributes[self::A_CLASS]));
		if ($attributes[self::A_CLASS] == "")
			unset($attributes[self::A_CLASS]);
		return array($this->tag, $attributes, $this->hasChanged(), $this->inner, $this->forceCloseTag);
	}

	public function getId() {
		return isset($this->attributes[self::A_ID]) ? $this->attributes[self::A_ID] : null;
	}
}