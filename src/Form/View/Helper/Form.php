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

use Zend\Form\FormInterface,
    CmsCommon\Form\View\Helper\Form as FormHelper;

/**
 * View helper for rendering Form objects
 */
class Form extends FormHelper
{
    /**
     * @var string default form class
     */
    private $defaultClass = 'form-horizontal cms-form';

    /**
     * {@inheritDoc}
     */
    public function openTag(FormInterface $form = null)
    {
        if ($form) {
            if (!$form->hasAttribute('role')) {
                $form->setAttribute('role', 'form');
            }

            $class = $form->getAttribute('class');
            if (strpos($class, 'form-horizontal') === false
                && strpos($class, 'form-inline') === false
            ) {
                $form->setAttribute('class', trim("{$this->defaultClass} $class"));
            }
        }

        return parent::openTag($form);
    }
}
