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

use Zend\Form\ElementInterface,
    Zend\Form\FormInterface,
    CmsCommon\Form\View\Helper\Decorator\AbstractHtmlContainer,
    CmsCommon\Form\View\Helper\Decorator\ElementDescription,
    CmsCommon\Form\View\Helper\Decorator\ElementErrors,
    CmsCommon\View\Helper\Decorator\OrderedDecoratorInterface,
    CmsCommon\View\Helper\Decorator\PlacedDecoratorInterface;

class HelpBlock extends AbstractHtmlContainer implements OrderedDecoratorInterface, PlacedDecoratorInterface
{
    /**
     * @var string
     */
    protected $tagName = 'span';

    /**
     * @var string
     */
    protected $defaultClass = 'help-block';

    /**
     * @var ElementDescription
     */
    protected $elementDescriptionDecorator;

    /**
     * @var ElementErrors
     */
    protected $elementErrorsDecorator;

    /**
     * @var int
     */
    protected $order = 8000;

    /**
     * @var string
     */
    protected $placement = 'append';

    /**
     * {@inheritDoc}
     */
    public function render($content, array $attribs = [], ElementInterface $element = null, FormInterface $form = null)
    {
        if (!$content) {
            $elementDescriptionDecorator = $this->getElementDescriptionDecorator();
            $elementErrorsDecorator = $this->getElementErrorsDecorator();
            $content = $elementDescriptionDecorator(null, ['class' => 'form-control-description'], $element, $form)
                . $elementErrorsDecorator(null, [], $element, $form);

            if (!$content) {
                return '';
            }
        }

        return parent::render($content, $attribs, $element, $form);
    }

    /**
     * @return ElementDescription
     */
    protected function getElementDescriptionDecorator()
    {
        if ($this->elementDescriptionDecorator) {
            return $this->elementDescriptionDecorator;
        }
    
        if (method_exists($this->view, 'plugin')) {
            $this->elementDescriptionDecorator = $this->view->plugin('element_description');
        }
    
        if (!$this->elementDescriptionDecorator instanceof ElementDescription) {
            $this->elementDescriptionDecorator = new ElementDescription();
            $this->elementDescriptionDecorator->setView($this->getView());
        }
    
        return $this->elementDescriptionDecorator;
    }

    /**
     * @return ElementErrors
     */
    protected function getElementErrorsDecorator()
    {
        if ($this->elementErrorsDecorator) {
            return $this->elementErrorsDecorator;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->elementErrorsDecorator = $this->view->plugin('element_errors');
        }

        if (!$this->elementErrorsDecorator instanceof ElementErrors) {
            $this->elementErrorsDecorator = new ElementErrors();
            $this->elementErrorsDecorator->setView($this->getView());
        }

        return $this->elementErrorsDecorator;
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
