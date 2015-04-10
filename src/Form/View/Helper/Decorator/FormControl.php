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
    Zend\Form\Element,
    Zend\Form\FormInterface,
    Zend\Form\LabelAwareInterface,
    CmsCommon\Form\View\Helper\Decorator\Element as ElementDecorator;

class FormControl extends ElementDecorator
{
    /**
     * @var string
     */
    protected $defaultClass = 'form-control';

    /**
     * {@inheritDoc}
     */
    public function render($content, array $attribs = [], ElementInterface $element = null, FormInterface $form = null)
    {
        if ($content instanceof ElementInterface) {
            if (!$content instanceof Element\Checkbox &&
                !$content instanceof Element\MonthSelect &&
                !$content instanceof Element\Button &&
                !$content instanceof Element\Submit &&
                $content->getAttribute('type') !== 'hidden'
            ) {
                if ($content instanceof Element\Select) {
                    if ($content->getEmptyOption() && $content->getLabelOption('sr_only') === null) {
                        $content->setLabelOption('sr_only', true);
                    }
                } elseif ($content instanceof LabelAwareInterface &&
                    $content->getLabel() &&
                    !$content->hasAttribute('placeholder')
                ) {
                    $content->setAttribute('placeholder', $content->getLabel());
                }

                if ($form && $this->isElementHasError($content, $form)) {
                    if (!$content->hasAttribute('id')) {
                        $idNormalizer = $this->getIdNormalizer();
                        $content->setAttribute('id', $idNormalizer($content->getName()));
                    }
                    $content->setAttribute('aria-describedby', $content->getAttribute('id') . '-status');
                }
            }
        }

        return parent::render($content, $attribs, $element, $form);
    }
}
