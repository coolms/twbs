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

use Zend\Form\ElementInterface,
    Zend\Form\FormInterface,
    CmsCommon\Form\View\Helper\Decorator\AbstractHtmlContainer;

class InputGroupAddon extends AbstractHtmlContainer
{
    /**
     * @var string
     */
    protected $tagName = 'span';

    /**
     * @var string
     */
    protected $defaultClass = 'input-group-addon';

    /**
     * {@inheritDoc}
     */
    public function render($content, array $attribs = [], ElementInterface $element = null, FormInterface $form = null)
    {
        if ($element) {
            $element->setOption('input_group', true);
        }

        return parent::render($content, $attribs, $element, $form);
    }
}
