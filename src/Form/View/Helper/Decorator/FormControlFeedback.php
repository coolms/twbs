<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Form\View\Helper\Decorator;

use Zend\Form\Element,
    Zend\Form\ElementInterface,
    Zend\Form\FormInterface,
    CmsCommon\Form\View\Helper\Decorator\AbstractHtmlContainer,
    CmsCommon\View\Helper\Decorator\OrderedDecoratorInterface,
    CmsCommon\View\Helper\Decorator\PlacedDecoratorInterface,
    CmsCommon\View\Helper\HtmlContainer,
    CmsTwbs\View\Helper\Glyphicon;

class FormControlFeedback extends AbstractHtmlContainer implements OrderedDecoratorInterface, PlacedDecoratorInterface
{
    /**
     * @var string
     */
    protected $tagName = 'span';

    /**
     * @var string
     */
    protected $defaultClass = 'form-control-feedback';

    /**
     * @var HtmlContainer
     */
    protected $feedbackHelper;

    /**
     * @var HtmlContainer
     */
    protected $formControlStatusHelper;

    /**
     * @var string
     */
    protected $defaultFeedbackHelper = 'glyphicon';

    /**
     * @var int
     */
    protected $order = 7500;

    /**
     * @var string
     */
    protected $placement = 'append';

    /**
     * {@inheritDoc}
     */
    public function render($content, array $attribs = [], ElementInterface $element = null, FormInterface $form = null)
    {
        if (!$content && !$form) {
            return '';
        }

        if (!$form || !$element) {
            return parent::render($content, $attribs);
        }

        $content = $content ?: $this->getFeedbackContent($element, $form);
        if (!$content) {
            return '';
        }

        if (strpos($element->getAttribute('class'), 'form-control') !== false && (
            $element instanceof Element\Text ||
            $element instanceof Element\Password ||
            $element instanceof Element\Number ||
            $element instanceof Element\Email ||
            $element instanceof Element\Url
        )) {
            $element->setOption('has_feedback', true);
            if (empty($attribs['aria-hidden'])) {
                $attribs['aria-hidden'] = 'true';
            }
        }

        $feedbackHelper = $this->getFeedbackHelper();
        $content = $feedbackHelper($content, $this->mergeAttributes($attribs));

        if ($element->hasAttribute('aria-describedby')
            && ($status = $this->getStatusContent($element, $form))
        ) {
            $formControlStatusHelper = $this->getFormControlStatusHelper();
            $content .= $formControlStatusHelper(
                    "($status)",
                    ['id' => $element->getAttribute('aria-describedby')]
                );
        }

        return $content;
    }

    /**
     * @return HtmlContainer
     */
    protected function getFeedbackHelper()
    {
        if ($this->feedbackHelper) {
            return $this->feedbackHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->feedbackHelper = $this->view->plugin($this->getDefaultFeedbackHelper());
        }

        if (!$this->feedbackHelper instanceof HtmlContainer) {
            $this->feedbackHelper = new Glyphicon();
            $this->feedbackHelper->setView($this->getView());
        }

        return $this->feedbackHelper;
    }

    /**
     * @return string
     */
    protected function getDefaultFeedbackHelper()
    {
        return $this->defaultFeedbackHelper;
    }

    /**
     * @return HtmlContainer
     */
    protected function getFormControlStatusHelper()
    {
        if ($this->formControlStatusHelper) {
            return $this->formControlStatusHelper;
        }

        if (!$this->formControlStatusHelper instanceof HtmlContainer) {
            $this->formControlStatusHelper = new HtmlContainer();
            $this->formControlStatusHelper->setView($this->getView());
        }

        $this->formControlStatusHelper->setTagName('span')
            ->setAttribute('class', 'sr-only');

        return $this->formControlStatusHelper;
    }

    /**
     * Helper method for retrieving element's feedback content
     *
     * @param ElementInterface $element
     * @param FormInterface $form
     * @return void|string
     */
    protected function getFeedbackContent(ElementInterface $element, FormInterface $form)
    {
        if (!$form->hasValidated()) {
            return;
        }

        if ($this->isElementHasError($element, $form)) {
            return 'remove';
        }

        if ($element->getValue()) {
            return $form->getMessages() ? 'warning-sign' : 'ok';
        }
    }

    /**
     * Helper method for retrieving element's status content
     *
     * @param ElementInterface $element
     * @param FormInterface $form
     * @return void|string
     */
    protected function getStatusContent(ElementInterface $element, FormInterface $form)
    {
        if (!$form->hasValidated()) {
            return;
        }

        if ($this->isElementHasError($element, $form)) {
            return 'error';
        }

        if ($element->getValue()) {
            return $form->getMessages() ? 'warning' : 'success';
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * {@inheritDoc}
     */
    public function getPlacement()
    {
        return $this->placement;
    }
}
