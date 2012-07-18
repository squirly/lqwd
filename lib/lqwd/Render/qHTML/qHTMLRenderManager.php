<?php
namespace lqwd\Render\qHTML;
/**
 * Description of HTMLRenderManager
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class qHTMLRenderManager extends \lqwd\Render\RenderManagerAbstract {
  public function __construct() {
    $this->mode = "qHTML";
    $this->map = array(
      'lqwd\Element\Element'    => 'lqwd\Render\qHTML\qHTMLElement',
      'lqwd\Element\Text'        => 'lqwd\Render\qHTML\qHTMLText',
      'lqwd\Render\RenderGroup'  => 'lqwd\Render\qHTML\qHTMLRenderGroup',
    );
  }
}