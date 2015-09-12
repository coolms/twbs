<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Factory\View\Helper;

use CmsJquery\Plugin\AbstractJQueryPluginFactory;

class TwbsPluginHelperFactory extends AbstractJQueryPluginFactory
{
    /**
     * @var string
     */
    protected $pluginClass = 'CmsTwbs\\View\\Helper\\Plugin\\Twbs';

    /**
     * @var string
     */
    protected $optionsClass = 'CmsTwbs\\Options\\ModuleOptions';
}
