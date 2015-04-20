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

use Zend\Form\Element,
    Zend\Form\ElementInterface,
    Zend\Form\FormInterface,
    CmsCommon\Form\View\Helper\Decorator\AbstractHtmlContainer,
    CmsCommon\View\Helper\Decorator\OrderedDecoratorInterface;

class FormGroup extends AbstractHtmlContainer implements OrderedDecoratorInterface
{
    /**
     * @var string
     */
    protected $defaultClass = 'form-group';

    /**
     * @var int
     */
    protected $order = 10000;

    /**
     * {@inheritDoc}
     */
    public function render($content, array $attribs = [], ElementInterface $element = null, FormInterface $form = null)
    {
        if ($class = $this->getElementStateClass($element, $form)) {
            $attribs = array_merge_recursive(compact('class'), $attribs);
        }

        return parent::render($content, $attribs, $element, $form);
    }

    /**
     * Helper method for retrieving element state class name
     *
     * @param ElementInterface $element
     * @param FormInterface $form
     * @return string
     */
    protected function getElementStateClass(ElementInterface $element, FormInterface $form)
    {
        if (!$form->hasValidated()) {
            return;
        }

        $class = '';
        if ($element->getOption('has_error') || $this->isElementHasError($element, $form)) {
            $class = 'has-error';
        } elseif (!$element instanceof Element\Captcha) {
            $value = $element->getValue();
            if ($element instanceof Element\MonthSelect) {
                $value = trim($value, '-');
            }
            if ($value) {
                $class = $form->getMessages() ? 'has-warning' : 'has-success';
            }
        }

        if ($element->getOption('has_feedback')) {
            $class .= ($class ? ' ' : '') . 'has-feedback';
        }

        return $class;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return $this->order;
    }
}
