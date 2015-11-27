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

use Zend\Form\Element\Collection,
    Zend\Form\ElementInterface,
    Zend\Form\FieldsetInterface,
    CmsCommon\Form\View\Helper\FormCollection as BaseFormCollection;

/**
 * Helper for rendering a collection
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class FormCollection extends BaseFormCollection
{
    /**
     * This is the default label-wrapper
     *
     * @var string
     */
    protected $labelWrapper = '<legend class="clearfix" style="padding-top:3px;padding-bottom:3px;vertical-align:middle">%s</legend>';

    /**
     * @var string
     */
    protected $descriptionWrapper = '<div class="help-block">%s</div>';

    /**
     * @var string
     */
    protected $decoratorNamespace = 'twbs';

    /**
     * @param ElementInterface $element
     * @return string
     */
    protected function getControl(ElementInterface $element)
    {
        $btnHelper  = $this->getView()->plugin('btn');
        $iconHelper = $this->getView()->plugin('icon');

        if ($element instanceof Collection && $element->allowAdd() && $element->shouldCreateTemplate()) {
            return $btnHelper($iconHelper('plus'), [
                'class'   => 'btn-success pull-right clearfix',
                'onclick' => "return CmsCommon.Form.Collection.addFieldset(this, 'prepend');",
            ]);
        } elseif ($element instanceof FieldsetInterface &&
            !$element instanceof Collection &&
            $element->getOption('allow_remove')
        ) {
            return $btnHelper($iconHelper('minus'), [
                'class'   => 'btn-danger pull-right clearfix',
                'onclick' => 'return CmsCommon.Form.Collection.removeFieldset(this);',
            ]);
        }
    }
}
