<?php 
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\View\Helper\Plugin;

use CmsJquery\Plugin\JQueryPluginableInterface,
    CmsJquery\Plugin\JQueryPluginableTrait,
    CmsJquery\View\Helper\Plugin\AbstractPlugin,
    CmsTwbs\Options\ModuleOptionsInterface;

/**
 * @author Dmitry Popov <d.popov@altgraphic.com>
 *
 * @method Twbs setOptions(\CmsTwbs\Options\ModuleOptionsInterface $options)
 */
class Twbs extends AbstractPlugin implements JQueryPluginableInterface
{
    use JQueryPluginableTrait;

    /**
     * @var string
     */
    protected $basePath = '';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $options = $this->getOptions();

        if (!$options['enabled']) {
            return;
        }

        $this->headMeta()->appendHttpEquiv('X-UA-Compatible', 'IE=Edge', ['conditional' => 'IE'])
            ->appendName('viewport', 'width=device-width, initial-scale=1.0');

        if ($options['use_cdn']) {
            $files = $options['cdn_files'];
            $cssFiles = $options['css_cdn_files'];
            $html5shiv = '//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js';
            $respond = '//oss.maxcdn.com/respond/1.4.2/respond.min.js';
        } else {
            $files = $this->basePath($this->getFiles());
            $cssFiles = array_map([$this, 'basePath'], $this->getCssFiles());
            $html5shiv = $this->basePath('js/html5shiv.min.js');
            $respond = $this->basePath('js/respond.min.js');
        }

        $cssFiles = array_map('sprintf', $cssFiles, array_fill(0, count($cssFiles), $options['version']));
        array_map([$this->headLink(), 'appendStylesheet'], $cssFiles);

        $files = array_map('sprintf', $files, array_fill(0, count($files), $options['version']));
        array_map([$this->headScript(), 'appendFile'], $files);

        $this->headScript()->appendFile($html5shiv, 'text/javascript', ['conditional' => 'lt IE 9'])
            ->appendFile($respond, 'text/javascript', ['conditional' => 'lt IE 9']);

        $this->setupPlugins();
    }

    /**
     * {@inheritDoc}
     */
    public function __invoke($element = null, array $options = [])
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function getNamespace()
    {
        return __NAMESPACE__;
    }
}
