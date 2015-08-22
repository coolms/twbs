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

use CmsCommon\Stdlib\OptionsProviderTrait,
    CmsJquery\View\Helper\Plugins\AbstractPlugin,
    CmsTwbs\Options\ModuleOptionsInterface;

/**
 * @author Dmitry Popov <d.popov@altgraphic.com>
 *
 * @method Twbs setOptions(\CmsTwbs\Options\ModuleOptionsInterface $options)
 * @method \CmsTwbs\Options\ModuleOptionsInterface getOptions()
 */
class Twbs extends AbstractPlugin
{
    use OptionsProviderTrait;

    /**
     * __construct
     *
     * @param ModuleOptionsInterface $options
     */
    public function __construct(ModuleOptionsInterface $options)
    {
        $this->setOptions($options);
    }

    /**
     * @return self
     */
    public function init()
    {
        $options = $this->getOptions();

        if (!$options->getEnabled()) {
            return $this;
        }

        $this->headMeta()->appendHttpEquiv('X-UA-Compatible', 'IE=Edge', ['conditional' => 'IE'])
            ->appendName('viewport', 'width=device-width, initial-scale=1.0');

        if ($options->getUseCdn()) {
            $path = $options->getCdnUrl();
            $cssPaths = $options->getCssCdnUrl();
            $html5shiv = '//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js';
            $respond = '//oss.maxcdn.com/respond/1.4.2/respond.min.js';
        } else {
            $path = $this->getView()->basePath($options->getPath());
            $cssPaths = array_map([$this->getView(), 'basePath'], $options->getCssPath());
            $html5shiv = $this->getView()->basePath('assets/cms-twbs/js/html5shiv.min.js');
            $respond = $this->getView()->basePath('assets/cms-twbs/js/respond.min.js');
        }

        foreach ($cssPaths as $cssPath) {
            $this->headLink()->appendStylesheet(sprintf($cssPath, $options->getVersion()));
        }

        $this->headScript()->appendFile(sprintf($path, $options->getVersion()))
            ->appendFile($html5shiv, 'text/javascript', ['conditional' => 'lt IE 9'])
            ->appendFile($respond, 'text/javascript', ['conditional' => 'lt IE 9']);

        return $this;
    }
}
