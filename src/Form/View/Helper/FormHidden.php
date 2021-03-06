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

use CmsCommon\Form\View\Helper\FormHidden as BaseFormHidden;

class FormHidden extends BaseFormHidden
{
    /**
     * __construct
     */
    public function __construct()
    {
        $this->decoratorSpecification['errors']['class'] = 'text-danger';
    }
}
