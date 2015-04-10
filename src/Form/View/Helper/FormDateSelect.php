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

use CmsCommon\Form\View\Helper\FormDateSelect as BaseFormDateSelect,
    CmsCommon\View\Helper\Decorator\DecoratorProviderInterface;

class FormDateSelect extends BaseFormDateSelect implements DecoratorProviderInterface
{
    /**
     * @var array
     */
    protected $decoratorSpecification = [
        'element'   => ['type' => 'formControl'],
        'inline'    => ['type' => 'formInline'],
        'label'     => ['type' => 'controlLabel', 'placement' => false], // disabled by default, using fieldset with legend
        'help'      => ['type' => 'helpBlock'],
        'fieldset'  => ['type' => 'fieldset'],
        'col'       => ['type' => 'formGroupCol'],
        'row'       => ['type' => 'formGroup', 'class' => 'form-group-sm'],
    ];

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
