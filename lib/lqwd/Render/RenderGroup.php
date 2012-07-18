<?php
namespace lqwd\Render;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class RenderGroup extends Renderable {
  private $renderables = array();
  private $added = array();
  private $removed = array();

  /**
   * @return RenderGroup
   */
  public static function create() {
    return new self;
  }

  public function hasChanged() {
    return count($this->added);
  }

  public function add(Renderable $renderable) {
    $this->added[] = $renderable;
    $id = $renderable->getId() ? $renderable->getId() : null;
    if ($id === null) $this->renderables[] = $renderable;
    else {
      if (isset($this->renderables[$renderable->getId()])) {
        unset($this->renderables[$renderable->getId()]);
      }
      $this->renderables[$renderable->getId()] = $renderable;
    }
    return $this;
  }

  public function getRenderables() {
    return $this->renderables;
  }

  public function remove($renderable) {

    if ($renderable instanceof Renderable) {
      $id = $renderable->getId();
      if ($id === null) $id = \array_search($renderable, $this->renderables);
    } else {
      $id = $renderable;
    }
    $this->removed[] = $this->renderables[$id];
    unset($this->renderables[$id]);
    return $this;
  }

  public function clear() {
    $this->removed = $this->renderables;
    $this->renderables = array();
    return $this;
  }

  protected function getRenderArgs() {
    $args = array($this->renderables, $this->added, $this->removed);
    $this->added = array();
    $this->removed = array();
    return $args;
  }

  public function getId() {
    return null;
  }

  public function count() {
    return count($this->renderables);
  }
}