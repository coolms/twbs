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

use Zend\Form\Element,
    Zend\Form\FormInterface,
    Zend\I18n\Translator\TranslatorAwareInterface,
    Zend\Stdlib\ArrayUtils,
    Zend\View\Helper\AbstractHelper,
    CmsCommon\View\Exception\InvalidArgumentException,
    CmsCommon\View\Exception\InvalidHelperException,
    CmsTwbs\View\Helper\Panel;

/**
 * View helper for rendering form panel
 */
class FormPanel extends Panel
{
    /**
     * @var array
     */
    protected $defaultFooterElementsByType = [
        Element\Captcha::class,
        Element\Csrf::class,
        Element\Submit::class,
    ];

    /**
     * The name of the default view helper that is used to render form elements.
     *
     * @var string
     */
    protected $defaultFieldsetHelper = 'formRow';

    /**
     * The view helper used to render form elements.
     *
     * @var AbstractHelper
     */
    protected $fieldsetHelper;

    /**
     * The name of the default view helper that is used to render form's open/close tags.
     *
     * @var string
     */
    protected $defaultFormHelper = 'form';

    /**
     * The view helper used to render form's open/close tags.
     *
     * @var AbstractHelper
     */
    protected $formHelper;

    /**
     * The name of the default view helper that is used to render form messages.
     *
     * @var string
     */
    protected $defaultFormMessagesHelper = 'formMessages';

    /**
     * The view helper used to render form messages.
     *
     * @var AbstractHelper
     */
    protected $formMessagesHelper;

    /**
     * @var string
     */
    protected $defaultLabelHelper = 'formLabel';

    /**
     * @var AbstractHelper
     */
    protected $labelHelper;

    /**
     * @var string
     */
    protected $defaultRowHelper = 'formRow';

    /**
     * @var AbstractHelper
     */
    protected $rowHelper;

    /**
     * @param FormInterface $form
     * @param array $attribs
     * @param mixed $header
     * @param mixed $footer
     * @return self|string
     */
    public function __invoke($form = null, array $attribs = [], $header = null, $footer = null)
    {
        if (null === $form) {
            return $this;
        }

        return $this->render($form, $attribs, $header, $footer);
    }

    /**
     * Render Form Panel
     *
     * @param FormInterface $form
     * @param array $attribs
     * @param mixed $header
     * @param mixed $footer
     * @throws InvalidArgumentException
     * @return string
     */
    public function render($form, array $attribs = [], $header = null, $footer = null)
    {
        if (!$form instanceof FormInterface) {
            throw new InvalidArgumentException(sprintf(
                'First argument must be an instance of %s; %s given',
                FormInterface::class,
                is_object($form) ? get_class($form) : gettype($form)
            ));
        }

        if (!method_exists($this->view, 'plugin')) {
        	// Bail early if renderer is not pluggable
        	return '';
        }

        if (!array_key_exists('class', $attribs)) {
            $attribs['class'] = 'panel-primary';
        }

        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formOpenTag = $this->getFormHelper()->openTag($form);

        if (null === $header) {
            $header = $this->renderHeader($form);
        }

        $footer = $this->renderFooter($form);
        if (func_get_arg(3) !== null) {
            $footer = func_get_arg(3);
        }

        $formMessagesHelper = $this->getFormMessagesHelper();
        $content = $formMessagesHelper($form) . $this->renderContent($form);

        return $formOpenTag
            . parent::render($content, $attribs, $header, $footer)
            . $this->getFormHelper()->closeTag();
    }

    /**
     * Retrieve the fieldset helper
     *
     * @return AbstractHelper
     * @throws InvalidHelperException
     */
    protected function getFieldsetHelper()
    {
        if ($this->fieldsetHelper) {
            return $this->fieldsetHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->fieldsetHelper = $this->view->plugin($this->defaultFieldsetHelper);
        }

        if (!$this->fieldsetHelper instanceof AbstractHelper) {
            // @todo Ideally the helper should implement an interface.
    	    throw InvalidHelperException::invalidHelperInstance($this->fieldsetHelper);
        }

        return $this->fieldsetHelper;
    }

    /**
     * Retrieve the form helper
     *
     * @return AbstractHelper
     * @throws InvalidHelperException
     */
    protected function getFormHelper()
    {
        if ($this->formHelper) {
            return $this->formHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->formHelper = $this->view->plugin($this->defaultFormHelper);
        }

        if (!$this->formHelper instanceof AbstractHelper) {
            // @todo Ideally the helper should implement an interface.
            throw InvalidHelperException::invalidHelperInstance($this->formHelper);
        }

        return $this->formHelper;
    }

