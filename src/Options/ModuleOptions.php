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
     * @var string
     */
    protected $path = 'assets/cms-twbs/js/bootstrap.min.js';

    /**
     * @var string
     */
    protected $cdnUrl = '//maxcdn.bootstrapcdn.com/bootstrap/%s/js/bootstrap.min.js';

    /**
     * @var string
     */
    protected $cssPath = [
        'assets/cms-twbs/css/bootstrap-ext.min.css',
    ];

    /**
     * @var string
     */
    protected $cssCdnUrl = [
        '//maxcdn.bootstrapcdn.com/bootstrap/%s/css/bootstrap.min.css',
        '//maxcdn.bootstrapcdn.com/bootstrap/%s/css/bootstrap-theme.min.css'
    ];

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
    public function setPath($path)
    {
        $this->path = (string) $path;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * {@inheritDoc}
     */
    public function setCdnUrl($url)
    {
        $this->cdnUrl = (string) $url;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCdnUrl()
    {
        return $this->cdnUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function setCssPath($path)
    {
        $this->cssPath = (array) $path;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCssPath()
    {
        return $this->cssPath;
    }

    /**
     * {@inheritDoc}
     */
    public function setCssCdnUrl($url)
    {
        $this->cssCdnUrl = (array) $url;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCssCdnUrl()
    {
        return $this->cssCdnUrl;
    }
}
