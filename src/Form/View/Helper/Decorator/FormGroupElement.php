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
     * {@inheritDoc}
     */
    public function render(
        $content,
        array $attribs = [],
        ElementInterface $element = null,
        FormInterface $form = null
    ) {
        if (is_string($content) && $element && $form) {
            $elements = $this->getFieldsetElements($element, $form);
            if (!isset($elements[$content])) {
                return '';
            }

            $content = $elements[$content];
        }

        if ($content instanceof ElementInterface) {
            $helper = $this->getElementHelper();
            $decorators = (array) $content->getOption($helper->getDecoratorNamespace());
            // Disable row decorator
            $decorators['row']['placement'] = false;
            $content->setOption('__rendered__', null);
            $content->setOption($helper->getDecoratorNamespace(), $decorators);
        }

        $markup = parent::render($content, $attribs, $element, $form);

        if ($content instanceof ElementInterface) {
            if ($this->isElementHasError($content, $form)) {
                $element->setOption('has_error', true);
            }

            if ($content->getOption('has_feedback')) {
                $element->setOption('has_feedback', true);
            }
        }

        return $markup;
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
            $this->elementHelper = $this->view->plugin('formRow');
        }

        if (!$this->elementHelper instanceof FormRow) {
            $this->elementHelper = new FormRow();
            $this->elementHelper->setView($this->getView());
        }

        return $this->elementHelper;
    }
}
