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

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    CmsTwbs\View\Helper\Twbs;

class TwbsHelperFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return Twbs
     */
    public function createService(ServiceLocatorInterface $helpers)
    {
        $services = $helpers->getServiceLocator();
        /* @var $options \CmsTwbs\Options\ModuleOptionsInterface */
        $options = $services->get('CmsTwbs\\Options\\ModuleOptions');
        return new Twbs($options);
    }
}
