<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Filter;

use Assetic\Asset\AssetInterface,
    Assetic\Filter\LessphpFilter as BaseLessphpFilter,
    CmsTwbs\Compiler\Lessc;

/**
 * Loads LESS files using the PHP implementation of less, lessphp.
 * 
 * Less files are mostly compatible, but there are slight differences.
 * 
 * @link https://github.com/Less-PHP/less.php
 * 
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class LessPhpFilter extends BaseLessphpFilter
{
    private $presets = [];
    private $formatter;
    private $preserveComments;

    /**
     * {@inheritDoc}
     */
    public function setPresets(array $presets)
    {
        $this->presets = $presets;
    }

    /**
     * {@inheritDoc}
     */
    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * {@inheritDoc}
     */
    public function setPreserveComments($preserveComments)
    {
        $this->preserveComments = $preserveComments;
    }

    /**
     * {@inheritDoc}
     */
    public function filterLoad(AssetInterface $asset)
    {
        $root = $asset->getSourceRoot();
        $path = $asset->getSourcePath();
        
        $lc = new Lessc;
        if ($root && $path) {
            $lc->importDir = dirname("$root/$path");
        }
        
        foreach ($this->loadPaths as $loadPath) {
            $lc->addImportDir($loadPath);
        }
        
        if ($this->formatter) {
            $lc->setFormatter($this->formatter);
        }
        
        if (null !== $this->preserveComments) {
            $lc->setPreserveComments($this->preserveComments);
        }
        
        $asset->setContent($lc->parse($asset->getContent(), $this->presets));
    }
}
