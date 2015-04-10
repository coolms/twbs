<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Form\View\Helper\Decorator;

use CmsCommon\Form\View\Helper\Decorator\AbstractHtmlContainer,
    CmsCommon\View\Helper\Decorator\OrderedDecoratorInterface;

class Checkbox extends AbstractHtmlContainer implements OrderedDecoratorInterface
{
    /**
     * @var string
     */
    protected $defaultClass = 'checkbox';

    /**
     * @var int
     */
    protected $order = 10000;

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return $this->order;
    }
}
