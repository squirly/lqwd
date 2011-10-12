<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace lqwd\Render;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class RenderGroup extends Renderable {
  private $renderables = array();

	/**
	 * @return RenderGroup
	 */
	public static function create() {
		return new self;
	}

	public function hasChanged() {
		$return = false;
		foreach ($this->renderables as $renderable) {
			$return |= $renderable->isNew();
		}
		return $return;
	}

	public function add(Renderable $renderable) {
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
			unset($this->renderables[$id]);
		} else {
			unset($this->renderables[$renderable]);
		}
		return $this;
	}

	public function clear() {
		$this->renderables = array();
    return $this;
	}

	protected function getRenderArgs() {
		return array($this->renderables);
	}

	public function getId() {
		return null;
	}

	public function count() {
		return count($this->renderables);
	}
}