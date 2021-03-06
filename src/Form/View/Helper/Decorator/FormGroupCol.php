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
    CmsCommon\View\Helper\Decorator\OrderedDecoratorInterface,
    CmsTwbs\View\Helper\Col;

class FormGroupCol extends Col implements OrderedDecoratorInterface
{
    /**
     * @var int
     */
    protected $order = 9000;

    /**
     * @param string $content
     * @param array $attribs
     * @param ElementInterface $element
     * @param FormInterface $form
     * @return self|string
     */
    public function __invoke(
        $content = null,
        array $attribs = [],
        ElementInterface $element = null,
        FormInterface $form = null
    ) {
        if (func_num_args() === 0) {
            return $this;
        }

        return $this->render($content, $attribs, $element, $form);
    }

    /**
     * @param string $content
     * @param array $attribs
     * @param ElementInterface $element
     * @param FormInterface $form
     * @return string
     */
    public function render(
        $content,
        array $attribs = [],
        ElementInterface $element = null,
        FormInterface $form = null
    ) {
        if ($form && $form->hasAttribute('class')) {
            $class = $form->getAttribute('class');
            if (strpos($class, 'form-inline') !== false) {
                return $content;
            }

            if (strpos($class, 'form-horizontal') !== false
                && empty($attribs['class'])
                && $form->has('submit')
                && $form->has('reset')
            ) {
                if ($form->get('submit') === $element) {
                    $attribs['class'] = 'col-xs-12 col-sm-8';
                } elseif ($form->get('reset') === $element) {
                    $attribs['class'] = 'col-xs-12 col-sm-4';
                }
            }
        }

        return parent::render($content, $attribs);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return $this->order;
    }
}
