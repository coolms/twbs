<?php 
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\View\Helper;

use CmsJquery\View\Helper\Plugin\AbstractPlugin,
    CmsTwbs\Options\ModuleOptionsInterface;

/**
 * @author Dmitry Popov <d.popov@altgraphic.com>
 *
 * @method Twbs setOptions(\CmsTwbs\Options\ModuleOptionsInterface $options)
 */
class Twbs extends AbstractPlugin
{
    /**
     * @return self
     */
    public function init()
    {
        $options = $this->getOptions();

        if (!$options['enabled']) {
            return $this;
        }

        $this->headMeta()->appendHttpEquiv('X-UA-Compatible', 'IE=Edge', ['conditional' => 'IE'])
            ->appendName('viewport', 'width=device-width, initial-scale=1.0');

        if ($options['use_cdn']) {
            $path = $options['cdn_url'];
            $cssPaths = $options['css_cdn_url'];
            $html5shiv = '//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js';
            $respond = '//oss.maxcdn.com/respond/1.4.2/respond.min.js';
        } else {
            $path = $this->getView()->basePath($options['path']);
            $cssPaths = array_map([$this->getView(), 'basePath'], $options['css_path']);
            $html5shiv = $this->getView()->basePath('assets/cms-twbs/js/html5shiv.min.js');
            $respond = $this->getView()->basePath('assets/cms-twbs/js/respond.min.js');
        }

        foreach ($cssPaths as $cssPath) {
            $this->headLink()->appendStylesheet(sprintf($cssPath, $options['version']));
        }

        $this->headScript()->appendFile(sprintf($path, $options['version']))
            ->appendFile($html5shiv, 'text/javascript', ['conditional' => 'lt IE 9'])
            ->appendFile($respond, 'text/javascript', ['conditional' => 'lt IE 9']);

        return $this;
    }
}
