<?php 
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * Turn off strict options mode
     *
     * @var bool
     */
    protected $__strictMode__ = false;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var string
     */
    protected $version = '3.3.2';

    /**
     * @var int
     */
    protected $useCdn = false;

    /**
     * @var array
     */
    protected $files = [
        'js/bootstrap.min.js'
    ];

    /**
     * @var array
     */
    protected $cdnFiles = [
        '//maxcdn.bootstrapcdn.com/bootstrap/%s/js/bootstrap.min.js'
    ];

    /**
     * @var array
     */
    protected $cssFiles = [
        'css/bootstrap-ext.min.css',
    ];

    /**
     * @var array
     */
    protected $cssCdnFiles = [
        '//maxcdn.bootstrapcdn.com/bootstrap/%s/css/bootstrap.min.css',
        '//maxcdn.bootstrapcdn.com/bootstrap/%s/css/bootstrap-theme.min.css'
    ];

    /**
     * @var array
     */
    protected $plugins = [];

    /**
     * {@inheritDoc}
     */
    public function setEnabled($flag = true)
    {
        $this->enabled = (bool) $flag;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritDoc}
     */
    public function setVersion($version)
    {
        $this->version = (string) $version;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * {@inheritDoc}
     */
    public function setUseCdn($flag)
    {
        $this->useCdn = (bool) $flag;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUseCdn()
    {
        return $this->useCdn;
    }

    /**
     * {@inheritDoc}
     */
    public function setFiles($files)
    {
        $this->files = (array) $files;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * {@inheritDoc}
     */
    public function setCdnFiles($files)
    {
        $this->cdnFiles = (array) $files;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCdnFiles()
    {
        return $this->cdnFiles;
    }

    /**
     * {@inheritDoc}
     */
    public function setCssFiles($files)
    {
        $this->cssFiles = (array) $files;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCssFiles()
    {
        return $this->cssFiles;
    }

    /**
     * {@inheritDoc}
     */
    public function setCssCdnFiles($files)
    {
        $this->cssCdnFiles = (array) $files;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCssCdnFiles()
    {
        return $this->cssCdnFiles;
    }

    /**
     * {@inheritDoc}
     */
    public function setPlugins($plugins)
    {
        $this->plugins = (array) $plugins;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPlugins()
    {
        return $this->plugins;
    }
}
