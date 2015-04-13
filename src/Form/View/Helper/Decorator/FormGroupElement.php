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
    CmsCommon\Form\View\Helper\Decorator\Element,
    CmsTwbs\Form\View\Helper\FormRow;

class FormGroupElement extends Element
{
    /**
     * @param  string|ElementInterface $content
     * @param  array $attribs
     * @param  ElementInterface $element
     * @param  FormInterface $form
     * @return string
     */
    public function render($content, array $attribs = [], ElementInterface $element = null, FormInterface $form = null)
    {
        if (is_string($content) && $element && $form) {
            $elements = $this->getFieldsetElements($element, $form);
            $content  = $this->getFieldsetElementByName($content, $elements);
            if (!$content) {
                return '';
            }
        }

        if ($content instanceof ElementInterface) {
            $helper = $this->getElementHelper();
            if ($decorators = (array) $content->getOption($helper->getDecoratorNamespace())) {
                // Disable row decorator
                $decorators['row']['placement'] = false;
                $content->setOption($helper->getDecoratorNamespace(), $decorators);
            }
        }

        return parent::render($content, $attribs, $element, $form);
    }

    /**
     * @return FormRow
     */
    protected function getElementHelper()
    {
        if ($this->elementHelper) {
            return $this->elementHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementHelper = $this->view->plugin('form_row');
        }

        if (!$this->elementHelper instanceof FormRow) {
            $this->elementHelper = new FormRow();
            $this->elementHelper->setView($this->getView());
        }

        return $this->elementHelper;
    }

    /**
     * {@inheritDoc}
     */
    protected function renderHelper(ElementInterface $element, FormInterface $form = null)
    {
        $elementHelper = $this->getElementHelper();
        return $elementHelper($element);
    }
}
