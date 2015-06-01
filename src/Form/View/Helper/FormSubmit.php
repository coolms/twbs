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

use Zend\Form\FormInterface,
    Zend\Form\View\Helper\FormSubmit as ZendFormSubmit,
    CmsCommon\View\Helper\Decorator\DecoratorProviderInterface;
use Zend\Form\ElementInterface;

class FormSubmit extends ZendFormSubmit implements DecoratorProviderInterface
{
    /**
     * @var array
     */
    protected $decoratorSpecification = [
        'element'   => ['type'  => 'btnSubmit'],
        'col'       => ['type'  => 'formGroupCol'],
        'reset'     => [
            'type'      => 'formGroupElement',
            'content'   => 'reset',
            'order'     => 9050,
            'placement' => 'append',
        ],
        'row'       => ['type'  => 'formGroupRow'],
    ];

    /**
     * {@inheritDoc}
     */
    public function getDecoratorSpecification(ElementInterface $element = null, FormInterface $form = null)
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
