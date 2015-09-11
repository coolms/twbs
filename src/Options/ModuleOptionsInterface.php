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
     * @param array $files
     * @return self
     */
    public function setFiles($files);

    /**
     * @return array
     */
    public function getFiles();

    /**
     * @param array $files
     * @return self
     */
    public function setCdnFiles($files);

    /**
     * @return array
     */
    public function getCdnFiles();

    /**
     * @param array|string $files
     * @return self
     */
    public function setCssFiles($files);

    /**
     * @return array
     */
    public function getCssFiles();

    /**
     * @param array|string $files
     * @return self
     */
    public function setCssCdnFiles($files);

    /**
     * @return array
     */
    public function getCssCdnFiles();

    /**
     * @param array|string $plugins
     * @return self
     */
    public function setPlugins($plugins);

    /**
     * @return array
     */
    public function getPlugins();
}
