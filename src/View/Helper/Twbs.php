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
     * @var string
     */
    protected $basePath = '';

    /**
     * @var array
     */
    protected $plugins = [];

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
     * @return self
     */
    protected function setupPlugins()
    {
        $plugins = $this->getPlugins();
        foreach ($plugins as $plugin => $options) {
            if (is_array($options) && !empty($options['onload'])) {
                $this->getPlugin($plugin, $options);
            }
        }

        return $this;
    }

    /**
     * @param array $plugins
     * @return self
     */
    public function setPlugins(array $plugins)
    {
        $this->plugins = $plugins;
        return $this;
    }

    /**
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }

    /**
     * {@inheritDoc}
     */
    protected function getNamespace()
    {
        return __NAMESPACE__;
    }
}
