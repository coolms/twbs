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

interface ModuleOptionsInterface
{
    /**
     * @param bool $flag
     * @return self
     */
    public function setEnabled($flag = true);

    /**
     * @return bool
     */
    public function getEnabled();

    /**
     * @param string $version
     * @return self
     */
    public function setVersion($version);

    /**
     * @return string
     */
    public function getVersion();

    /**
     * @param bool $flag
     * @return self
     */
    public function setUseCdn($flag);

    /**
     * @return bool
     */
    public function getUseCdn();

    /**
     * @param string $path
     * @return self
     */
    public function setPath($path);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $url
     * @return self
     */
    public function setCdnUrl($url);

    /**
     * @return string
     */
    public function getCdnUrl();

    /**
     * @param array|string $path
     * @return self
     */
    public function setCssPath($path);

    /**
     * @return array
     */
    public function getCssPath();

    /**
     * @param array|string $url
     * @return self
     */
    public function setCssCdnUrl($url);

    /**
     * @return array
     */
    public function getCssCdnUrl();
}
