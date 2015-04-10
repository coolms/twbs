<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Form\View\Helper;

use CmsCommon\Form\View\Helper\FormStatic as BaseFormStatic,
    CmsCommon\View\Helper\Decorator\DecoratorProviderInterface;

class FormStatic extends BaseFormStatic implements DecoratorProviderInterface
{
    /**
     * @var array
     */
    protected $decoratorSpecification = [
        'element'   => [
            'type' => 'formControlStatic',
            'decorators' => [
                'col' => ['class' => 'col-sm-8'],
            ],
        ],
        'label'     => ['type' => 'controlLabel', 'class' => 'col-sm-4'],
        'col'       => ['type' => 'formGroupCol'],
        'row'       => ['type' => 'formGroup'],
    ];

    /**
     * Attributes valid for the input tag
     *
     * @var array
     */
    protected $validTagAttributes = [];

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
