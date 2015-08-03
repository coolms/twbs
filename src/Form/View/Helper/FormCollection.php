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
     * @param ElementInterface $element
     * @return string
     */
    protected function getControl(ElementInterface $element)
    {
        $btnHelper  = $this->getView()->plugin('btn');
        $iconHelper = $this->getView()->plugin('icon');

        if ($element instanceof Collection && $element->allowAdd()) {
            return $btnHelper($iconHelper('plus'), [
                'class'   => 'btn-success btn-xs',
                'onclick' => "return CmsCommon.Form.Collection.addFieldset(this, 'prepend');",
            ]);
        } elseif ($element instanceof FieldsetInterface &&
            !$element instanceof Collection &&
            $element->getOption('allow_remove')
        ) {
            return $btnHelper($iconHelper('minus'), [
                'class'   => 'btn-danger btn-xs',
                'onclick' => 'return CmsCommon.Form.Collection.removeFieldset(this);',
            ]);
        }
    }
}