    /**
     * Retrieve the form messages helper
     *
     * @return AbstractHelper
     * @throws InvalidHelperException
     */
    protected function getFormMessagesHelper()
    {
        if ($this->formMessagesHelper) {
            return $this->formMessagesHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->formMessagesHelper = $this->view->plugin($this->defaultFormMessagesHelper);
        }

        if (!$this->formMessagesHelper instanceof AbstractHelper) {
            // @todo Ideally the helper should implement an interface.
            throw InvalidHelperException::invalidHelperInstance($this->formMessagesHelper);
        }

        return $this->formMessagesHelper;
    }

    /**
     * Retrieve the label helper
     *
     * @return AbstractHelper
     * @throws InvalidHelperException
     */
    protected function getLabelHelper()
    {
        if ($this->labelHelper) {
            return $this->labelHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->labelHelper = $this->view->plugin($this->defaultLabelHelper);
        }

        if (!$this->labelHelper instanceof AbstractHelper) {
            // @todo Ideally the helper should implement an interface.
            throw InvalidHelperException::invalidHelperInstance($this->labelHelper);
        }

        return $this->labelHelper;
    }

    /**
     * @param FormInterface $form
     * @return string
     */
    protected function renderHeader(FormInterface $form)
    {
        if (!$form->getLabel()) {
            return '';
        }

        $helper = $this->getLabelHelper();

        if ($helper instanceof TranslatorAwareInterface) {
            $rollbackTextDomain = $helper->getTranslatorTextDomain();
            if (($textDomain = $form->getOption('text_domain')) &&
                $rollbackTextDomain === 'default'
            ) {
                $helper->setTranslatorTextDomain($textDomain);
            }
        }

        $markup = $helper($form);

        if (isset($rollbackTextDomain)) {
            $helper->setTranslatorTextDomain($rollbackTextDomain);
        }

        return $markup;
    }

    /**
     * @param FormInterface $form
     * @return string
     */
    protected function renderContent(FormInterface $form)
    {
        $markup = '';

        $helper = $this->getFieldsetHelper();

        if ($helper instanceof TranslatorAwareInterface) {
            $rollbackTextDomain = $helper->getTranslatorTextDomain();
            if (($textDomain = $form->getOption('text_domain')) &&
                $rollbackTextDomain === 'default'
            ) {
                $helper->setTranslatorTextDomain($textDomain);
            }
        }

        $markup = $helper($form, false);

        if (isset($rollbackTextDomain)) {
            $helper->setTranslatorTextDomain($rollbackTextDomain);
        }

        return $markup;
    }

    /**
     * @param FormInterface $form
     * @return string
     */
    protected function renderFooter(FormInterface $form)
    {
        $markup = '';

        $helper = $this->getRowHelper();

        if ($helper instanceof TranslatorAwareInterface) {
            $rollbackTextDomain = $helper->getTranslatorTextDomain();
            if (($textDomain = $form->getOption('text_domain')) &&
                $rollbackTextDomain === 'default'
            ) {
                $helper->setTranslatorTextDomain($textDomain);
            }
        }

        foreach (ArrayUtils::iteratorToArray($form) as $elementOrFieldset) {
            foreach ($this->defaultFooterElementsByType as $type) {
                if ($elementOrFieldset instanceof $type) {
                    $markup .= $helper($elementOrFieldset);
                    $elementOrFieldset->setOption('__rendered__', true);
                    break;
                }
            }
        }

        if (isset($rollbackTextDomain)) {
            $helper->setTranslatorTextDomain($rollbackTextDomain);
        }

        return $markup;
    }

    /**
     * Retrieve the form row helper
     *
     * @return AbstractHelper
     * @throws InvalidHelperException
     */
    protected function getRowHelper()
    {
        if ($this->rowHelper) {
            return $this->rowHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->rowHelper = $this->view->plugin($this->defaultRowHelper);
        }

        if (!$this->rowHelper instanceof AbstractHelper) {
            // @todo Ideally the helper should implement an interface.
    	    throw InvalidHelperException::invalidHelperInstance($this->rowHelper);
        }

        return $this->rowHelper;
    }
}
