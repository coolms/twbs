<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Form\View\Helper;

use Zend\Form\ElementInterface,
    Zend\Form\LabelAwareInterface,
    Zend\Form\View\Helper\FormCheckbox as ZendFormCheckbox,
    CmsCommon\View\Helper\Decorator\DecoratorProviderInterface;

class FormCheckbox extends ZendFormCheckbox implements DecoratorProviderInterface
{
    /**
     * @var array
     */
    protected $decoratorSpecification = [
        'element'   => ['type'  => 'element'],
        'label'     => ['type'  => 'elementLabel'],
        'row'       => ['type'  => 'checkbox'],
    ];

    /**
     * {@inheritDoc}
     */
    public function render(ElementInterface $element)
    {
        if ($element instanceof LabelAwareInterface) {
            if ($element->getLabelOption('always_wrap') !== false) {
                $element->setLabelOption('always_wrap', true);
            }
        }
    
        return parent::render($element);
    }

    /**
     * {@inheritDoc}
     */
    public function getDecoratorSpecification()
    {
        return $this->decoratorSpecification;
    }

    /**
     * @param array $spec
     * @return self
     */
    public function setDecoratorSpecification(array $spec)
    {
        $this->decoratorSpecification = $spec;
        return $this;
    }
}
