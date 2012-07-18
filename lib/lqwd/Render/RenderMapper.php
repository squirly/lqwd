<?php
namespace lqwd\Render;

/**
 * Description of Class
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class RenderMapper implements IRenderMapper {
    public function getRenderManager($mode) {
			switch (\strtolower($mode)) {
				case 'qhtml':
        case 'q':
					return new qHTML\qHTMLRenderManager;
				case 'htm':
				case 'html':
				case 'php':
				default:
					return new HTML\HTMLRenderManager;
			}
		}
}