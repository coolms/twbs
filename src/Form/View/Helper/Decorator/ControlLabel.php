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
    Zend\Form\LabelAwareInterface,
    CmsCommon\Form\View\Helper\Decorator\ElementLabel,
    CmsCommon\View\Helper\Decorator\OrderedDecoratorInterface,
    CmsCommon\View\Helper\Decorator\PlacedDecoratorInterface;

class ControlLabel extends ElementLabel implements OrderedDecoratorInterface, PlacedDecoratorInterface
{
    /**
     * @var string
     */
    protected $defaultClass = 'control-label';

    /**
     * @var bool
     */
    protected $srOnly;

    /**
     * @var int
     */
    protected $order = 7000;

    /**
     * @var string
     */
    protected $placement = 'prepend';

    /**
     * {@inheritDoc}
     */
    public function render($content, array $attribs = [], ElementInterface $element = null)
    {
        if ($element) {
            $srOnly = $this->getSrOnly();
            if (null === $srOnly) {
                if ($element instanceof LabelAwareInterface) {
                    $srOnly = $element->getLabelOption('sr_only');
                }

                if (null === $srOnly && $element->hasAttribute('placeholder')) {
                    $srOnly = true;
                }
            }

            if ($srOnly) {
                $attribs = array_merge_recursive($attribs, ['class' => 'sr-only']);
            }
        }

        return parent::render($content, $attribs, $element);
    }

    /**
     * @param bool $flag
     * @return self
     */
    public function setSrOnly($flag)
    {
        $this->srOnly = (bool) $flag;
        return $this;
    }

    /**
     * @return bool
     */
    public function getSrOnly()
    {
        return $this->srOnly;
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
