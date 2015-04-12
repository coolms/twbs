<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Form\View\Helper\Decorator;

use Zend\Form\ElementInterface,
    Zend\Form\FormInterface,
    Zend\Form\LabelAwareInterface,
    CmsCommon\Form\View\Helper\Decorator\Element;

class Btn extends Element
{
    /**
     * @var string
     */
    protected $tagName = 'button';

    /**
     * @var string
     */
    protected $defaultClass = 'btn';
}
