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
   * @var lqwd\Render\Renderable
   */
  private $inner;
  /**
   * @var lqwd\Element\Changes
   */
  private $changed=true;
  /**
   * @var bool
   */
  protected $closeTag = true;

  final protected function __construct($tag, $id = null) {
    $this->tag = $tag;
    if ($id === false) $this->noId = true;
    else $this->attributes[self::A_ID] = $id ?: ++self::$IdHelper;
    $this->attributes[self::A_CLASS] = array();
    $this->inner = new \lqwd\Render\RenderGroup;
  }

  public function hasChanged() {
    return $this->changed;
  }

  /**
   *
   * @param string $name The name of the attribute
   * @param mixed $value The value to set the attribute to
   * @return Element Fluent
   */
  public function addAttribute($name, $value = null) {
    $this->changed=true;
    if ($name == self::A_ID) return $this;
    $this->attributes[\strtolower($name)] = $value;
    return $this;
  }
  
  public function addAttributes(array $attributes) {
    $this->changed=true;
    foreach ($attributes as $name => $value) {
      $this->addAttribute($name, $value);
    }
    return $this;
  }
  
  public function setAttribute($name, $value = null) {
    $this->changed=true;
    return $this->addAttribute($name, $value);
  }

  public function addClass($class) {
    $this->changed=true;
    $this->attributes[self::A_CLASS][$class] = '';
    return $this;
  }

  public function removeClass($class) {
    $this->changed=true;
    unset($this->attributes[self::A_CLASS][$class]);
    return $this;
  }

  public function addInner(Renderable $renderable) {
    $this->changed=true;
    $this->inner->add($renderable);
    return $this;
  }

  public function removeInner(Renderable $renderable) {
    $this->changed=true;
    $this->inner->remove($renderable);
    return $this;
  }

  public function clearInner() {
    $this->changed=true;
    $this->inner->clear();
    return $this;
  }
  
  public function setInner(\lqwd\Render\Renderable $inner) {
    $this->changed=true;
    $this->inner = $inner;
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
    $attributes = $this->attributes;
    if ($this->noId) unset($attributes[self::A_ID]);
    $attributes[self::A_CLASS] = implode(' ', array_keys((array)$attributes[self::A_CLASS]));
    if ($attributes[self::A_CLASS] == "")
      unset($attributes[self::A_CLASS]);
    $changed = $this->changed;
    $this->changed = false;
    return array($this->tag, $attributes, $changed, $this->inner, $this->closeTag);
  }

  public function getId() {
    return isset($this->attributes[self::A_ID]) ? $this->attributes[self::A_ID] : null;
  }
}