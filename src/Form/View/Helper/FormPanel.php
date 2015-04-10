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

use Zend\Form\FormInterface,
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
        'Zend\Form\Element\Captcha',
        'Zend\Form\Element\Csrf',
        'Zend\Form\Element\Submit',
    ];

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
     * @return string
     */
    public function render($form, array $attribs = [], $header = null, $footer = null)
    {
        if (!$form instanceof FormInterface) {
            throw new \InvalidArgumentException(sprintf(
                'First argument must be an instance of Zend\Form\FormInterface; %s given',
                is_object($form) ? get_class($form) : gettype($form)
            ));
        }

        $renderer = $this->getView();
        if (!method_exists($renderer, 'plugin')) {
        	// Bail early if renderer is not pluggable
        	return '';
        }

        if (null === $header && $form->getLabel()) {
            $labelPlugin = $renderer->plugin('formLabel');
            $header = $labelPlugin($form);
        }

        $rowPlugin = $renderer->plugin('form_row');
        foreach ($form as $elementOrFieldset) {
            foreach ($this->defaultFooterElementsByType as $type) {
                if ($elementOrFieldset instanceof $type) {
                    $footer .= $rowPlugin($elementOrFieldset);
                    $elementOrFieldset->setOption('__rendered__', true);
                    break;
                }
            }
        }
        if (func_get_arg(3) !== null) {
            $footer = func_get_arg(3);
        }

        $collectionPlugin = $renderer->plugin('form_collection');
        $content = $collectionPlugin($form, false);

        $formPlugin = $renderer->plugin('form');
        return $formPlugin->openTag($form)
            . parent::render($content, $attribs, $header, $footer)
            . $formPlugin->closeTag();
    }
}
