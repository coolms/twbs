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
    Zend\Form\View\Helper\FormSelect as ZendFormSelect,
    CmsCommon\View\Helper\Decorator\DecoratorProviderInterface;

class FormSelect extends ZendFormSelect implements DecoratorProviderInterface
{
/**
     * @var array
     */
    protected $decoratorSpecification = [
        'element'   => ['type' => 'formControl'],
        'icon'      => [
            'placement' => false, // disabled by default
            'decorators' => [
                'inputGroupAddon',
            ],
        ],
        'group'     => ['type' => 'inputGroup'],
        'label'     => ['type' => 'controlLabel'],
        'help'      => ['type' => 'helpBlock'],
        'col'       => ['type' => 'formGroupCol'],
        'row'       => ['type' => 'formGroup'],
    ];

    /**
     * {@inheritDoc}
     */
    public function render(ElementInterface $element)
    {
        if ($element->hasAttribute('class')) {
            $class = $element->getAttribute('class');
            if (strpos($class, 'selectpicker') !== false && $this->getView()->jQuery()->twbs->bootstrapSelect) {
                if (!$element->hasAttribute('data-width')) {
                    $element->setAttribute('data-width', 'auto');
                }
                if (strpos($class, 'btn-') === false) {
                    $class .= ' btn-default';
                }
                $element->setAttribute('data-style', $class);
                $element->setAttribute('class', 'selectpicker');
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
